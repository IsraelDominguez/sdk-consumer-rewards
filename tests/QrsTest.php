<?php

use ConsumerRewards\SDK\Transfer\Qr;
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

    /**
     * @expectedException \ConsumerRewards\SDK\Exception\InvalidQrException
     */
    public function testNotExistQrFindByKey() {
        self::$sdk->getQrs()->findByKey('QRNOTEXIST');
    }

    public function testGetInstanceOfQrFindByKey() {
        $this->assertInstanceOf(\ConsumerRewards\SDK\Transfer\Qr::class, self::$sdk->getQrs()->findByKey('Ogab8JKw'));
    }

    public function testGetTheCorrectQrFindByKey() {
        $qr = self::$sdk->getQrs()->findByKey('Ogab8JKw');

        $this->assertEquals('000966218f0f509451260f9493b6cffecc050581fb314179871fcf26a8f54a97', $qr->getObjectId());
    }

    public function testGetQrsByUser() {
        $qrs = self::$sdk->getQrs()->getQrsByUser(new \ConsumerRewards\SDK\Transfer\User('c43ba1a87f4ce0c549540257837ea35fb5df6e4d', 'druid'));

        $this->assertTrue(true);
    }

    public function testQrsByUser() {
        $qrs = self::$sdk->getQrs()->getQrsByUser(new \ConsumerRewards\SDK\Transfer\User('c43ba1a87f4ce0c549540257837ea35fb5df6e4d', 'druid'));
        $this->assertIsArray($qrs);

        $this->assertInstanceOf(Qr::class, $qrs[0]);
    }

    public function testQrsByUserEmpty() {
        $qrs = self::$sdk->getQrs()->getQrsByUser(new \ConsumerRewards\SDK\Transfer\User('c43ba1a87f4ce0c549540257837ea35fb5df6e4ds', 'druid'));
        $this->assertIsArray($qrs);
        $this->assertEmpty($qrs);
    }
}
