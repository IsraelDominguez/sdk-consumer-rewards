<?php namespace ConsumerRewards\SDK;

use ConsumerRewards\SDK\Transfer\Qr;

final class MarketingTest extends InitTest
{

    public function testCheckQrRedeem() {
        $this->assertEquals(Qr::STATUS_REDEEM, $this->sdk->getMarketing()->checkById($this->qr_redeem));
    }

    public function testCheckQrValid() {
        $this->assertEquals(Qr::STATUS_VALID, $this->sdk->getMarketing()->checkById($this->qr_valid));
    }

    /**
     * @expectedException \ConsumerRewards\SDK\Exception\InvalidQrException
     */
    public function testQrIsInvalid() {
        $this->sdk->getMarketing()->checkById('Not Exist');
    }

    /**
     * @expectedException \ConsumerRewards\SDK\Exception\InvalidQrException
     */
    public function testReedemQrInvalid() {
        $this->sdk->getMarketing()->redeem('Not Exist');
    }

    public function testReedemValidQr() {
        $qr = $this->sdk->getMarketing()->redeem($this->qr_to_redeem);
        $this->assertInstanceOf(Qr::class, $qr);
        $this->assertEquals($this->qr_to_redeem, $qr->getObjectId());
        $this->assertEquals(Qr::STATUS_REDEEM, $qr->getStatus());
    }

}
