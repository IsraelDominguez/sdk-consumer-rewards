<?php namespace ConsumerRewards\SDK\Apis;

use ConsumerRewards\SDK\Tools\Container;
use ConsumerRewards\SDK\Tools\NetTools;
use Psr\Http\Message\RequestInterface;
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

    /**
     * Get Request for Api call
     *
     * @param string $endpoint
     * @return RequestInterface
     */
    public function getAuthenticatedRequest(string $method, string $endpoint, $options = []) : RequestInterface {
        return $this->http->getAuthenticatedRequest(
            $method,
            $endpoint,
            $options
        );
    }

}
