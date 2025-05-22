<?php
/**
 * Plugin Name: Bus Management System
 * Description: Custom plugin to handle bus registration, departures, arrivals, and trip management.
 * Version: 1.0
 * Author: RSSB
 */

require_once plugin_dir_path( __FILE__ ) . 'includes/class-bus-management.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-api-endpoints.php';

// Register activation and deactivation hooks
register_activation_hook( __FILE__, array( 'Bus_Management', 'create_tables' ) );
register_deactivation_hook( __FILE__, array( 'Bus_Management', 'drop_tables' ) );

// Set CORS headers for API requests
add_action( 'init', 'set_cors_headers', 1 );
function set_cors_headers() {
	header('Access-Control-Allow-Origin: http://localhost:3000');
	header('Access-Control-Allow-Credentials: true');
	header('Access-Control-Allow-Headers: Authorization, Content-Type, X-BMP-Token');
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
}

// Handle OPTIONS request for CORS preflight
add_action( 'init', 'handle_options_request', 0 );
function handle_options_request() {
	if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
		header("Access-Control-Allow-Origin: http://localhost:3000");
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
		header("Access-Control-Allow-Credentials: true");
		header("Access-Control-Allow-Headers: Content-Type, Authorization, X-BMP-Token");
		exit;
	}
}

// Register API routes
add_filter( 'jwt_auth_token_before_dispatch', 'custom_jwt_payload', 10, 3 );
add_filter( 'rest_pre_dispatch', array( 'API_Endpoints', 'bmp_authenticate_requests' ), 10, 3 );
add_action( 'rest_api_init', array( 'API_Endpoints', 'register_routes' ) );

// Export trips data to Excel
add_action('wp_ajax_export_trips', 'export_trips_to_excel'); // For logged-in users
// add_action('wp_ajax_nopriv_export_trips', 'export_trips_to_excel'); // Uncomment for non-logged-in users if needed

// Initialize the plugin
function initialize_bus_management_plugin() {
	new Bus_Management();
}

initialize_bus_management_plugin();
