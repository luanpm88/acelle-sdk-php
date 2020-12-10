<?php

namespace Acelle\Resource;

use Acelle\Resource\Base;

class Subscriber extends Base {
    public function getSubject()
    {
        return 'subscribers';
    }

    public function findByEmail($email)
    {
        return $this->makeRequest('email/' . $email, 'GET');
    }

    public function subscribe($uid)
    {
        return $this->makeRequest($uid . '/subscribe', 'PATCH');
    }

    public function unsubscribe($uid)
    {
        return $this->makeRequest($uid . '/unsubscribe', 'PATCH');
    }
}