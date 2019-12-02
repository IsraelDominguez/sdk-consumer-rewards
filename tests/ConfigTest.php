<?php namespace ConsumerRewards\SDK;

use Cache\Adapter\Void\VoidCachePool;

final class ConfigTest extends InitTest
{
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
            'cache' => new VoidCachePool()
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
            'cache' => new VoidCachePool()
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
            'cache' => new VoidCachePool()
        ]);
    }

}
