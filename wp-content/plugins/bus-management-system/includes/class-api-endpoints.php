<?php

class API_Endpoints {

	public static function register_routes() {
		register_rest_route('bmp/v1', '/user/register', [
			'methods' => 'POST',
			'callback' =>  ['API_Endpoints', 'handle_user_registration'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator']);
			},
		]);

		register_rest_route( 'bmp/v1', '/bus/register', array(
			'methods' => 'POST',
			'callback' => ['API_Endpoints', 'register_bus'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		));

		register_rest_route( 'bmp/v1', '/departure/submit', array(
			'methods' => 'POST',
			'callback' => ['API_Endpoints', 'submit_departure'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		));

		register_rest_route( 'bmp/v1', '/arrival/submit', array(
			'methods' => 'POST',
			'callback' => ['API_Endpoints', 'submit_arrival'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		));

		register_rest_route('bmp/v1', '/dashboard', [
			'methods' => 'GET',
			'callback' => ['API_Endpoints', 'bmp_get_dashboard_stats'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		]);

		register_rest_route('bmp/v1', '/dashboard/trips', [
			'methods' => 'GET',
			'callback' => ['API_Endpoints', 'bmp_get_dashboard_trips'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		]);

		register_rest_route('bmp/v1', '/locations', [
			'methods' => 'GET',
			'callback' => ['API_Endpoints', 'bmp_get_locations'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		]);
		
		register_rest_route('bmp/v1', '/add-location', [
			'methods' => 'POST',
			'callback' => ['API_Endpoints', 'bmp_create_location'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		]);
		
		register_rest_route('bmp/v1', '/locations/(?P<id>\d+)', [
			'methods' => 'GET',
			'callback' => ['API_Endpoints', 'bmp_get_single_location'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		]);
	
		register_rest_route('bmp/v1', '/locations/(?P<id>\d+)', [
			'methods' => 'PUT',
			'callback' => ['API_Endpoints', 'bmp_update_location'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		]);
	
		register_rest_route('bmp/v1', '/locations/(?P<id>\d+)', [
			'methods' => 'DELETE',
			'callback' => ['API_Endpoints', 'bmp_delete_location'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		]);

		register_rest_route('bmp/v1', '/companies', [
			'methods' => 'GET',
			'callback' => ['API_Endpoints', 'bmp_get_companies'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		]);
		
		register_rest_route('bmp/v1', '/companies', [
			'methods' => 'POST',
			'callback' => ['API_Endpoints', 'bmp_create_company'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		]);
		
		register_rest_route('bmp/v1', '/companies/(?P<id>\d+)', [
			'methods' => 'GET',
			'callback' => ['API_Endpoints', 'bmp_get_single_company'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		]);
	
		register_rest_route('bmp/v1', '/companies/(?P<id>\d+)', [
			'methods' => 'PUT',
			'callback' => ['API_Endpoints', 'bmp_update_company'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		]);
	
		register_rest_route('bmp/v1', '/companies/(?P<id>\d+)', [
			'methods' => 'DELETE',
			'callback' => ['API_Endpoints', 'bmp_delete_company'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		]);

		register_rest_route('bmp/v1', '/statuses', [
			'methods' => 'GET',
			'callback' => ['API_Endpoints', 'bmp_get_statuses'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		]);

		register_rest_route('bmp/v1', '/statuses/(?P<id>\d+)', [
			'methods' => 'GET',
			'callback' => ['API_Endpoints', 'bmp_get_status_by_id'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		]);

		register_rest_route('bmp/v1', '/update-bus-status', [
			'methods' => 'POST',
			'callback' => ['API_Endpoints', 'bmp_update_bus_status'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		]);

		register_rest_route('bmp/v1', '/bus-status', [
			'methods' => 'POST',
			'callback' => ['API_Endpoints', 'bmp_submit_bus_status'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		]);

		register_rest_route('bmp/v1', '/export-trips', [
			'methods' => 'GET',
			'callback' => ['API_Endpoints', 'export_trips_to_excel'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational']);
			},
		]);

		register_rest_route('bmp/v1', '/departures/(?P<d_bus_number>[a-zA-Z0-9\-]+)', [
			'methods'  => 'GET',
			'callback' => ['API_Endpoints', 'bmp_get_departure_details'],            
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		]);

		register_rest_route('bmp/v1', '/buses/search', [
			'methods'             => 'GET',
			'callback'            => ['API_Endpoints', 'bmp_get_buses_by_search'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
			'args' => [
				'search' => [
					'required' => true,
					'validate_callback' => function ( $param, $request, $key ) {
						// Ensure the search term is not empty
						return ! empty( $param );
					}
				],
				'status' => [
					'required' => false,  // Status is optional; default can be 'available'
					'validate_callback' => function ( $param, $request, $key ) {
						// Ensure the status is either 'departed' or 'available'
						return in_array( $param, ['departed', 'available'], true );
					}
				],
			],
		]);

		register_rest_route('bmp/v1', '/buses/search-arrival', [
			'methods' => 'GET',
			'callback' => ['API_Endpoints', 'search_departed_buses'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
			'args' => [
				'search' => [
					'required' => true,
					'sanitize_callback' => 'sanitize_text_field',
				],
				'status' => [
					'required' => false,
					'sanitize_callback' => 'sanitize_text_field',
				],
			],
		]);

		register_rest_route( 'bmp/v1', '/location-etas', [
			'methods'  => 'GET',
			'callback' => ['API_Endpoints', 'get_location_etas'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		]);

		register_rest_route( 'bmp/v1', '/location-etas', [
			'methods'  => 'POST',
			'callback' => ['API_Endpoints', 'create_location_etas'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		]);

		register_rest_route( 'bmp/v1', '/location-etas/(?P<id>\d+)', [
			'methods'  => 'GET',
			'callback' => ['API_Endpoints', 'get_eta_by_id'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		]);

		register_rest_route( 'bmp/v1', '/location-etas/(?P<id>\d+)', [
			'methods'  => 'PUT',
			'callback' => ['API_Endpoints', 'update_location_etas'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		]);

		register_rest_route( 'bmp/v1', '/location-etas/(?P<id>\d+)', [
			'methods'  => 'DELETE',
			'callback' => ['API_Endpoints', 'delete_location_etas'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		]);

		register_rest_route( 'bmp/v1', '/validate-location-pair', [
			'methods' => 'POST',
			'callback' => ['API_Endpoints', 'validate_location_pair_callback'],
			'permission_callback' => function() {
				return API_Endpoints::bmp_check_token_permission(['administrator', 'operational', 'field']);
			},
		]);
	}

	// check token permissions
	public static function bmp_check_token_permission($required_roles = []) {
		$headers = getallheaders();
		$auth_header = $headers['Authorization'] ?? $headers['authorization'] ?? '';
		$token = str_replace('Bearer ', '', $auth_header);
	
		if (!$token) {
			return new WP_Error('rest_forbidden', 'Token not provided.', ['status' => 401]);
		}
	
		$decoded = validate_token($token);
		if (is_wp_error($decoded)) {
			return $decoded;
		}
	
		$user_id = $decoded['data']->user->id ?? null;

		if (!$user_id || !($user = get_user_by('id', $user_id))) {
			return new WP_Error('rest_forbidden', 'User not found.', ['status' => 403]);
		}

		// If the user does not have any of the required roles
		if (empty($required_roles)) {
			return new WP_Error('rest_forbidden', 'No roles provided for authorization check.', ['status' => 400]);
		}

		// Check if the user has at least one of the required roles
		$user_roles = $user->roles;
		$has_required_role = false;
		foreach ($required_roles as $role) {
			if (in_array($role, $user_roles)) {
				$has_required_role = true;
				break;
			}
		}

		if (!$has_required_role) {
			return new WP_Error('rest_forbidden', 'You do not have permission to access this resource.', ['status' => 403]);
		}

		return true; // Permission granted
	}

	// authenticate requests
	public static function bmp_authenticate_requests($result, $server, $request) {
		$route = $request->get_route();

		if ($route === '/jwt-auth/v1/token') {
			return $result;
		}

		$auth_header = $request->get_header('authorization');

		if (!$auth_header || !str_starts_with($auth_header, 'Bearer ')) {
			return new WP_Error('jwt_missing', 'Authorization header missing or invalid', ['status' => 403]);
		}
	
		$token = str_replace('Bearer ', '', $auth_header);
		$validation = validate_token($token);
	
		if (is_wp_error($validation)) {
			return $validation;
		}
	
		return $result;
	}

	// user registeration
	public static function handle_user_registration(WP_REST_Request $request) {
		$username = sanitize_text_field($request->get_param('username'));
		$email = sanitize_email($request->get_param('email'));
		$password = $request->get_param('password');
		$role = $request->get_param('role');
	
		// Validate email
		if (!is_email($email)) {
			return new WP_REST_Response(['success' => false, 'message' => 'Invalid email address.'], 400);
		}
	
		// Check if the user already exists
		if (username_exists($username)) {
			return new WP_REST_Response(['success' => false, 'message' => 'Username already exists.'], 400);
		}
		
		if (email_exists($email)) {
			return new WP_REST_Response(['success' => false, 'message' => 'Email already exists.'], 400);
		}
	
		// Create the new user
		$userdata = [
			'user_login' => $username,
			'user_email' => $email,
			'user_pass'  => $password,
			'role'       => $role,
		];
	
		$user_id = wp_insert_user($userdata);
	
		if (is_wp_error($user_id)) {
			return new WP_REST_Response(['success' => false, 'message' => $user_id->get_error_message()], 400);
		}
	
		// Success
		return new WP_REST_Response(['success' => true, 'message' => 'User created successfully.'], 200);
	}

	// get departure details
	public static function bmp_get_departure_details($request) {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$d_bus_number = sanitize_text_field($request['d_bus_number']);
		
		// Get bus ID by bus number
		$bus_id = $wpdb->get_var(
			$wpdb->prepare("SELECT id FROM {$prefix}bmp_buses WHERE d_bus_number = %s", $d_bus_number)
		);
	
		if (!$bus_id) {
			return new WP_Error('not_found', 'Bus not found', ['status' => 404]);
		}
	
		// Get the latest or most relevant departure
		$departure = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM {$prefix}bmp_departures WHERE bus_id = %d ORDER BY departure_time DESC LIMIT 1",
				$bus_id
			),
			ARRAY_A
		);
	
		if (!$departure) {
			return new WP_Error('not_found', 'Departure not found', ['status' => 404]);
		}
	
		// Get arrival location from the most recent arrival (if any)
		$arrival_location_id = $wpdb->get_var(
			$wpdb->prepare(
				"SELECT arrival_location_id FROM {$prefix}bmp_arrivals 
				WHERE bus_id = %d AND arrival_time IS NULL LIMIT 1",
				$bus_id
			)
		);
	
		// Attach extra data to the response
		$departure['bus_number'] = $d_bus_number;
		$departure['arrival_location_id'] = $arrival_location_id;
	
		// Return the departure details, including arrival_location_id
		return rest_ensure_response($departure);
	}

	// register bus
	public static function register_bus( WP_REST_Request $request ) {
		global $wpdb;
		$prefix = $wpdb->prefix;
	
		$bus_number   = sanitize_text_field( $request->get_param('bus_number') );
		$d_bus_number = sanitize_text_field( $request->get_param('d_bus_number') );
		$company_id   = intval( $request->get_param('company_id') );
	
		if ( empty( $bus_number ) || $company_id <= 0 ) {
			return new WP_Error( 'invalid_data', 'Invalid input data.', array( 'status' => 400 ) );
		}
	
		$exists = $wpdb->get_var( $wpdb->prepare(
			"SELECT COUNT(*) FROM {$prefix}bmp_buses WHERE bus_number = %s",
			$bus_number
		) );
	
		if ( $exists > 0 ) {
			return new WP_Error( 'duplicate_bus', 'A bus with this number already exists.', array( 'status' => 409 ) );
		}
	
		$inserted = $wpdb->insert(
			"{$prefix}bmp_buses",
			array(
				'bus_number'   => $bus_number,
				'd_bus_number' => $d_bus_number,
				'company_id'   => $company_id,
			),
			array( '%s', '%s', '%d' )
		);
	
		if ( false === $inserted ) {
			return new WP_Error( 'db_insert_error', 'Could not insert bus into the database.', array( 'status' => 500 ) );
		}
	
		$bus_id = $wpdb->insert_id;
	
		return rest_ensure_response( array(
			'message' => 'Bus registered successfully.',
			'bus_id'  => $bus_id,
		) );
	}

	// searching buses by bus number (excluding already departed buses not yet arrived)
	public static function bmp_get_buses_by_search( WP_REST_Request $request ) {
		global $wpdb;
		$prefix = $wpdb->prefix;
	
		$search_term = sanitize_text_field( $request->get_param( 'search' ) );
		$status = sanitize_text_field( $request->get_param( 'status' ) ); // 'departed' or 'available'
	
		if ( $status === 'departed' ) {
			// Get buses that have a departure but no arrival (i.e., still en route)
			$results = $wpdb->get_results(
				$wpdb->prepare(
					"
					SELECT b.id, b.d_bus_number
					FROM {$prefix}bmp_buses b
					WHERE b.d_bus_number LIKE %s
					AND b.id IN (
						SELECT d.bus_id
						FROM {$prefix}bmp_departures d
						LEFT JOIN {$prefix}bmp_arrivals a ON d.bus_id = a.bus_id
						WHERE a.id IS NULL
					)
					ORDER BY d_bus_number ASC
					",
					'%' . $wpdb->esc_like( $search_term ) . '%'
				),
				ARRAY_A
			);
		} else {
			// Default: Get buses that are NOT currently departed
			$results = $wpdb->get_results(
				$wpdb->prepare(
					"
					SELECT b.id, b.d_bus_number
					FROM {$prefix}bmp_buses b
					WHERE b.d_bus_number LIKE %s
					AND b.id NOT IN (
						SELECT d.bus_id
						FROM {$prefix}bmp_departures d
						LEFT JOIN {$prefix}bmp_arrivals a ON d.bus_id = a.bus_id
						WHERE a.id IS NULL
					)
					ORDER BY d_bus_number ASC
					",
					'%' . $wpdb->esc_like( $search_term ) . '%'
				),
				ARRAY_A
			);
		}
	
		if ( empty( $results ) ) {
			return new WP_Error( 'no_buses_found', 'No available buses found matching the search term.', array( 'status' => 404 ) );
		}
	
		return rest_ensure_response( $results );
	}

	public static function search_departed_buses(WP_REST_Request $request) {
		global $wpdb;

		$search_term = sanitize_text_field($request->get_param('search'));
		$like_search = '%' . $wpdb->esc_like($search_term) . '%';

		$sql = "
			SELECT 
				d.id,
				b.d_bus_number,
				tl.name AS to_location,
				latest_status.status_slug
			FROM wp_bmp_departures d
			JOIN wp_bmp_buses b ON d.bus_id = b.id
			JOIN wp_bmp_locations tl ON d.to_location_id = tl.id
			LEFT JOIN (
				SELECT bs.bus_id, bs.status_slug
				FROM wp_bmp_bus_statuses bs
				INNER JOIN (
					SELECT bus_id, MAX(created_at) AS latest_created
					FROM wp_bmp_bus_statuses
					GROUP BY bus_id
				) latest_bs ON bs.bus_id = latest_bs.bus_id AND bs.created_at = latest_bs.latest_created
			) latest_status ON d.bus_id = latest_status.bus_id
			WHERE d.departure_time = (
				SELECT MAX(d2.departure_time)
				FROM wp_bmp_departures d2
				WHERE d2.bus_id = d.bus_id
			)
			AND NOT EXISTS (
				SELECT 1
				FROM wp_bmp_arrivals a
				WHERE a.bus_id = d.bus_id AND a.arrival_time > d.departure_time
			)
			AND (latest_status.status_slug IS NULL OR latest_status.status_slug != 'delayed')
			AND b.d_bus_number LIKE '%DB%'
			ORDER BY b.d_bus_number ASC;
		";

		$results = $wpdb->get_results($wpdb->prepare($sql, $like_search), ARRAY_A);
		return rest_ensure_response($results);
	}
	
	// dashboard stats
	public static function bmp_get_dashboard_stats() {
		global $wpdb;
		$prefix = $wpdb->prefix;
	
		$tscLocationId = $wpdb->get_var("SELECT id FROM {$prefix}bmp_locations WHERE name = 'TSC - Toronto Study Centre' LIMIT 1");
	
		$totalBuses = (int) $wpdb->get_var("SELECT COUNT(*) FROM {$prefix}bmp_buses");
	
		$totalCompleteTrips = (int) $wpdb->get_var("
			SELECT COUNT(*) FROM {$prefix}bmp_arrivals
		");
	
		$busesInTransitToTSC = (int) $wpdb->get_var($wpdb->prepare(
			"SELECT COUNT(*) FROM {$prefix}bmp_departures d
			JOIN {$prefix}bmp_locations t ON d.to_location_id = t.id
			WHERE d.to_location_id = %d AND t.name NOT IN ('break', 'parking', 'hotel', 'sent-back')",
			$tscLocationId
		));
	
		$busesInTransitToTerminal = (int) $wpdb->get_var(
			"SELECT COUNT(*) FROM {$prefix}bmp_departures d
			JOIN {$prefix}bmp_locations t ON d.to_location_id = t.id
			WHERE d.from_location_id != d.to_location_id AND t.name NOT IN ('break', 'parking', 'hotel', 'sent-back')"
		);
	
		$passengersArrivedAtTSC = (int) ($wpdb->get_var($wpdb->prepare(
			"SELECT SUM(d.passengers) FROM {$prefix}bmp_arrivals a
			JOIN {$prefix}bmp_departures d ON a.bus_id = d.bus_id
			WHERE a.arrival_location_id = %d",
			$tscLocationId
		)) ?? 0);
	
		$busesOnBreak = (int) $wpdb->get_var(
			"SELECT COUNT(*) FROM {$prefix}bmp_departures d
			JOIN {$prefix}bmp_locations t ON d.to_location_id = t.id
			WHERE t.name = 'break'"
		);
	
		$busesSentBack = (int) $wpdb->get_var(
			"SELECT COUNT(*) FROM {$prefix}bmp_departures d
			JOIN {$prefix}bmp_locations t ON d.to_location_id = t.id
			WHERE t.name IN ('sent back', 'sent-back')"
		);
	
		$delayedBuses = (int) $wpdb->get_var(
			"SELECT COUNT(*) FROM {$prefix}bmp_departures d
			JOIN {$prefix}bmp_arrivals a ON d.bus_id = a.bus_id
			WHERE TIMESTAMPDIFF(MINUTE, d.departure_time, a.arrival_time) > 55"
		);
	
		$passengersInTransitToTSC = (int) ($wpdb->get_var($wpdb->prepare(
			"SELECT SUM(d.passengers) FROM {$prefix}bmp_departures d
			JOIN {$prefix}bmp_locations t ON d.to_location_id = t.id
			WHERE d.to_location_id = %d AND t.name NOT IN ('break', 'parking', 'hotel', 'sent-back')",
			$tscLocationId
		)) ?? 0);
	
		return rest_ensure_response([
			'stats' => [
				'totalBuses' => $totalBuses,
				'totalCompleteTrips' => $totalCompleteTrips,
				'busesInTransitToTSC' => $busesInTransitToTSC,
				'busesInTransitToTerminal' => $busesInTransitToTerminal,
				'passengersArrivedAtTSC' => $passengersArrivedAtTSC,
				'busesOnBreak' => $busesOnBreak,
				'busesSentBack' => $busesSentBack,
				'delayedBuses' => $delayedBuses,
				'passengersInTransitToTSC' => $passengersInTransitToTSC
			]
		]);
	}    

	// dashboard trips
	public static function bmp_get_dashboard_trips( WP_REST_Request $request ) {
		global $wpdb;

		$prefix = $wpdb->prefix;
		$tbl_d  = $prefix . 'bmp_departures';
		$tbl_a  = $prefix . 'bmp_arrivals';
		$tbl_etas = $prefix . 'bmp_location_etas';
		$tbl_b  = $prefix . 'bmp_buses';

		// Sub-query without filters
		$sub_query = "
			SELECT
				d.id                AS trip_id,
				b.d_bus_number,
				lf.name             AS from_location,
				lt.name             AS to_location,
				d.departure_time,
				CASE
					WHEN le.eta_minutes IS NOT NULL
					AND le.eta_minutes != 0
					AND d.departure_time IS NOT NULL
					THEN DATE_ADD(d.departure_time, INTERVAL le.eta_minutes MINUTE)
					ELSE 'NA'
				END AS expected_arrival,
				(
				SELECT a.arrival_time
				FROM {$tbl_a} a
				WHERE a.bus_id = d.bus_id
					AND a.arrival_time > d.departure_time
				ORDER BY a.arrival_time
				LIMIT 1
				) AS arrival_time,
				le.eta_minutes
			FROM {$tbl_d} d
			INNER JOIN {$tbl_b} b
				ON b.id = d.bus_id
			LEFT JOIN {$tbl_etas} le
				ON le.from_location_id = d.from_location_id
				AND le.to_location_id   = d.to_location_id
			INNER JOIN {$prefix}bmp_locations lf
				ON lf.id = d.from_location_id
			INNER JOIN {$prefix}bmp_locations lt
				ON lt.id = d.to_location_id
		";

		$outer_query = "
			SELECT
				t.*,
				CASE
					WHEN LOWER(t.to_location) = 'on break'  THEN 'on-break'
					WHEN LOWER(t.to_location) = 'parking'    THEN 'parking'
					WHEN LOWER(t.to_location) = 'hotel'     THEN 'hotel'
					WHEN LOWER(t.to_location) = 'sent back' THEN 'sent-back'
					WHEN t.eta_minutes IS NOT NULL
						AND t.arrival_time IS NOT NULL
						AND t.arrival_time > DATE_ADD(t.departure_time, INTERVAL (t.eta_minutes + 15) MINUTE)
					THEN 'delayed'
					WHEN t.arrival_time IS NOT NULL THEN 'arrived'
					ELSE 'departed'
				END AS status_slug,
				CASE
					WHEN LOWER(t.to_location) = 'on break'  THEN 'On Break'
					WHEN LOWER(t.to_location) = 'parking'    THEN 'Parking'
					WHEN LOWER(t.to_location) = 'hotel'     THEN 'Hotel'
					WHEN LOWER(t.to_location) = 'sent back' THEN 'Sent Back'
					WHEN t.eta_minutes IS NOT NULL
						AND t.arrival_time IS NOT NULL
						AND t.arrival_time > DATE_ADD(t.departure_time, INTERVAL (t.eta_minutes + 15) MINUTE)
					THEN 'Delayed'
					WHEN t.arrival_time IS NOT NULL THEN 'Arrived'
					ELSE 'Departed'
				END AS status_name,
				CASE
					WHEN t.arrival_time IS NOT NULL
						THEN TIMESTAMPDIFF(MINUTE, t.departure_time, t.arrival_time)
					ELSE TIMESTAMPDIFF(MINUTE, t.departure_time, NOW())
				END AS elapsed_minutes,
				CASE
					WHEN t.eta_minutes IS NOT NULL
						AND t.arrival_time IS NOT NULL
						AND t.arrival_time > DATE_ADD(t.departure_time, INTERVAL (t.eta_minutes + 15) MINUTE)
					THEN 1
					ELSE 0
				END AS delay_status
			FROM ( {$sub_query} ) AS t
		";

		// Run the query (no conditions or parameters needed)
		$results = $wpdb->get_results($outer_query);

		return rest_ensure_response(['success' => true, 'data' => $results]);
	}

	// get locations
	public static function bmp_get_locations() {
		global $wpdb;
		$table = $wpdb->prefix . 'bmp_locations';
	
		$locations = $wpdb->get_results("SELECT * FROM {$table}", ARRAY_A);
		return rest_ensure_response($locations);
	}
	
	// create locations
	public static function bmp_create_location(WP_REST_Request $request) {
		global $wpdb;
		$table = $wpdb->prefix . 'bmp_locations';
	
		$name = sanitize_text_field($request->get_param('name'));
	
		if (empty($name)) {
			return new WP_Error('missing_name', 'Location name is required.', ['status' => 400]);
		}
	
		$inserted = $wpdb->insert($table, ['name' => $name]);
	
		if ($inserted === false) {
			return new WP_Error('db_insert_error', 'Failed to insert location.', ['status' => 500]);
		}
	
		return rest_ensure_response(['message' => 'Location created successfully', 'id' => $wpdb->insert_id]);
	}
	
	// get single location
	public static function bmp_get_single_location(WP_REST_Request $request) {
		global $wpdb;
		$table = $wpdb->prefix . 'bmp_locations';
	
		$id = intval($request->get_param('id'));
	
		$location = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$table} WHERE id = %d", $id), ARRAY_A);
	
		if (!$location) {
			return new WP_Error('not_found', 'Location not found.', ['status' => 404]);
		}
	
		return rest_ensure_response($location);
	}
	
	// update location
	public static function bmp_update_location(WP_REST_Request $request) {
		global $wpdb;
		$table = $wpdb->prefix . 'bmp_locations';
	
		$id = intval($request->get_param('id'));
		$name = sanitize_text_field($request->get_param('name'));
	
		if (empty($name)) {
			return new WP_Error('missing_name', 'Location name is required.', ['status' => 400]);
		}
	
		$updated = $wpdb->update($table, ['name' => $name], ['id' => $id]);
	
		if ($updated === false) {
			return new WP_Error('db_update_error', 'Failed to update location.', ['status' => 500]);
		}
	
		return rest_ensure_response(['message' => 'Location updated successfully']);
	}

	// delete location
	public static function bmp_delete_location(WP_REST_Request $request) {
		global $wpdb;
		$table = $wpdb->prefix . 'bmp_locations';
		$id = intval($request->get_param('id'));
	
		if (!$id) {
			return new WP_Error('missing_id', 'Valid location ID is required.', ['status' => 400]);
		}
	
		// Check if location is used in departures
		$departures_table = $wpdb->prefix . 'bmp_departures';
		$used = $wpdb->get_var(
			$wpdb->prepare(
				"SELECT COUNT(*) FROM {$departures_table} WHERE from_location_id = %d OR to_location_id = %d",
				$id, $id
			)
		);
	
		if ($used > 0) {
			return new WP_Error('location_in_use', 'Location is used in departures and cannot be deleted.', ['status' => 400]);
		}
	
		$deleted = $wpdb->delete($table, ['id' => $id]);
	
		if ($deleted === false) {
			return new WP_Error('db_delete_error', 'Failed to delete location.', ['status' => 500]);
		}
	
		return rest_ensure_response(['message' => 'Location deleted successfully']);
	}

	// Get All Companies
	public static function bmp_get_companies() {
		global $wpdb;
		$table = $wpdb->prefix . 'bmp_companies';
		$companies = $wpdb->get_results("SELECT * FROM $table");
		return rest_ensure_response($companies);
	}

	// Create Company
	public static function bmp_create_company(WP_REST_Request $request) {
		global $wpdb;
		$table = $wpdb->prefix . 'bmp_companies';

		$name = sanitize_text_field($request->get_param('name'));

		if (empty($name)) {
			return new WP_Error('missing_name', 'Company name is required.', ['status' => 400]);
		}

		$inserted = $wpdb->insert($table, ['name' => $name]);

		if ($inserted === false) {
			return new WP_Error('db_insert_error', 'Failed to create company.', ['status' => 500]);
		}

		return rest_ensure_response(['message' => 'Company created successfully', 'id' => $wpdb->insert_id]);
	}

	// Get Single Company by ID
	public static function bmp_get_single_company(WP_REST_Request $request) {
		global $wpdb;
		$table = $wpdb->prefix . 'bmp_companies';
		$id = intval($request->get_param('id'));

		if ($id <= 0) {
			return new WP_Error('invalid_id', 'Valid company ID is required.', ['status' => 400]);
		}

		$company = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %d", $id));

		if (!$company) {
			return new WP_Error('not_found', 'Company not found.', ['status' => 404]);
		}

		return rest_ensure_response($company);
	}

	// Update Company
	public static function bmp_update_company(WP_REST_Request $request) {
		global $wpdb;
		$table = $wpdb->prefix . 'bmp_companies';

		$id = intval($request->get_param('id'));
		$name = sanitize_text_field($request->get_param('name'));

		if (!$id || empty($name)) {
			return new WP_Error('invalid_input', 'Both ID and name are required.', ['status' => 400]);
		}

		$updated = $wpdb->update($table, ['name' => $name], ['id' => $id]);

		if ($updated === false) {
			return new WP_Error('db_update_error', 'Failed to update company.', ['status' => 500]);
		}

		return rest_ensure_response(['message' => 'Company updated successfully']);
	}

	// Delete Company
	public static function bmp_delete_company(WP_REST_Request $request) {
		global $wpdb;
		$table = $wpdb->prefix . 'bmp_companies';

		$id = intval($request->get_param('id'));
		if (!$id) {
			return new WP_Error('invalid_id', 'Valid company ID is required.', ['status' => 400]);
		}

		$deleted = $wpdb->delete($table, ['id' => $id]);

		if ($deleted === false) {
			return new WP_Error('db_delete_error', 'Failed to delete company.', ['status' => 500]);
		}

		if ($deleted === 0) {
			return new WP_Error('not_found', 'Company not found or already deleted.', ['status' => 404]);
		}

		return rest_ensure_response(['message' => 'Company deleted successfully']);
	}

	// submit departure
	public static function submit_departure(WP_REST_Request $request) {
		global $wpdb;
		$prefix = $wpdb->prefix;

		// Sanitize & get inputs
		$bus_id     = intval($request->get_param('bus_id'));
		$from       = intval($request->get_param('from_location_id'));
		$to         = intval($request->get_param('to_location_id'));
		$passengers = $request->get_param('passengers');
		$departure  = sanitize_text_field($request->get_param('departure_time'));

		// Get "to" location name
		$to_location_name = $wpdb->get_var(
			$wpdb->prepare("SELECT name FROM {$prefix}bmp_locations WHERE id = %d", $to)
		);
		$to_location_name = strtolower(trim($to_location_name));

		// Determine if passengers is required
		$requires_passengers = !in_array($to_location_name, ['parking', 'break', 'hotel', 'sent back']);

		// Validate required fields
		if (!$bus_id || !$from || !$to || !$departure || ($requires_passengers && !$passengers)) {
			return new WP_Error('missing_fields', 'All required fields must be provided.', ['status' => 400]);
		}

		// Ensure $passengers is always an integer (even if it's optional)
		$passengers = intval($passengers);

		// Determine status based on to_location name
		switch ($to_location_name) {
			case 'on break':
				$status_slug = 'on-break';
				break;
			case 'parking':
				$status_slug = 'parking';
				break;
			case 'hotel':
				$status_slug = 'hotel';
				break;
			case 'sent back':
				$status_slug = 'sent-back';
				break;
			default:
				$status_slug = 'departed';
				break;
		}

		// Insert departure record
		$inserted = $wpdb->insert("{$prefix}bmp_departures", [
			'bus_id'           => $bus_id,
			'from_location_id' => $from,
			'to_location_id'   => $to,
			'passengers'       => $passengers,
			'departure_time'   => $departure,
		]);

		if ($inserted === false) {
			return new WP_Error('db_insert_error', 'Failed to record departure.', ['status' => 500]);
		}

		// Log status in bmp_bus_statuses
		$log_inserted = $wpdb->insert(
			"{$prefix}bmp_bus_statuses",
			[
				'bus_id'      => $bus_id,
				'status_slug' => $status_slug,
				'created_at'  => current_time('mysql'),
			],
			['%d', '%s', '%s']
		);

		if ($log_inserted === false) {
			return new WP_Error('status_log_error', 'Failed to log status change.', ['status' => 500]);
		}

		return rest_ensure_response([
			'message'        => 'Departure recorded and status updated.',
			'departure_id'   => $wpdb->insert_id,
			'status_slug'    => $status_slug,
		]);
	}
	
	// submit arrival
	public static function submit_arrival(WP_REST_Request $request) {
		global $wpdb;
		$prefix = $wpdb->prefix;
	
		// Sanitize and validate inputs
		$bus_id = intval($request->get_param('bus_id'));
		$arrival_location_id = intval($request->get_param('arrival_location_id'));
		$arrival_time = sanitize_text_field($request->get_param('arrival_time'));
	
		if (!$bus_id || !$arrival_location_id || !$arrival_time) {
			return new WP_Error('missing_fields', 'All fields are required.', ['status' => 400]);
		}
	
		// Get the most recent departure time for this bus
		$last_departure_time = $wpdb->get_var($wpdb->prepare(
			"SELECT departure_time FROM {$prefix}bmp_departures WHERE bus_id = %d ORDER BY departure_time DESC LIMIT 1",
			$bus_id
		));
	
		if ($last_departure_time && strtotime($arrival_time) <= strtotime($last_departure_time)) {
			return new WP_Error('invalid_arrival_time', 'Arrival time must be after the last departure time.', ['status' => 400]);
		}
	
		// Insert into arrivals table
		$inserted = $wpdb->insert("{$prefix}bmp_arrivals", [
			'bus_id' => $bus_id,
			'arrival_location_id' => $arrival_location_id,
			'arrival_time' => $arrival_time,
		]);
	
		if ($inserted === false) {
			return new WP_Error('db_insert_error', 'Failed to record arrival.', ['status' => 500]);
		}
	
		// Use the status_slug directly instead of getting the ID
		$status_slug = 'arrived';
	
		// Insert status change into bmp_bus_statuses table
		$status_logged = $wpdb->insert(
			"{$prefix}bmp_bus_statuses",
			[
				'bus_id' => $bus_id,
				'status_slug' => $status_slug, // Use the slug directly
				'created_at' => current_time('mysql', 1), // use GMT time
			],
			['%d', '%s', '%s']
		);
	
		if ($status_logged === false) {
			return new WP_Error('status_log_error', 'Failed to log status change in bmp_bus_statuses.', ['status' => 500]);
		}
	
		return rest_ensure_response([
			'message' => 'Arrival recorded and status updated in the log.',
			'arrival_id' => $wpdb->insert_id,
			'new_status_slug' => $status_slug
		]);
	}

	// get statuses
	public static function bmp_get_statuses() {
		global $wpdb;
		$prefix = $wpdb->prefix;
	
		$statuses = $wpdb->get_results("SELECT id, name, slug FROM {$prefix}bmp_statuses");
	
		if ($statuses === null || empty($statuses)) {
			return new WP_Error('no_statuses_found', 'No statuses found.', ['status' => 404]);
		}
	
		return rest_ensure_response($statuses);
	}

	// update bus statuse
	public static function bmp_update_bus_status(WP_REST_Request $request) {
		global $wpdb;
		$prefix = $wpdb->prefix;
	
		$bus_number = sanitize_text_field($request['d_bus_number']);
		$status_slug = sanitize_text_field($request['status_slug']);
	
		// Get status ID from the bmp_statuses table based on the slug
		$status_id = $wpdb->get_var(
			$wpdb->prepare("SELECT id FROM {$prefix}bmp_statuses WHERE slug = %s", $status_slug)
		);
	
		if (!$status_id) {
			return new WP_Error('invalid_status', 'Invalid status slug', ['status' => 400]);
		}
	
		// Get the bus ID from the bmp_buses table based on the bus number
		$bus = $wpdb->get_row(
			$wpdb->prepare("SELECT id FROM {$prefix}bmp_buses WHERE bus_number = %s", $bus_number)
		);
	
		if (!$bus) {
			return new WP_Error('bus_not_found', 'Bus not found', ['status' => 404]);
		}
	
		$bus_id = $bus->id;

		$log_table = $prefix . 'bmp_bus_statuses';
		$inserted = $wpdb->insert(
			$log_table,
			[
				'bus_id'    => $bus_id,
				'status_id' => $status_id,
				'created_at' => current_time('mysql', 1), // use GMT time
			],
			['%d', '%d', '%s']
		);
	
		if (!$inserted) {
			return new WP_Error('log_error', 'Failed to log status change', ['status' => 500]);
		}
	
		// Return the success response with bus and status IDs
		return [
			'success' => true,
			'message' => 'Status updated and logged in bmp_bus_statuses table successfully.',
			'bus_id'  => $bus_id,
			'status_id' => $status_id,
		];
	}

	// get status by id
	public static function bmp_get_status_by_id(WP_REST_Request $request) {
		global $wpdb;
		$prefix = $wpdb->prefix;
	
		$id = intval($request->get_param('id'));
	
		if ($id <= 0) {
			return new WP_Error('invalid_id', 'Invalid status ID.', ['status' => 400]);
		}
	
		$status = $wpdb->get_row(
			$wpdb->prepare("SELECT id, name, slug FROM {$prefix}bmp_statuses WHERE id = %d", $id)
		);
	
		if (!$status) {
			return new WP_Error('status_not_found', 'Status not found.', ['status' => 404]);
		}
	
		return rest_ensure_response($status);
	}

	// submit bus status
	public static function bmp_submit_bus_status(WP_REST_Request $request) {
		global $wpdb;
	
		$bus_id = $request->get_param('bus_id');
		$status_id = $request->get_param('status_id');
	
		if (empty($bus_id) || empty($status_id)) {
			return new WP_Error('missing_data', 'Bus ID and Status ID are required.', ['status' => 400]);
		}
	
		$table = $wpdb->prefix . 'bmp_bus_statuses';
		$now = current_time('mysql');
	
		$inserted = $wpdb->insert($table, [
			'bus_id' => $bus_id,
			'status_id' => $status_id,
			'created_at' => $now,
		]);
	
		if (!$inserted) {
			return new WP_Error('db_insert_error', 'Failed to insert bus status.', ['status' => 500]);
		}
	
		return new WP_REST_Response(['message' => 'Bus status submitted successfully'], 200);
	}

	// export trips to excel
	public static function export_trips_to_excel() {
		global $wpdb;
		$prefix = $wpdb->prefix;

		// Get trips (one row per departure)
		$query = "
			SELECT 
				dep.id AS trip_id,
				b.d_bus_number,
				c.name AS company_name,
				DATE_FORMAT(dep.departure_time, '%Y-%m-%d %H:%i:%s') AS departure_time,
				DATE_FORMAT(arr.arrival_time, '%Y-%m-%d %H:%i:%s') AS arrival_time,
				f.name AS from_location,
				t.name AS to_location,
				dep.passengers,
				CASE 
					WHEN dep.departure_time IS NULL OR arr.arrival_time IS NULL THEN NULL
					WHEN TIMESTAMPDIFF(SECOND, dep.departure_time, arr.arrival_time) < 0 THEN NULL
					ELSE CONCAT(
						FLOOR(TIMESTAMPDIFF(SECOND, dep.departure_time, arr.arrival_time) / 3600), 
						'h ',
						MOD(FLOOR(TIMESTAMPDIFF(SECOND, dep.departure_time, arr.arrival_time) / 60), 60),
						'm'
					)
				END AS readable_duration,
				CASE 
					WHEN dep.departure_time IS NULL OR arr.arrival_time IS NULL THEN NULL
					WHEN TIMESTAMPDIFF(MINUTE, dep.departure_time, arr.arrival_time) < 0 THEN NULL
					ELSE TIMESTAMPDIFF(MINUTE, dep.departure_time, arr.arrival_time)
				END AS duration_minutes
			FROM {$prefix}bmp_departures dep
			LEFT JOIN {$prefix}bmp_arrivals arr ON arr.id = dep.id
			LEFT JOIN {$prefix}bmp_buses b ON dep.bus_id = b.id
			LEFT JOIN {$prefix}bmp_companies c ON b.company_id = c.id
			LEFT JOIN {$prefix}bmp_locations f ON dep.from_location_id = f.id
			LEFT JOIN {$prefix}bmp_locations t ON dep.to_location_id = t.id
			ORDER BY dep.id ASC
		";

		$results = $wpdb->get_results($query);

		if (!$results) {
			return new WP_Error('no_data', 'No trips data available.', ['status' => 404]);
		}

		// Set headers for CSV
		header("Content-Type: text/csv; charset=UTF-8");
		header("Content-Disposition: attachment; filename=trips_data_" . date('Y-m-d') . ".csv");
		header("Pragma: no-cache");
		header("Expires: 0");

		$output = fopen('php://output', 'w');

		// Header row
		fputcsv($output, ['Trip ID', 'Bus Number', 'Company', 'Departure Time', 'Arrival Time', 'From', 'To', 'Passengers', 'Trip Duration', 'Trip Duration (min)']);

		foreach ($results as $row) {
			fputcsv($output, [
				$row->trip_id ?? '',
				$row->d_bus_number ?? '',
				$row->company_name ?? '',
				$row->departure_time ?? '',
				$row->arrival_time ?? '',
				$row->from_location ?? '',
				$row->to_location ?? '',
				$row->passengers ?? 0,
				$row->readable_duration ?? '',
				$row->duration_minutes ?? ''
			]);
		}

		fclose($output);
		exit;
	}

	// get location etas
	public static function get_location_etas( $request ) {
		global $wpdb;
		$table = $wpdb->prefix . 'bmp_location_etas';
		$locations = $wpdb->prefix . 'bmp_locations';

		$results = $wpdb->get_results("
			SELECT 
				e.id, 
				e.from_location_id, 
				e.to_location_id, 
				e.eta_minutes,
				LPAD(FLOOR(e.eta_minutes / 60), 2, '0') AS eta_hours,
				LPAD(MOD(e.eta_minutes, 60), 2, '0') AS eta_minutes_only,
				lf.name AS from_location_name,
				lt.name AS to_location_name
			FROM $table e
			LEFT JOIN $locations lf ON e.from_location_id = lf.id
			LEFT JOIN $locations lt ON e.to_location_id = lt.id
		");

		// Optional: Add formatted_eta = "HH:MM" directly in PHP
		foreach ( $results as $result ) {
			$result->formatted_eta = $result->eta_hours . ':' . $result->eta_minutes_only;
		}

		return new WP_REST_Response( $results, 200 );
	}

	// create location etas
	public static function create_location_etas( $data ) {
		global $wpdb;

		// Get and validate input data
		$from_location_id = isset($data['from_location_id']) ? intval($data['from_location_id']) : 0;
		$to_location_id   = isset($data['to_location_id']) ? intval($data['to_location_id']) : 0;
		$eta_minutes = isset($data['eta_minutes']) ? intval($data['eta_minutes']) : 0;

		if ( $from_location_id <= 0 || $to_location_id <= 0 || $eta_minutes <= 0 ) {
			return new WP_REST_Response([
				'success' => false,
				'message' => 'Invalid input: all fields are required and must be positive numbers.',
			], 400);
		}

		// Check if both location IDs exist in the bmp_locations table
		$locations_table = $wpdb->prefix . 'bmp_locations';
		$from_exists = $wpdb->get_var( $wpdb->prepare(
			"SELECT COUNT(*) FROM $locations_table WHERE id = %d", $from_location_id
		) );
		$to_exists = $wpdb->get_var( $wpdb->prepare(
			"SELECT COUNT(*) FROM $locations_table WHERE id = %d", $to_location_id
		) );

		if ( !$from_exists || !$to_exists ) {
			return new WP_REST_Response([
				'success' => false,
				'message' => 'Invalid location IDs: one or both locations do not exist.',
			], 404);
		}

		// Insert into database
		$etas_table = $wpdb->prefix . 'bmp_location_etas';
		$inserted = $wpdb->insert(
			$etas_table,
			[
				'from_location_id' => $from_location_id,
				'to_location_id'   => $to_location_id,
				'eta_minutes'      => $eta_minutes,
			]
		);

		if ( $inserted ) {
			return new WP_REST_Response([
				'success' => true,
				'message' => 'Location ETA created successfully',
				'id'      => $wpdb->insert_id,
			], 201);
		}

		return new WP_REST_Response([
			'success' => false,
			'message' => 'Failed to create Location ETA',
		], 500);
	}

	// get eta by id
	public static function get_eta_by_id( $data ) {
		global $wpdb;

		$id = intval($data['id']);  // Get the ID from URL

		$table_name = $wpdb->prefix . 'bmp_location_etas';
		$result = $wpdb->get_row($wpdb->prepare(
			"SELECT * FROM $table_name WHERE id = %d", $id
		));

		if ($result) {
			// Add formatted ETA (HH:MM)
			$hours = floor($result->eta_minutes / 60);
			$minutes = $result->eta_minutes % 60;
			$result->formatted_eta = sprintf('%02d:%02d', $hours, $minutes);

			return new WP_REST_Response($result, 200);
		}

		return new WP_REST_Response(['message' => 'ETA not found'], 404);
	}

	// update the location etas
	public static function update_location_etas( $data ) {
		global $wpdb;

		$id = isset($data['id']) ? intval($data['id']) : 0;
		$from_location_id = isset($data['from_location_id']) ? intval($data['from_location_id']) : 0;
		$to_location_id = isset($data['to_location_id']) ? intval($data['to_location_id']) : 0;
		$eta_minutes = isset($data['eta_minutes']) ? intval($data['eta_minutes']) : 0;

		if ( $id <= 0 || $from_location_id <= 0 || $to_location_id <= 0 || $eta_minutes <= 0 ) {
			return new WP_REST_Response('Invalid input data. Please ensure all fields are correctly filled.', 400);
		}

		$table_name = $wpdb->prefix . 'bmp_location_etas';

		$existing = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table_name WHERE id = %d", $id ) );

		if ( !$existing ) {
			return new WP_REST_Response('Location ETA with the given ID not found.', 404);
		}

		$updated = $wpdb->update(
			$table_name,
			[
				'from_location_id' => $from_location_id,
				'to_location_id'   => $to_location_id,
				'eta_minutes'      => $eta_minutes,
			],
			[ 'id' => $id ]
		);

		error_log('Location ETA update response: ' . print_r($updated, true));

		if ( $updated === false ) {
			return new WP_REST_Response('Failed to update Location ETA. Please try again later.', 500);
		}

		return new WP_REST_Response('Location ETA updated successfully.', 200);
	}

	// delete location etas
	public static function delete_location_etas( $data ) {
		global $wpdb;

		$id = $data['id'];
		$table_name = $wpdb->prefix . 'bmp_location_etas';
		$deleted = $wpdb->delete( $table_name, ['id' => $id] );

		if ($deleted) {
			return new WP_REST_Response('Location ETA deleted successfully', 200);
		}

		return new WP_REST_Response('Failed to delete Location ETA', 500);
	}

	// validate location pair
	public static function validate_location_pair_callback( WP_REST_Request $request ) {
		// Get the from_location_id and to_location_id from the request
		$from_location_id = $request->get_param('from_location_id');
		$to_location_id = $request->get_param('to_location_id');

		// Check if both location IDs are valid (not empty or invalid)
		if ( empty( $from_location_id ) || empty( $to_location_id ) ) {
			return new WP_REST_Response( [
				'success' => false,
				'message' => 'Both from and to location IDs are required.',
			], 400 );
		}

		// Check if the locations exist in the database 
		global $wpdb;
		$table_name = $wpdb->prefix . 'bmp_locations';
		
		// Validate from_location_id exists
		$from_location_exists = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE id = %d", $from_location_id ) );

		// Validate to_location_id exists
		$to_location_exists = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE id = %d", $to_location_id ) );

		if ( ! $from_location_exists ) {
			return new WP_REST_Response( [
				'success' => false,
				'message' => 'From location does not exist.',
			], 400 );
		}

		if ( ! $to_location_exists ) {
			return new WP_REST_Response( [
				'success' => false,
				'message' => 'To location does not exist.',
			], 400 );
		}

		// If both locations exist, return success
		return new WP_REST_Response( [
			'success' => true,
			'message' => 'Location pair is valid.',
		], 200 );
	}
}
