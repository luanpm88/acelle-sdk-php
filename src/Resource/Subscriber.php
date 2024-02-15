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

    public function unsubscribeEmail($email)
    {
        return $this->makeRequest('email/' . $email . '/unsubscribe', 'PATCH');
    }

    public function addTag($uid, $tags)
    {
        return $this->makeRequest($uid . '/add-tag', 'POST', $params);
    }

    public function removeTag($uid, $tags)
    {
        return $this->makeRequest($uid . '/remove-tag', 'POST', $params);
    }
}