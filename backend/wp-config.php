<?php

if (isset($_SERVER['HTTP_HOST'])) {
    $server_host = $_SERVER['HTTP_HOST'];
} else {
    $server_host = 'localhost'; // Provide a default value
}
define( 'WP_HOME', 'https://' . $server_host );
define( 'WP_SITEURL', 'https://' . $server_host );

// (it gets parsed by the upstream wizard in https://github.com/WordPress/WordPress/blob/f27cb65e1ef25d11b535695a660e7282b98eb742/wp-admin/setup-config.php#L356-L392)

/** The name of the database for WordPress */

/** Database username */
define( 'DB_USER', getenv('WORDPRESS_DB_USER') );

/** Database password */
define( 'DB_PASSWORD', getenv('WORDPRESS_DB_PASSWORD') );

/** Database hostname */
define( 'DB_HOST', getenv('WORDPRESS_DB_HOST') );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('JWT_AUTH_SECRET_KEY', '9Tj8In-*EU/60l4r@bP)ez$9p,NE6TS{)8+c-;ZSQ`04*]ZKVZ35O48h3c|-SgH');
define('JWT_AUTH_CORS_ENABLE', true);

define('ALLOW_UNFILTERED_UPLOADS', true);

define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true);

define( 'AUTH_KEY',         '6d1ca5ecf6a40866e09067b9e74b55e181bb8b75' );
define( 'SECURE_AUTH_KEY',  'b62ef4af54ce5d8a29c73c049cfc1155d0f14a5a' );
define( 'LOGGED_IN_KEY',    'd2e2a9c4ca5d24e473ea8737f3c89e95b98945f5' );
define( 'NONCE_KEY',        '76bb1c5dc8c1192090b17c55f98baa7f6393c38d' );
define( 'AUTH_SALT',        '53802a88ee6d07ba7a2e7f56a834eb2772593a0d' );
define( 'SECURE_AUTH_SALT', 'fd8df82e57001933bc1d55897eab78b37bf9fde4' );
define( 'LOGGED_IN_SALT',   '5dcbe53e6df0b150162056734198fa0fd51b8102' );
define( 'NONCE_SALT',       '8618a666aab2bdde8723a21bae7e8bfd8b28dcbb' );

/**#@-*/

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * This has been slightly modified (to read environment variables) for use in Docker.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// IMPORTANT: this file needs to stay in-sync with https://github.com/WordPress/WordPress/blob/master/wp-config-sample.php
// (it gets parsed by the upstream wizard in https://github.com/WordPress/WordPress/blob/f27cb65e1ef25d11b535695a660e7282b98eb742/wp-admin/setup-config.php#L356-L392)

/* That's all, stop editing! Happy publishing. */




/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
