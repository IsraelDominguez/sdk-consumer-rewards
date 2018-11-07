<?php

use PHPUnit\Framework\TestCase;

final class QrsTest extends TestCase
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
     * @expectedException \ConsumerRewards\SDK\Exception\InvalidQrException
     */
    public function testNotExistQrFindById() {
        self::$sdk->getQrs()->findById('QRNOTEXIST');
    }

    public function testExistQrFindByIdReedem() {
        $this->assertInstanceOf(\ConsumerRewards\SDK\Transfer\Qr::class, self::$sdk->getQrs()->findById('4193cf76919c1583706811f8d929fd234cf24a2cb273302e85e7766e43688caa'));
    }

    public function testGetInstanceOfQrFindById() {
        $this->assertInstanceOf(\ConsumerRewards\SDK\Transfer\Qr::class, self::$sdk->getQrs()->findById('b07943e368333a1490473c41ff55ff50faaa52a628e843c33abad108e50721af'));
    }

    public function testGetTheCorrectQrFindById() {
        $qr = self::$sdk->getQrs()->findById('b07943e368333a1490473c41ff55ff50faaa52a628e843c33abad108e50721af');

        $this->assertEquals('b07943e368333a1490473c41ff55ff50faaa52a628e843c33abad108e50721af', $qr->getObjectId());
    }


}