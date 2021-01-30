<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class SdkTest extends TestCase
{
    public function getClient() {
        return new \Acelle\Client('http://acelle.local:8080/api/v1', 'wkN02cFtDw4CxF2boUSAjvwGmKDmjkyRXY5kvmKSELc1VzXniAcCeK64iqmn');
    }

    public function testLoginToken() {
        $this->assertArrayHasKey('token', $this->getClient()->loginToken());
    }

    public function testListCreate() {
        $this->assertArrayHasKey('status', $this->getClient()->list()->create([
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
        ]));
    }

    public function testListAll() {
        $this->assertIsArray($this->getClient()->list()->all());
    }

    public function testListFind() {
        $this->assertIsArray($this->getClient()->list()->find('5fade5c93e42a'));
    }

    public function testListAddCustomField() {
        $this->assertIsArray($this->getClient()->list()->addCustomField('5fade5c93e42a', [
            'type' => 'text',
            'label' => 'Custom',
            'tag' => 'CUSTOM_FIELD_1',
            'default_value' => 'test',
        ]));
    }

    public function testSubscriberAll() {
        $this->assertIsArray($this->getClient()->subscriber()->all([
            'list_uid' => '5fade5c93e42a',
            'per_page' => '20',
            'page' => '1',
        ]));
    }

    public function testSubscriberCreate() {
        $this->assertIsArray($this->getClient()->subscriber()->create([
            'list_uid' => '5fade5c93e42a',
            'EMAIL' => 'test@gmail.com',
            'tag' => 'foo,bar,tag+with+space,',
            'FIRST_NAME' => 'Marine',
            'LAST_NAME' => 'Joze',
        ]));
    }

    public function testSubscriberFind() {
        $this->assertIsArray($this->getClient()->subscriber()->find('0b3390b53f72f'));
    }
    
    public function testSubscriberFindByEmail() {
        $this->assertIsArray($this->getClient()->subscriber()->findByEmail('test@gmail.com'));
    }

    public function testSubscriberUpdate() {
        $this->assertIsArray($this->getClient()->subscriber()->update('0b3390b53f72f', [
            'EMAIL' => 'test2@gmail.com',
            'tag' => 'foo,bar,tag+with+space,',
            'FIRST_NAME' => 'Marine',
            'LAST_NAME' => 'Joze',
        ]));
    }

    public function testSubscriberSubscribe() {
        $this->assertIsArray($this->getClient()->subscriber()->subscribe('0b3390b53f72f'));
    }

    public function testSubscriberUnsubscribe() {
        $this->assertIsArray($this->getClient()->subscriber()->unsubscribe('0b3390b53f72f'));
    }

    public function testSubscriberDelete() {
        $this->assertIsArray($this->getClient()->subscriber()->delete('e31046fce3d83'));
    }

    public function testCampaignAll() {
        $this->assertIsArray($this->getClient()->campaign()->all());
    }
    
    public function testCampaignFind() {
        $this->assertIsArray($this->getClient()->campaign()->find('5fb48ff221b27'));
    }

    public function testNotificationAll() {
        $this->assertIsArray($this->getClient()->notification()->read([
            'type' => 'sent',
        ]));

        $this->assertIsArray($this->getClient()->notification()->read([
            'type' => 'bounced',
            'bounced_type' => 'hard',
        ]));

        $this->assertIsArray($this->getClient()->notification()->read([
            'type' => 'abuse',
            'report_type' => 'hard',
        ]));
    }

    public function testFileUpload() {
        $this->assertIsArray($this->getClient()->file()->upload([
            'files' => '[{"url":"http://demo.acellemail.com/images/logo_big.svg","subdirectory":"path/to/file"},{"url":"http://demo.acellemail.com/images/logo_big.svg","subdirectory":"path/to/file2"}]',
        ]));
    }

    public function testPlanAll() {
        $this->assertIsArray($this->getClient()->plan()->all());
    }

    public function testPlanCreate() {
        $this->assertIsArray($this->getClient()->plan()->create([
            'name' => 'Advanced',
            'currency_id' => '1',
            'frequency_amount' => '1',
            'frequency_unit' => 'month',
            'price' => '20',
            'color' => 'red',
            'options[sending_server_option]' => 'own',
            'options[email_max]' => '10000',
        ]));
    }

    public function testSendingServerAll() {
        $this->assertIsArray($this->getClient()->sending_server()->all());
    }

    public function testCustomerCreate() {
        $this->assertIsArray($this->getClient()->customer()->create([
            'email' => 'user_namexx@gmail.com',
            'first_name' => 'Luan',
            'last_name' => 'Pham',
            'timezone' => 'America/Godthab',
            'language_id' => '1',
            'password' => '123456',
        ]));
    }

    public function testCustomerFind() {
        $this->assertIsArray($this->getClient()->customer()->find('5fd1a0097ce01'));
    }

    public function testCustomerUpdate() {
        $this->assertIsArray($this->getClient()->customer()->update('5fd1a0097ce01', [
            'email' => 'user_namexx@gmail.com',
            'first_name' => 'Luan',
            'last_name' => 'Pham',
            'timezone' => 'America/Godthab',
            'language_id' => '1',
            'password' => '123456',
        ]));
    }

    public function testCustomerEnable() {
        $this->assertIsArray($this->getClient()->customer()->enable('5fd1a0097ce01'));
    }

    public function testCustomerDisable() {
        $this->assertIsArray($this->getClient()->customer()->disable('5fd1a0097ce01'));
    }

    public function testCustomerAssignPlan() {
        $this->assertIsArray($this->getClient()->customer()->assignPlan('5fd1a0097ce01', '5fd1a16fb8f27'));
    }

    public function testSubscriptionCreate() {
        $this->assertIsArray($this->getClient()->subscription()->create([
            'customer_uid' => '5fd1a0097ce01',
            'plan_uid' => '5fd1a16fb8f27',
        ]));
    }

    public function testSubscriptionActivate() {
        $this->assertIsArray($this->getClient()->subscription()->activate('5faba7496eef4'));
    }
}