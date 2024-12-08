<?php

namespace Acelle\Resource;

use Acelle\Resource\Base;

class MailList extends Base {
    public function getSubject()
    {
        return 'lists';
    }

    public function addCustomField($uid, $params) {
        return $this->makeRequest($uid . '/' . 'add-field', 'POST', $params);
    }

    public function subscribe($uid, $subscriber_id)
    {
        return $this->makeRequest($uid . '/subscribers/' . $subscriber_id . '/subscribe', 'PATCH');
    }

    public function unsubscribe($uid, $subscriber_id)
    {
        return $this->makeRequest($uid . '/subscribers/' . $subscriber_id . '/unsubscribe', 'PATCH');
    }

    public function unsubscribeEmail($uid, $email)
    {
        return $this->makeRequest($uid . '/subscribers/email/' . $email . '/unsubscribe', 'PATCH');
    }
}