<?php

namespace Acelle\Resource;

use Acelle\Resource\Base;

class Notification extends Base {
    public function getSubject()
    {
        return 'notification';
    }

    public function read() {
        return $this->makeRequest('', 'POST');
    }
}