<?php namespace ConsumerRewards\SDK;


use ConsumerRewards\SDK\Transfer\Qr;

 class QrsTest extends InitTest
{


    /**
     * @expectedException \ConsumerRewards\SDK\Exception\InvalidQrException
     */
    public function testNotExistQrFindById() {
        $this->sdk->getQrs()->findById('QRNOTEXIST');
    }

    public function testExistQrFindByIdReedem() {
        $this->assertInstanceOf(\ConsumerRewards\SDK\Transfer\Qr::class, $this->sdk->getQrs()->findById($this->qr_redeem));
    }

    public function testGetInstanceOfQrFindById() {
        $this->assertInstanceOf(\ConsumerRewards\SDK\Transfer\Qr::class, $this->sdk->getQrs()->findById($this->qr_valid));
    }

    public function testGetTheCorrectQrFindById() {
        $qr = self::$sdk->getQrs()->findById($this->qr_valid);

        $this->assertEquals($this->qr_valid, $qr->getObjectId());
    }

    /**
     * @expectedException \ConsumerRewards\SDK\Exception\InvalidQrException
     */
    public function testNotExistQrFindByKey() {
        self::$sdk->getQrs()->findByKey('QRNOTEXIST');
    }

    public function testGetInstanceOfQrFindByKey() {
        $this->assertInstanceOf(\ConsumerRewards\SDK\Transfer\Qr::class, $this->sdk->getQrs()->findByKey('Ogab8JKw'));
    }

    public function testGetTheCorrectQrFindByKey() {
        $qr = $this->sdk->getQrs()->findByKey('Ogab8JKw');

        $this->assertEquals('000966218f0f509451260f9493b6cffecc050581fb314179871fcf26a8f54a97', $qr->getObjectId());
    }

    public function testGetQrsByUser() {
        $qrs = $this->sdk->getQrs()->getQrsByUser(new \ConsumerRewards\SDK\Transfer\User('c43ba1a87f4ce0c549540257837ea35fb5df6e4d', 'druid'));

        $this->assertTrue(true);
    }

    public function testQrsByUser() {
        $qrs = $this->sdk->getQrs()->getQrsByUser(new \ConsumerRewards\SDK\Transfer\User('c43ba1a87f4ce0c549540257837ea35fb5df6e4d', 'druid'));
        $this->assertIsArray($qrs);

        $this->assertInstanceOf(Qr::class, $qrs[0]);
    }

    public function testQrsByUserEmpty() {
        $qrs = $this->sdk->getQrs()->getQrsByUser(new \ConsumerRewards\SDK\Transfer\User('c43ba1a87f4ce0c549540257837ea35fb5df6e4ds', 'druid'));
        $this->assertIsArray($qrs);
        $this->assertEmpty($qrs);
    }
}
