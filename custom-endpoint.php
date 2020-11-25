<?php
/**
 * Plugin Name: Custom Endpoint.
 * Description: Custom Endpoint URL.
 * Author: Rajender Kumar
 * Version: 1.0
*/


if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define CUSTOM_ENDPOINT_PLUGIN_FILE.
if ( ! defined( 'CUSTOM_ENDPOINT_PLUGIN_FILE' ) ) {
    define( 'CUSTOM_ENDPOINT_PLUGIN_FILE', __FILE__);
}

// Define CUSTOM_ENDPOINT_PLUGIN_PREFIX.
if ( ! defined( 'CUSTOM_ENDPOINT_PLUGIN_PREFIX' ) ) {
    define( 'CUSTOM_ENDPOINT_PLUGIN_PREFIX', 'custom-endpoint');
}

if( !defined('CUSTOM_ENDPOINT_TEMPLATE_PATH') ) {
	define('CUSTOM_ENDPOINT_TEMPLATE_PATH', dirname(__FILE__) .'/views');
}

if( !defined('CUSTOM_ENDPOINT_DEFAULT') ) {
	define('CUSTOM_ENDPOINT_DEFAULT', 'json-placeholder-users');
}

register_activation_hook(__FILE__, 'install' );
register_deactivation_hook(__FILE__, 'uninstall' );
function install() {
	$custom_endpoint = CUSTOM_ENDPOINT_DEFAULT;
	
	add_action( 'init',  function() use($custom_endpoint) {
		 add_rewrite_rule( $custom_endpoint .'/?$', 'index.php?'. $custom_endpoint, 'top' );
	});
	flush_rewrite_rules();
	update_option('custom_endpoint_slug', $custom_endpoint);
	update_option('custom_endpoint_activated', 1);
}

function uninstall() {
	flush_rewrite_rules();
	delete_option('custom_endpoint_slug');
	update_option('custom_endpoint_activated', 0);
}

// Include the main class.
if ( ! class_exists( 'Custom_Endpoint_Main' ) ) {
    include_once dirname( __FILE__) . '/inc/class-custom-endpoint-main.php';
}

function custom_endpoint_init(){
    return Custom_Endpoint_Main::instance();
}
custom_endpoint_init();
