<?php

namespace Acelle\Resource;

class Base {
    private $client;
    
    public function getSubject() {
        return false;
    }

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
    
    public function update($uid, $params) {
		return $this->makeRequest($uid, 'PATCH', $params);
    }
    
    public function delete($uid) {
		return $this->makeRequest($uid, 'DELETE');
	}

	public function makeRequest($action = '', $method = 'POST', $params = [], $headers = []) {
        $uri = $this->client->getUri();
        
        if ($this->getSubject()) {
            $uri = $uri . '/' . $this->getSubject();
        }
        if ($action) {
            $uri = $uri . '/' . $action;
        }
        
        $client = new \GuzzleHttp\Client(['http_errors' => true, 'verify' => false]);
        $headers = array_merge([
            'Content-Type' => 'application/json',
        ], $headers);
        try {
            $response = $client->request($method, $uri, [
                'headers' => $headers,
                'body' => json_encode(array_merge(['api_token' => $this->client->getToken()], $params)),
            ]);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            /**
             * Here we actually catch the instance of GuzzleHttp\Psr7\Response
             * (find it in ./vendor/guzzlehttp/psr7/src/Response.php) with all
             * its own and its 'Message' trait's methods. See more explanations below.
             *
             * So you can have: HTTP status code, message, headers and body.
             * Just check the exception object has the response before.
             */
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                var_dump((string) $response->getBody()); // Body, normally it is JSON;
            }
            // return;
        }
        
        return json_decode($response->getBody(), true);
	}
}