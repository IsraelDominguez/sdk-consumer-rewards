<?php

use PHPUnit\Framework\TestCase;

final class InitTest extends TestCase
{

    protected $username = "929363639337055";
    protected $password = "Rsr2uCgSTiD00ty8wG3gHmOWc06I1E";
    protected $api = "https://api-consumerrewards-test.pernod-ricard-espana.com";
    protected $web = "https://consumerrewards-test.pernod-ricard-espana.com";

    /**
     * @expectedException \ConsumerRewards\SDK\Exception\ConsumerRewardsException
     */
    public function testFailConsumerRewardsConnection()
    {
        $sdk = new \ConsumerRewards\SDK\ConsumerRewards([
            'username' => $this->username,
            'password' => $this->password,
            'api' => 'http://incorrectsite.com',
            'web' => $this->web,
        ],[
            'cache' => new Cache\Adapter\Void\VoidCachePool()
        ]);
    }

    public function testConsumerRewardsInstanceOk()
    {
        $sdk = new \ConsumerRewards\SDK\ConsumerRewards([
            'username' => $this->username,
            'password' => $this->password,
            'api' => $this->api,
            'web' => $this->web,
        ],[
            'cache' => new Cache\Adapter\Void\VoidCachePool()
        ]);

        $this->assertInstanceOf(\ConsumerRewards\SDK\ConsumerRewards::class, $sdk);

    }

    /**
     * @expectedException \ConsumerRewards\SDK\Exception\ConsumerRewardsSdkAuthException
     */
    public function testConsumerRewardsInstanceAuthFail()
    {
        $sdk = new \ConsumerRewards\SDK\ConsumerRewards([
            'username' => $this->username . '----',
            'password' => $this->password,
            'api' => $this->api,
            'web' => $this->web,
        ],[
            'cache' => new Cache\Adapter\Void\VoidCachePool()
        ]);
    }
}