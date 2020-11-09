<?php

namespace Acelle\Resource;

use Acelle\Resource\Base;

class Subscription extends Base {
    public function getSubject()
    {
        return 'subscription';
    }
}