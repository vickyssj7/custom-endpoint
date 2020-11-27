<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Custom_Endpoint_Options {
	
	public function endpoint_settings() {
		$error = [];
		if(isset($_POST['submit'])) {
			if(! wp_verify_nonce( $_POST['_wpnonce'], 'custom_endpoint_nonce' ) ) {
				$error[] = "CSRF token mismatch, please try again by refreshing your browser window.";
			}
			
			if(empty($error)) {
				update_option('custom_endpoint_slug', filter_var($_POST['custom_endpoint'], FILTER_SANITIZE_STRING));
				add_rewrite_endpoint( get_option('custom_endpoint_slug'), EP_PERMALINK );
				add_rewrite_rule( '^'. get_option('custom_endpoint_slug') .'$', 'index.php?'. get_option('custom_endpoint_slug') .'=1', 'top' );
				flush_rewrite_rules();
				$success = true;
			}
			
		}
		
		include_once(CUSTOM_ENDPOINT_TEMPLATE_PATH .'/admin/settings.php');
	}
}