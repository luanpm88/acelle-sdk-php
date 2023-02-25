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
    public function run($uid) {
        return $this->makeRequest($uid . '/run', 'POST');
    }
    public function resume($uid) {
        return $this->makeRequest($uid . '/resume', 'POST');
    }
    public function delete($uid) {
        return $this->makeRequest($uid, 'DELETE');
    }
}