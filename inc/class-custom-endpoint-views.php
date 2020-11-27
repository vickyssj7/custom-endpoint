<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Custom_Endpoint_Views {
	public function __construct() {
		add_action( 'init', array( $this, 'initEndpoint' ) );
		add_filter( 'query_vars', array( $this, 'query_vars' ) );
		add_action( 'template_include', array( $this, 'listUsers' ) );
	}
	
	public function initEndpoint() {
		add_rewrite_endpoint( get_option('custom_endpoint_slug'), EP_PERMALINK );
		add_rewrite_rule( '^'. get_option('custom_endpoint_slug') .'$', 'index.php?'. get_option('custom_endpoint_slug') .'=1', 'top' );
		
		if(get_transient( 'custom_endpoint_flush' )) {
			delete_transient( 'custom_endpoint_flush' );
			flush_rewrite_rules();
		}
	}
	
	function query_vars( $query_vars ) {
		$query_vars[] = get_option('custom_endpoint_slug');
		return $query_vars;
	}

	
	public function listUsers( $template ) {
		if( get_query_var( get_option('custom_endpoint_slug'), false ) !== false ) {

			//if template being loaded from theme...
			$endpointTemplate = get_theme_template_directory();
			if( $endpointTemplate )
				return $endpointTemplate;

			$endpointTemplate = CUSTOM_ENDPOINT_TEMPLATE_PATH . '/template-endpoint.php';
			return $endpointTemplate;
		}
		
		return  $template;
	}
}

new Custom_Endpoint_Views();