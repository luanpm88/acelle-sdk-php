<?php

namespace Acelle\Resource;

use Acelle\Resource\Base;

class SendingServer extends Base {
    public function getSubject()
    {
        return 'sending_servers';
    }
}