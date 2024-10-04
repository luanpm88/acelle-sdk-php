<?php

namespace Acelle\Resource;

use Acelle\Resource\Base;

class Customer extends Base {
    public function getSubject()
    {
        return 'customers';
    }

    public function disable($uid)
    {
        return $this->makeRequest($uid . '/disable', 'PATCH');
    }

    public function enable($uid)
    {
        return $this->makeRequest($uid . '/enable', 'PATCH');
    }

    public function assignPlan($uid, $plan_uid)
    {
        return $this->makeRequest($uid . '/assign-plan/' . $plan_uid, 'POST');
    }

    public function changePlan($uid, $plan_uid)
    {
        return $this->makeRequest($uid . '/change-plan/' . $plan_uid, 'POST');
    }

    public function findByEmail($email)
    {
        return $this->makeRequest('by-email/' . $email, 'GET');
    }
}