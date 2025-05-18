<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;

if (!defined('ABSPATH')) {
	exit;
}

function custom_jwt_payload($payload, $user) {
	// Get user roles directly from the user object
	$userRoles = $user->roles;

	// Modify the payload
	$payload['iss'] = get_bloginfo('url');            // Issuer
	$payload['iat'] = time();                         // Issued at time
	$payload['exp'] = time() + DAY_IN_SECONDS;        // Expiration time
	$payload['user_id'] = $user->ID;                  // User ID
	$payload['user_role'] = $userRoles; // User Role(s)

	return $payload;
}

function validate_token($token) {
	if (!defined('JWT_AUTH_SECRET_KEY')) {
		return new WP_Error('jwt_config_missing', 'JWT secret key not configured', ['status' => 500]);
	}

	try {
		$decoded = JWT::decode($token, new Key(JWT_AUTH_SECRET_KEY, 'HS256'));
		return (array) $decoded;
	} catch (ExpiredException $e) {
		return new WP_Error('jwt_expired', 'Token has expired', ['status' => 403]);
	} catch (Exception $e) {
		return new WP_Error('jwt_invalid', $e->getMessage(), ['status' => 403]);
	}
}

class Bus_Management {

	const DB_VERSION = '1.0.0';

	public function __construct() {
		add_action('init', [$this, 'ensure_roles_exist']);
	}

	public function ensure_roles_exist() {
		if (!get_role('field')) {
			add_role('field', 'Field', [
				'read' => true,
				'access_dashboard' => true,
				'access_departure' => true,
				'access_arrival' => true,
				'register_bus' => true,
			]);
		}

		if (!get_role('operational')) {
			add_role('operational', 'Operational', [
				'read' => true,
				'access_dashboard' => true,
				'access_departure' => true,
				'access_arrival' => true,
				'register_bus' => true,
				'export_trip' => true,
				'add_location' => true,
				'add_company' => true,
			]);
		}
	}

	public static function create_tables() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		$prefix = $wpdb->prefix;

		$tables = [
			'locations'         => "{$prefix}bmp_locations",
			'companies'         => "{$prefix}bmp_companies",
			'bmp_location_etas' => "{$prefix}bmp_location_etas",
			'buses'             => "{$prefix}bmp_buses",
			'departures'        => "{$prefix}bmp_departures",
			'arrivals'          => "{$prefix}bmp_arrivals",
			'bus_statuses'      => "{$prefix}bmp_bus_statuses"
		];

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		if (get_option('bmp_db_version') === self::DB_VERSION) return;

		dbDelta("CREATE TABLE IF NOT EXISTS {$tables['locations']} (
			id INT AUTO_INCREMENT PRIMARY KEY,
			name VARCHAR(255) NOT NULL
		) $charset_collate;");

		dbDelta("CREATE TABLE IF NOT EXISTS {$tables['companies']} (
			id INT AUTO_INCREMENT PRIMARY KEY,
			name VARCHAR(255) NOT NULL
		) $charset_collate;");

		dbDelta("CREATE TABLE IF NOT EXISTS {$tables['bmp_location_etas']} (
			id INT AUTO_INCREMENT PRIMARY KEY,
			from_location_id INT NOT NULL,
			to_location_id INT NOT NULL,
			eta_minutes INT DEFAULT NULL,
			UNIQUE KEY unique_route (from_location_id, to_location_id),
			FOREIGN KEY (from_location_id) REFERENCES {$tables['locations']}(id) ON DELETE CASCADE,
			FOREIGN KEY (to_location_id) REFERENCES {$tables['locations']}(id) ON DELETE CASCADE
		) $charset_collate;");

		dbDelta("CREATE TABLE IF NOT EXISTS {$tables['buses']} (
			id INT AUTO_INCREMENT PRIMARY KEY,
			bus_number VARCHAR(255) NOT NULL UNIQUE,
			d_bus_number VARCHAR(255) NOT NULL UNIQUE,
			company_id INT NOT NULL,
			KEY company_id (company_id)
		) $charset_collate;");

		dbDelta("CREATE TABLE IF NOT EXISTS {$tables['bus_statuses']} (
			id INT AUTO_INCREMENT PRIMARY KEY,
			bus_id INT NOT NULL,
			status_slug VARCHAR(255) NOT NULL,
			created_at DATETIME NOT NULL,
			KEY bus_id (bus_id)
		) $charset_collate;");

		dbDelta("CREATE TABLE IF NOT EXISTS {$tables['departures']} (
			id INT AUTO_INCREMENT PRIMARY KEY,
			bus_id INT NOT NULL,
			from_location_id INT NOT NULL,
			to_location_id INT NOT NULL,
			passengers INT NOT NULL,
			departure_time DATETIME NOT NULL,
			KEY bus_id (bus_id),
			KEY from_location_id (from_location_id),
			KEY to_location_id (to_location_id)
		) $charset_collate;");

		dbDelta("CREATE TABLE IF NOT EXISTS {$tables['arrivals']} (
			id INT AUTO_INCREMENT PRIMARY KEY,
			bus_id INT NOT NULL,
			arrival_location_id INT NOT NULL,
			arrival_time DATETIME NOT NULL,
			KEY bus_id (bus_id),
			KEY arrival_location_id (arrival_location_id)
		) $charset_collate;");

		// Helper function to safely add foreign keys
		function add_foreign_key_if_missing($table, $constraint, $column, $ref_table, $ref_column) {
			global $wpdb;
			$exists = $wpdb->get_var($wpdb->prepare("
				SELECT CONSTRAINT_NAME
				FROM information_schema.KEY_COLUMN_USAGE
				WHERE TABLE_SCHEMA = DATABASE()
				AND TABLE_NAME = %s
				AND CONSTRAINT_NAME = %s
			", $table, $constraint));

			if (!$exists) {
				$wpdb->query("
					ALTER TABLE $table
					ADD CONSTRAINT $constraint
					FOREIGN KEY ($column) REFERENCES $ref_table($ref_column)
				");
			}
		}

		// Add foreign keys
		add_foreign_key_if_missing($tables['buses'], 'fk_buses_company', 'company_id', $tables['companies'], 'id');

		add_foreign_key_if_missing($tables['departures'], 'fk_departure_bus', 'bus_id', $tables['buses'], 'id');
		add_foreign_key_if_missing($tables['departures'], 'fk_departure_from', 'from_location_id', $tables['locations'], 'id');
		add_foreign_key_if_missing($tables['departures'], 'fk_departure_to', 'to_location_id', $tables['locations'], 'id');

		add_foreign_key_if_missing($tables['arrivals'], 'fk_arrival_bus', 'bus_id', $tables['buses'], 'id');
		add_foreign_key_if_missing($tables['arrivals'], 'fk_arrival_location', 'arrival_location_id', $tables['locations'], 'id');

		update_option('bmp_db_version', self::DB_VERSION);
	}

	public static function drop_tables() {
		global $wpdb;
		$prefix = $wpdb->prefix;

		$tables = [
			"{$prefix}bmp_arrivals",
			"{$prefix}bmp_departures",
			"{$prefix}bmp_bus_statuses",
			"{$prefix}bmp_location_etas",
			"{$prefix}bmp_buses",
			"{$prefix}bmp_locations",
			"{$prefix}bmp_companies",
		];

		// Delete data first to prevent FK violations
		foreach ($tables as $table) {
			$wpdb->query("DELETE FROM $table");
		}

		foreach ($tables as $table) {
			$wpdb->query("DROP TABLE IF EXISTS $table");
		}

		delete_option('bmp_db_version');
	}
}

// Hooks
register_activation_hook(__FILE__, ['Bus_Management', 'create_tables']);
register_deactivation_hook(__FILE__, ['Bus_Management', 'drop_tables']);
