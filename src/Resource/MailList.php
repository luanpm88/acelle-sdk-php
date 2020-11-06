<?php

namespace Acelle\Resource;

use Acelle\Resource\Base;

class MailList extends Base {
    public function getSubject()
    {
        return 'list';
    }
}