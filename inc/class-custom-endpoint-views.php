<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Custom_Endpoint_Views {
	public function __construct() {
		add_filter( 'query_vars', array( $this, 'queryVars' ) );
		add_action( 'template_include', array( $this, 'listUsers' ) );
	}
	
	public function listUsers( $template ) {
		global $wp_query;
		if ( $wp_query->query_vars['name'] !== get_option('custom_endpoint_slug') ) {
			return $template;
		}
		
		//if template being loaded from theme...
		if( get_custom_template_directory() ) {
			include_once( get_custom_template_directory() );
		} else {
			include_once( CUSTOM_ENDPOINT_TEMPLATE_PATH . '/template-endpoint.php' );
		}
	}
	
	public function queryVars( $query_vars ) {
		$query_vars[] = get_option('custom_endpoint_slug');
		return $query_vars;
	}
}

new Custom_Endpoint_Views();