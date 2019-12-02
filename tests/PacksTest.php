<?php namespace ConsumerRewards\SDK;


class PacksTest extends InitTest
{

    /**
     * @expectedException \ConsumerRewards\SDK\Exception\InvalidPackException
     */
    public function testNotExistPackFindById() {
        $this->sdk->getPacks()->findById('NOTEXIST');
    }

    public function testGetPackFindById() {
        $this->assertInstanceOf(\ConsumerRewards\SDK\Transfer\Pack::class, $this->sdk->getPacks()->findById('a6218477171a960db820198fc6ceaaa4257b67edee9f961bc885d3b9991d8f9a'));
    }

    public function testGetTheCorrectPackFindById() {
        $pack = $this->sdk->getPacks()->findById('a6218477171a960db820198fc6ceaaa4257b67edee9f961bc885d3b9991d8f9a');

        $this->assertEquals('a6218477171a960db820198fc6ceaaa4257b67edee9f961bc885d3b9991d8f9a', $pack->getObjectId());
    }
}
