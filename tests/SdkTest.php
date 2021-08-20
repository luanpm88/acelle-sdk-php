<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class SdkTest extends TestCase
{
    public function getClient() {
        return new \Acelle\Client('https://api-test.com/api/v1', 'jNSlIRWN7IRTKGzH2PaHiNfQO00AOmi4N0o3nYjxCGHpgzRBTECRuBSdcPc6');
    }

    public function testLoginToken() {
        $this->assertArrayHasKey('token', $this->getClient()->loginToken());
    }

    public function testListCreate() {
        $list = $this->getClient()->list()->create([
            'name' => 'List+1',
            'from_email' => 'admin@abccorp.org',
            'from_name' => 'ABC+Corp.',
            'default_subject' => 'Welcome+to+ABC+Corp.',
            'contact' => [
                'company' => 'ABC+Corp.',
                'state' => 'Armagh',
                'address_1' => '14+Tottenham+Court+Road+London+England',
                'address_2' => '44-46+Morningside+Road+Edinburgh+Scotland',
                'city' => 'Noname',
                'zip' => '80000',
                'phone' => '123+456+889',
                'country_id' => '1',
                'email' => 'info@abccorp.org',
                'url' => 'http://www.abccorp.org',                
            ],
            'subscribe_confirmation' => '1',
            'send_welcome_email' => '1',
            'unsubscribe_notification' => '1',
        ]);

        $this->assertArrayHasKey('status', $list);
        return $list;
    }

    public function testListAll() {
        $this->assertIsArray($this->getClient()->list()->all());
    }

    public function pickAList() {
        return $this->getClient()->list()->all()[0];
    }

    public function testListFind() {
        $list = $this->pickAList();
        $this->assertIsArray($this->getClient()->list()->find($list['uid']));
    }

    public function testListAddCustomField() {
        $list = $this->pickAList();
        $this->assertIsArray($this->getClient()->list()->addCustomField($list['uid'], [
            'type' => 'text',
            'label' => 'Custom',
            'tag' => 'CUSTOM_FIELD_' . uniqid(),
            'default_value' => 'test',
        ]));
    }

    public function testSubscriberAll() {
        $list = $this->pickAList();
        $this->assertIsArray($this->getClient()->subscriber()->all([
            'list_uid' => $list['uid'],
            'per_page' => '20',
            'page' => '1',
        ]));
    }

    public function testSubscriberCreate() {
        $list = $this->pickAList();
        $this->assertIsArray($this->getClient()->subscriber()->create([
            'list_uid' => $list['uid'],
            'EMAIL' => 'test'.uniqid().'@gmail.com',
            'tag' => 'foo,bar,tag+with+space,',
            'FIRST_NAME' => 'Marine',
            'LAST_NAME' => 'Joze',
        ]));
    }

    public function pickASubscriber() {
        $list = $this->pickAList();
        return $this->getClient()->subscriber()->all([
            'list_uid' => $list['uid'],
            'per_page' => '1',
            'page' => '1',
        ])[0];
    }

    public function testSubscriberFind() {
        $subscriber = $this->pickASubscriber();
        $this->assertIsArray($this->getClient()->subscriber()->find($subscriber['uid']));
    }
    
    public function testSubscriberFindByEmail() {
        $subscriber = $this->pickASubscriber();
        $this->assertIsArray($this->getClient()->subscriber()->findByEmail($subscriber['email']));
    }

    public function testSubscriberUpdate() {
        $subscriber = $this->pickASubscriber();
        $this->assertIsArray($this->getClient()->subscriber()->update($subscriber['uid'], [
            'EMAIL' => $subscriber['email'],
            'tag' => 'foo,bar,tag+with+space,',
            'FIRST_NAME' => 'Marine',
            'LAST_NAME' => 'Joze',
        ]));
    }

    public function testSubscriberUnsubscribe() {
        $subscriber = $this->pickASubscriber();
        var_dump($this->getClient()->subscriber()->unsubscribe($subscriber['uid']));die();
        $this->assertIsArray($this->getClient()->subscriber()->unsubscribe($subscriber['uid']));
    }

    // public function testSubscriberSubscribe() {
    //     $subscriber = $this->pickASubscriber();
    //     $this->assertIsArray($this->getClient()->subscriber()->subscribe($subscriber['uid']));
    // }

    // public function testSubscriberDelete() {
    //     $subscriber = $this->pickASubscriber();
    //     $this->assertIsArray($this->getClient()->subscriber()->delete($subscriber['uid']));
    // }

    // public function testCampaignAll() {
    //     $this->assertIsArray($this->getClient()->campaign()->all());
    // }
    
    // public function testCampaignFind() {
    //     $this->assertIsArray($this->getClient()->campaign()->find('5fb48ff221b27'));
    // }

    // public function testNotificationAll() {
    //     $this->assertIsArray($this->getClient()->notification()->read([
    //         'type' => 'sent',
    //     ]));

    //     $this->assertIsArray($this->getClient()->notification()->read([
    //         'type' => 'bounced',
    //         'bounced_type' => 'hard',
    //     ]));

    //     $this->assertIsArray($this->getClient()->notification()->read([
    //         'type' => 'abuse',
    //         'report_type' => 'hard',
    //     ]));
    // }

    // public function testFileUpload() {
    //     $this->assertIsArray($this->getClient()->file()->upload([
    //         'files' => '[{"url":"http://demo.acellemail.com/images/logo_big.svg","subdirectory":"path/to/file"},{"url":"http://demo.acellemail.com/images/logo_big.svg","subdirectory":"path/to/file2"}]',
    //     ]));
    // }

    // public function testPlanAll() {
    //     $this->assertIsArray($this->getClient()->plan()->all());
    // }

    // public function testPlanCreate() {
    //     $this->assertIsArray($this->getClient()->plan()->create([
    //         'name' => 'Advanced',
    //         'currency_id' => '1',
    //         'frequency_amount' => '1',
    //         'frequency_unit' => 'month',
    //         'price' => '20',
    //         'color' => 'red',
    //         'options[sending_server_option]' => 'own',
    //         'options[email_max]' => '10000',
    //     ]));
    // }

    // public function testSendingServerAll() {
    //     $this->assertIsArray($this->getClient()->sending_server()->all());
    // }

    // public function testCustomerCreate() {
    //     $this->assertIsArray($this->getClient()->customer()->create([
    //         'email' => 'user_namexx@gmail.com',
    //         'first_name' => 'Luan',
    //         'last_name' => 'Pham',
    //         'timezone' => 'America/Godthab',
    //         'language_id' => '1',
    //         'password' => '123456',
    //     ]));
    // }

    // public function testCustomerFind() {
    //     $this->assertIsArray($this->getClient()->customer()->find('5fd1a0097ce01'));
    // }

    // public function testCustomerUpdate() {
    //     $this->assertIsArray($this->getClient()->customer()->update('5fd1a0097ce01', [
    //         'email' => 'user_namexx@gmail.com',
    //         'first_name' => 'Luan',
    //         'last_name' => 'Pham',
    //         'timezone' => 'America/Godthab',
    //         'language_id' => '1',
    //         'password' => '123456',
    //     ]));
    // }

    // public function testCustomerEnable() {
    //     $this->assertIsArray($this->getClient()->customer()->enable('5fd1a0097ce01'));
    // }

    // public function testCustomerDisable() {
    //     $this->assertIsArray($this->getClient()->customer()->disable('5fd1a0097ce01'));
    // }

    // public function testCustomerAssignPlan() {
    //     $this->assertIsArray($this->getClient()->customer()->assignPlan('5fd1a0097ce01', '5fd1a16fb8f27'));
    // }

    // public function testSubscriptionCreate() {
    //     $this->assertIsArray($this->getClient()->subscription()->create([
    //         'customer_uid' => '5fd1a0097ce01',
    //         'plan_uid' => '5fd1a16fb8f27',
    //     ]));
    // }

    // public function testSubscriptionActivate() {
    //     $this->assertIsArray($this->getClient()->subscription()->activate('5faba7496eef4'));
    // }
}