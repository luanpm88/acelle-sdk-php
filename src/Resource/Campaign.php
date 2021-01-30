<?php

namespace Acelle\Resource;

use Acelle\Resource\Base;

class Campaign extends Base {
    public function getSubject()
    {
        return 'campaigns';
    }
    public function pause($uid) {
        return $this->makeRequest($uid . '/pause', 'POST');
    }
}