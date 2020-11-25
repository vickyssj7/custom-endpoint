<?php

if(!function_exists('get_custom_template_directory')) {
	function get_custom_template_directory() {
		if(file_exists(get_template_directory() .'/custom-endpoint/endpoint.php')) {
			return get_template_directory() .'/custom-endpoint/template-endpoint.php';
		}
		return false;
	}
}