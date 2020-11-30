<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


class Custom_Endpoint_Jsonlist {
	
	private $client;
	
	public function __construct() {
		$this->client = new \GuzzleHttp\Client();
		$this->api_endpoint = 'https://jsonplaceholder.typicode.com';
		add_action( 'wp_ajax_users_list', array( $this, 'getUsersList' ) );
		add_action( 'wp_ajax_nopriv_users_list', array( $this, 'getUsersList' ) );
		add_action( 'wp_ajax_single_user', array( $this, 'getSingleUser' ) );
		add_action( 'wp_ajax_nopriv_single_user', array( $this, 'getSingleUser' ) );
	}
	
	public function getUsersList() {
		try {
			$response = $this->client->request('GET', $this->api_endpoint .'/users');
			if($response->getStatusCode() == 200) {
				$data = [];
				$data['draw'] = 1;
				$result = apply_filters('custom_endpoint_users_json_list', json_decode($response->getBody(), true));
				if(!empty($result) && is_array($result)) {
					$data['recordsTotal'] = count($result);
					$data['recordsFiltered'] = count($result);
					foreach($result as $obj) {
						$data['data'][] = [
							$obj['id'],
							$obj['name'],
							$obj['username'],
							$obj['email'],
							$obj['phone'],
							'<a href = "http://'. $obj['website'] .'" target="_blank">'. $obj['website'] .'</a>',
							'<a href = "#" data-userid="'. $obj['id'] .'" class = "view-user">View</a>'
						];
					}
				}
				return wp_send_json($data);
			}
			return wp_send_json(['error' => 'Something went wrong'], 422);
			
		} catch(\Exception $e) {
			return wp_send_json(['error' => $e->getMessage() .', Line:  '. $e->getLine()], 500);
		}
		
	}
	
	public function getSingleUser() {
		if((int) $_GET['id']) {
			try {
				$response = $this->client->request('GET', $this->api_endpoint .'/users/'. (int) $_GET['id']);
				if($response->getStatusCode() == 200) {
					$result = apply_filters('custom_endpoint_single_user_detail', json_decode($response->getBody()));
					ob_start();
					//if template being loaded from theme...
					$singleUserTemplate = get_single_user_template();
					if( $singleUserTemplate ) {
						include_once($singleUserTemplate);
					} else {
						$singleUserTemplate = CUSTOM_ENDPOINT_TEMPLATE_PATH . '/template-single-user.php';
						include_once($singleUserTemplate);
					}
					$content = ob_get_clean();
					return wp_send_json(['data' => $content]);
				}
				return wp_send_json(['error' => 'Something went wrong'], 422);
			} catch(\Exception $e) {
				return wp_send_json(['error' => $e->getMessage() .', Line:  '. $e->getLine()], 500);
			}
		}
		return wp_send_json(['error' => 'Invalid ID Pass.'], 422);
	}
	
	public function tableHeaders() {
		return apply_filters('custom_endpoint_table_headers', [
			'id' => 'Id',
			'name' => 'Name',
			'username' => 'User Name',
			'email' => 'Email',
			'phone' => 'Phone',
			'website' => 'Website',
		]);
	}

}

$GLOBALS['json_placeholder_data'] = new Custom_Endpoint_Jsonlist();