<?php

use ConsumerRewards\SDK\Tools\HttpStatus;
use ConsumerRewards\SDK\Transfer\Qr;
use PHPUnit\Framework\TestCase;

final class MarketingTest extends TestCase
{

    /**
     * @var \ConsumerRewards\SDK\ConsumerRewards
     */
    protected static $sdk = null;

    const USERNAME = "929363639337055";
    const PASSWORD = "Rsr2uCgSTiD00ty8wG3gHmOWc06I1E";
    const API = "https://api-consumerrewards-test.pernod-ricard-espana.com";
    const WEB = "https://consumerrewards-test.pernod-ricard-espana.com";


    /**
     * @beforeClass
     */
    public static function setUpData()
    {
//        self::$sdk = new \ConsumerRewards\SDK\ConsumerRewards([
//            'username' => DataTest::USERNAME,
//            'password' => DataTest::PASSWORD,
//            'api' => DataTest::API,
//            'web' => DataTest::WEB,
//        ],[
//            'cache' => new Cache\Adapter\Void\VoidCachePool()
//        ]);

        self::$sdk = new \ConsumerRewards\SDK\ConsumerRewards([
            'username' => self::USERNAME,
            'password' => self::PASSWORD,
            'api' => self::API,
            'web' => self::WEB,
        ],[
            'cache' => new Cache\Adapter\Void\VoidCachePool()
        ]);
    }

    public function testCheckQrRedeem() {
        $this->assertEquals(Qr::STATUS_REDEEM, self::$sdk->getMarketing()->checkById('000966218f0f509451260f9493b6cffecc050581fb314179871fcf26a8f54a97'));
    }

    public function testCheckQrValid() {
        $this->assertEquals(Qr::STATUS_VALID, self::$sdk->getMarketing()->checkById('0017db7e7342b8f400c5e1e006db4a966a17e5f0075b7e221930063b804850f2'));
    }

    /**
     * @expectedException \ConsumerRewards\SDK\Exception\InvalidQrException
     */
    public function testQrIsInvalid() {
        self::$sdk->getMarketing()->checkById('Not Exist');
    }

    /**
     * @expectedException \ConsumerRewards\SDK\Exception\InvalidQrException
     */
    public function testReedemQrInvalid() {
        self::$sdk->getMarketing()->redeem('Not Exist');
    }

    public function testReedemValidQr() {
        $objectID = '5f40d3e876ba31434a6e72ba046b7d5f99ec061ceb6dfac24b153099aed0c343';
        $qr = self::$sdk->getMarketing()->redeem($objectID);
        $this->assertInstanceOf(Qr::class, $qr);
        $this->assertEquals($objectID, $qr->getObjectId());
        $this->assertEquals(Qr::STATUS_REDEEM, $qr->getStatus());
    }

}
