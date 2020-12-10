<?php

namespace Acelle\Resource;

use Acelle\Resource\Base;

class Subscription extends Base {
    public function getSubject()
    {
        return 'subscriptions';
    }

    public function activate($uid)
    {
        return $this->makeRequest($uid . '/activate', 'POST');
    }
}