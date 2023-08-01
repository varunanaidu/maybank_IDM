<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guzzle{
	
	protected $client;
	protected $cookieJar;
	protected $api_metrofest;


	function __construct(){
		$this->client 			= new \GuzzleHttp\Client();
		$this->cookieJar 		= new \GuzzleHttp\Cookie\CookieJar();
		$this->api_metrofest 	= 'https://metrofest/mediagroupnetwork.com/api/';
		
	}

	function guzzle_metrofest($uri = false){

		$url = $this->api_metrofest;
		if ( $uri ) {
			$url = $this->api_metrofest.$uri;
		}

		try{
			$response = $this->client->request('GET', $url, [
				'cookies' => $this->cookieJar
			]);
			return $response->getBody()->getContents();
		} 
		catch (\GuzzleHttp\Exception\BadResponseException $e){
			$response = $e->getResponse();
			$statusCode = $response->getStatusCode();
			// $responseBodyAsString = $response->getBody()->getContents();
			// return $responseBodyAsString;
			return json_encode([
				'type'			=> 'error',
				'status'		=> 'error',
				'status_code'	=> $statusCode,
				'message'		=> 'error'
			]);
		}

	}
} 