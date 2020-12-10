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
}