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
		add_action( 'wp_ajax_nopriv_single_user', array( $this, 'getSingleUser' ) );
	}
	
	public function getUsersList() {
		try {
			$response = $this->client->request('GET', $this->api_endpoint .'/users');
			if($response->getStatusCode() == 200) {
				$data = [];
				$data['draw'] = 1;
				$result = json_decode($response->getBody());
				if(!empty($result) && is_array($result)) {
					$data['recordsTotal'] = count($result);
					$data['recordsFiltered'] = count($result);
					foreach($result as $obj) {
						$data['data'][] = [
							$obj->id,
							$obj->name,
							$obj->username,
							$obj->email,
							$obj->phone,
							$obj->website,
							'<a href = "#" data-userid="'. $obj->id .'" class = "view-user">View</a>'
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
		try {
			$response = $this->client->request('GET', $this->api_endpoint .'/users/1');
			if($response->getStatusCode() == 200) {
				$result = json_decode($response->getBody());
				return wp_send_json($result, 200);
			}
			return wp_send_json(['error' => 'Something went wrong'], 422);
		} catch(\Exception $e) {
			return wp_send_json(['error' => $e->getMessage() .', Line:  '. $e->getLine()], 500);
		}
	}
	
	public function tableHeaders() {
		return [
			'id' => 'Id',
			'name' => 'Name',
			'username' => 'User Name',
			'email' => 'Email',
			'phone' => 'Phone',
			'website' => 'Website',
		];
	}

}

$GLOBALS['json_placeholder_data'] = new Custom_Endpoint_Jsonlist();