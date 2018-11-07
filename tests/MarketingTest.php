<?php

use PHPUnit\Framework\TestCase;

final class MarketingTest extends TestCase
{

   /**
     * @var \ConsumerRewards\SDK\ConsumerRewards
     */
    protected static $sdk = null;

    /**
     * @beforeClass
     */
    public static function setUpData()
    {
        self::$sdk = new \ConsumerRewards\SDK\ConsumerRewards([
            'username' => DataTest::USERNAME,
            'password' => DataTest::PASSWORD,
            'api' => DataTest::API,
            'web' => DataTest::WEB,
        ],[
            'cache' => new Cache\Adapter\Void\VoidCachePool()
        ]);
    }


}