<?php namespace ConsumerRewards\SDK\Apis;

use ConsumerRewards\SDK\Tools\Container;
use ConsumerRewards\SDK\Tools\NetTools;
use ConsumerRewards\SDK\Transfer\Qr;
use Psr\Log\LoggerInterface;

class Qrs
{
    const ENDPOINT = '/qrs/';

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
     * Get Qr by indentifier
     *
     * @param string $objectId
     * @return Qr
     */
    public function findById(string $objectId) : Qr
    {
        try {
            $request = $this->http->getAuthenticatedRequest(
                NetTools::HTTP_GET,
                $this->http->buildApiUrl(Qrs::ENDPOINT . $objectId),
                Container::get('JWT')->getBearer()
            );

            return $this->http->getSerializedResponse($request, Qr::class);
        } catch (ConsumerRewardsException $e) {
            $this->logger->error($e->getMessage());
        }
    }

}