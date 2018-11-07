<?php namespace ConsumerRewards\SDK\Apis;

use ConsumerRewards\SDK\Tools\Container;
use ConsumerRewards\SDK\Tools\NetTools;
use Psr\Log\LoggerInterface;

abstract class ApiGeneric
{
    /**
     * @var NetTools $http
     */
    protected $http;

    /**
     * @var LoggerInterface $logger
     */
    protected $logger;

    /**
     * Marketing constructor.
     */
    public function __construct()
    {
        $this->http = Container::get('http');
        $this->logger = Container::get('logger');
    }

}