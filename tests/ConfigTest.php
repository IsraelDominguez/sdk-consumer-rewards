<?php namespace Genetsis\Druid\Rest;

final class ConfigTest extends InitTest
{
    public function testDruidRestLoggerConfig()
    {
        $this->assertInstanceOf(\Psr\Log\LoggerInterface::class, $this->api->getConfig()->getLogger());
    }

    public function testDruidRestCacheConfig()
    {
        $this->assertInstanceOf(\Cache\Adapter\Common\AbstractCachePool::class, $this->api->getConfig()->getCache());
    }

    public function testDruidRestHttpConfig()
    {
        $this->assertInstanceOf(\GuzzleHttp\Client::class, $this->api->getConfig()->getHttp());
    }

}