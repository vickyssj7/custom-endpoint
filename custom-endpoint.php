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

add_filter( 'plugins_loaded', array( 'Custom_Endpoint_Init', 'instance' ) );

class Custom_Endpoint_Init {
	
	protected static $_instance = null;
	
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	public function __construct() {
		$this->defineHelpers();
		$this->hooks();
		// Include the main class.
		if ( ! class_exists( 'Custom_Endpoint_Main' ) ) {
			include_once dirname( __FILE__) . '/inc/class-custom-endpoint-main.php';
		}
		Custom_Endpoint_Main::instance();
	}
	
	public function defineHelpers() {
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
	}

	public function hooks() {
		register_activation_hook( __FILE__, array($this, 'install') );
		register_deactivation_hook( __FILE__, array($this, 'uninstall') );
	}
	
	public function install() {
		set_transient( 'custom_endpoint_flush', 1, 60 );
		$custom_endpoint = CUSTOM_ENDPOINT_DEFAULT;
		update_option('custom_endpoint_slug', $custom_endpoint);
		update_option('custom_endpoint_activated', 1);
	}

	public function uninstall() {
		flush_rewrite_rules();
		delete_option('custom_endpoint_slug');
		update_option('custom_endpoint_activated', 0);
	}
}
