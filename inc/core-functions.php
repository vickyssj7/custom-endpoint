<?php

if(!function_exists('get_theme_template_directory')) {
	function get_theme_template_directory() {
		if(file_exists(get_template_directory() .'/templates/template-endpoint.php')) {
			return get_template_directory() .'/templates/template-endpoint.php';
		}
		return false;
	}
}