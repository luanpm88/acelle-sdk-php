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

    public function subscribe($id)
    {
        return $this->makeRequest($id . '/subscribe', 'PATCH');
    }

    public function unsubscribe($id)
    {
        return $this->makeRequest($id . '/unsubscribe', 'PATCH');
    }

    public function unsubscribeEmail($email)
    {
        return $this->makeRequest('email/' . $email . '/unsubscribe', 'PATCH');
    }

    public function addTag($id, $params)
    {
        return $this->makeRequest($id . '/add-tag', 'POST', $params);
    }

    public function removeTag($id, $params)
    {
        return $this->makeRequest($id . '/remove-tag', 'POST', $params);
    }
}