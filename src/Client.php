<?php

namespace Acelle;

use Acelle\Resource\Campaign;

class Client {
    private $token;
    private $uri;

    public function __construct($uri, $token)
    {
        $this->uri = $uri;
        $this->token = $token;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function campaign() {
        return new Campaign([], $this);
    }
}