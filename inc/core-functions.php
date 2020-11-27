<?php

if(!function_exists('get_list_template_from_theme')) {
	function get_list_template_from_theme() {
		if(file_exists(get_template_directory() .'/custom-endpoint/template-endpoint.php')) {
			return get_template_directory() .'/custom-endpoint/template-endpoint.php';
		}
		return false;
	}
}

if(!function_exists('get_single_user_template')) {
	function get_single_user_template() {
		if(file_exists(get_template_directory() .'/custom-endpoint/template-single-user.php')) {
			return get_template_directory() .'/custom-endpoint/template-single-user.php';
		}
		return false;
	}
}