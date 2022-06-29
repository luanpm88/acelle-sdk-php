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

    public function subscribe($uid, $subscriber_uid)
    {
        return $this->makeRequest($uid . '/subscribers/' . $subscriber_uid . '/subscribe', 'PATCH');
    }

    public function unsubscribe($uid, $subscriber_uid)
    {
        return $this->makeRequest($uid . '/subscribers/' . $subscriber_uid . '/unsubscribe', 'PATCH');
    }
}