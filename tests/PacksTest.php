<?php

use PHPUnit\Framework\TestCase;

final class PacksTest extends TestCase
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

    /**
     * @expectedException \ConsumerRewards\SDK\Exception\InvalidPackException
     */
    public function testNotExistPackFindById() {
        self::$sdk->getPacks()->findById('NOTEXIST');
    }

    public function testGetPackFindById() {
        $this->assertInstanceOf(\ConsumerRewards\SDK\Transfer\Pack::class, self::$sdk->getPacks()->findById('a6218477171a960db820198fc6ceaaa4257b67edee9f961bc885d3b9991d8f9a'));
    }

    public function testGetTheCorrectPackFindById() {
        $pack = self::$sdk->getPacks()->findById('a6218477171a960db820198fc6ceaaa4257b67edee9f961bc885d3b9991d8f9a');

        $this->assertEquals('a6218477171a960db820198fc6ceaaa4257b67edee9f961bc885d3b9991d8f9a', $pack->getObjectId());
    }
}