<?php

declare(strict_types=1);

require_once('./vendor/autoload.php');

use PHPUnit\Framework\TestCase;
use Brain\Monkey;

class Custom_Endpoint_Test extends TestCase {
	
	private $client;
	private $api_endpoint;
	private $endpoint_cls;
	
	protected function setUp(): void {
		parent::setUp();
		Monkey\setUp();
		$this->client = new \GuzzleHttp\Client();
		$this->api_endpoint = 'https://jsonplaceholder.typicode.com';
	}
	
	public function testGetUsersList() {
		$response = $this->client->request('GET', $this->api_endpoint .'/users');
		$this->assertEquals(200, $response->getStatusCode());
		
		// print_r($response->getBody());
		// $data = json_decode($response->getBody(), true);
		// $this->assertArrayHasKey('username', $data);
	}
	
	protected function tearDown(): void {
		parent::tearDown();
		Monkey\tearDown();
		$this->client = null;
		$this->api_endpoint = null;
	}
}