<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Custom_Endpoint_Main {
	protected static $_instance = null;
	
	public function __construct() {
		if(phpversion() >= 7.2) {
			if(get_option('custom_endpoint_activated')) {
				$this->includes();
				$this->init_hooks();
			}
		} else {
			$this->admin_notices();
		}
	}
	
	public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
	
	public function includes() {
		include_once(dirname(CUSTOM_ENDPOINT_PLUGIN_FILE) . '/inc/core-functions.php');
		include_once(dirname(CUSTOM_ENDPOINT_PLUGIN_FILE) . '/inc/class-custom-endpoint-options.php');
		include_once(dirname(CUSTOM_ENDPOINT_PLUGIN_FILE) . '/inc/class-custom-endpoint-views.php');
	}
	
	public function init_hooks() {
		add_action('admin_menu', array($this, 'add_menu_page'));
		add_action('wp_enqueue_scripts', array($this, 'equeue_scripts'));
	}
	
	public function equeue_scripts() {
		wp_enqueue_style( CUSTOM_ENDPOINT_PLUGIN_PREFIX .'-fawsm', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
		wp_enqueue_style( CUSTOM_ENDPOINT_PLUGIN_PREFIX .'-datatable-css', 'https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css' );
		wp_enqueue_style( CUSTOM_ENDPOINT_PLUGIN_PREFIX .'-main-css', esc_url( plugins_url( 'css/main.css', dirname(__FILE__) ) ) );
		wp_enqueue_script( CUSTOM_ENDPOINT_PLUGIN_PREFIX .'-datatable-js', 'https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js' );
		wp_enqueue_script( CUSTOM_ENDPOINT_PLUGIN_PREFIX .'-main-js', esc_url( plugins_url( 'js/main.js', dirname(__FILE__) ) ) , array(), '', true );
	}
	
	public function add_menu_page() {
		add_options_page('Custom Endpoint', 'Custom Endpoint', 'manage_options', 'custom-endpoint', array('Custom_Endpoint_Options', 'endpoint_settings'), 6);
	}
	
	/**
     * Display admin notice
     */
    public function admin_notices() {
        echo '<div class="error"><p>';
        echo _e( 'This plugin requires at least php version 7.2, please update your php version to latest version to install the plugin.', CUSTOM_ENDPOINT_PLUGIN_PREFIX );
        echo '</p></div>';
    }
}