<?php

namespace Acelle;

use Acelle\Resource\Campaign;
use Acelle\Resource\MailList;
use Acelle\Resource\Subscriber;
use Acelle\Resource\Plan;
use Acelle\Resource\SendingServer;
use Acelle\Resource\Customer;
use Acelle\Resource\Subscription;

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

    public function list() {
        return new MailList([], $this);
    }

    public function subscriber() {
        return new Subscriber([], $this);
    }

    public function plan() {
        return new Plan([], $this);
    }

    public function sendingServer() {
        return new SendingServer([], $this);
    }

    public function customer() {
        return new Customer([], $this);
    }

    public function subscription() {
        return new Subscription([], $this);
    }
}