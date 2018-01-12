<?php
/*
Plugin Name:  WP Easy Notices
Plugin URI:   https://wordpress.org/plugins/wp-easy-notices/
Description:  Easily add a sitewide notice banner to your site!
Version:      1.0.0
Author:       Nate Conley
Author URI:   https://nateconley.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  wp-easy-notices
Domain Path:  /lang
*/

if ( ! defined( 'WP_EASY_NOTICES_VERSION' ) ) {
	define( 'WP_EASY_NOTICES_VERSION', '1.0.0' );
}

if ( ! defined( 'WP_EASY_NOTICES_SLUG' ) ) {
	define( 'WP_EASY_NOTICES_SLUG', 'wp_easy_notices' );
}

if ( ! defined( 'WP_EASY_NOTICES_NAME' ) ) {
	define( 'WP_EASY_NOTICES_NAME', 'WP Easy Notices', 'wp-easy-notices' );
}

if ( ! defined( 'WP_EASY_NOTICES_LIB_PATH' ) ) {
	define(
		'WP_EASY_NOTICES_LIB_PATH',
		trailingslashit( plugin_dir_path( __FILE__ ) . 'lib' )
	);
}

if ( ! defined( 'WP_EASY_NOTICES_DIST_URL' ) ) {
	define(
		'WP_EASY_NOTICES_DIST_URL',
		trailingslashit( plugin_dir_url( __FILE__ ) . 'dist' )
	);
}

if ( ! defined( 'WP_EASY_NOTICES_SVG_PATH' ) ) {
	define(
		'WP_EASY_NOTICES_SVG_PATH',
		trailingslashit( plugin_dir_path( __FILE__ ) . 'src/svgs' )
	);
}

// Require dependencies
require_once WP_EASY_NOTICES_LIB_PATH . 'customizer.php';
require_once WP_EASY_NOTICES_LIB_PATH . 'front-end.php';
