<?php namespace ConsumerRewards\SDK\Apis;

use ConsumerRewards\SDK\Exception\ConsumerRewardsException;
use ConsumerRewards\SDK\Exception\InvalidPackException;
use ConsumerRewards\SDK\Tools\Container;
use ConsumerRewards\SDK\Tools\NetTools;
use ConsumerRewards\SDK\Transfer\Pack;

class Packs extends ApiGeneric
{
    const ENDPOINT = '/packs/';

    /**
     * Packs Api.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get Qr by indentifier
     *
     * @param string $objectId
     * @return Pack
     * @throws InvalidPackException
     */
    public function findById(string $objectId) : Pack
    {
        try {
            $request = $this->http->getAuthenticatedRequest(
                NetTools::HTTP_GET,
                $this->http->buildApiUrl(Packs::ENDPOINT . $objectId),
                Container::get('JWT')->getBearer()
            );

            return $this->http->getSerializedResponse($request, Pack::class);
        } catch (ConsumerRewardsException $e) {
            $this->logger->error($e->getMessage());
            throw new InvalidPackException($e->getMessage());
        }
    }

}