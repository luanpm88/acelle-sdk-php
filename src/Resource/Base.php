<?php

namespace Acelle\Resource;

class Base {
    private $client;
    
    public function getSubject() {}

    public function __construct($attributes = [], $client)
    {
        $this->client = $client;
    }

    public function all($params = []) {
		return $this->makeRequest('', 'GET', $params);
	}

    public function create($params) {
		return $this->makeRequest('', 'POST', $params);
    }
    
    public function find($uid) {
		return $this->makeRequest($uid, 'GET');
	}

	public function makeRequest($action = '', $method = 'POST', $params = [], $headers = []) {
        $uri = $this->client->getUri() . '/' . $this->getSubject() . 's';
        if ($action) {
            $uri = $uri . '/' . $action;
        }

        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $headers = array_merge([
            'Content-Type' => 'application/json',
        ], $headers);
        try {
            $response = $client->request($method, $uri, [
                'headers' => $headers,
                'body' => json_encode(array_merge(['api_token' => $this->client->getToken()], $params)),
            ]);
        } catch (\Exception $e) {
            echo 'Uh oh! ' . $e->getMessage();
            exit();
        }
        
        return json_decode($response->getBody(), true);
	}
}