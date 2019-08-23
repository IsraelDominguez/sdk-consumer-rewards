<?php namespace ConsumerRewards\SDK\Apis;

use ConsumerRewards\SDK\Exception\ConsumerRewardsException;
use ConsumerRewards\SDK\Exception\InvalidQrException;
use ConsumerRewards\SDK\Exception\MaxReachedException;
use ConsumerRewards\SDK\Tools\Container;
use ConsumerRewards\SDK\Tools\HttpStatus;
use ConsumerRewards\SDK\Tools\NetTools;
use ConsumerRewards\SDK\Transfer\Qr;
use ConsumerRewards\SDK\Transfer\User;
use JMS\Serializer\SerializerBuilder;
use Psr\Log\LoggerInterface;

class Qrs extends ApiGeneric
{
    const ENDPOINT = '/qrs';

    /**
     * Qrs Api
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get Qr by indentifier
     *
     * @param string $objectId
     * @return Qr
     * @throws InvalidQrException
     */
    public function findById(string $objectId): Qr
    {
        try {
            return $this->http->getSerializedResponse(
                $this->getAuthenticatedRequest(
                    NetTools::HTTP_GET,
                    $this->http->buildApiUrl(sprintf("%s/%s", Qrs::ENDPOINT, $objectId))
                ),
                Qr::class
            );
        } catch (ConsumerRewardsException $e) {
            $this->logger->error($e->getMessage());
            throw new InvalidQrException($e->getMessage());
        }
    }

    /**
     * Get Qr by key
     *
     * @param string $key
     * @return Qr
     * @throws InvalidQrException
     */
    public function findByKey(string $key): Qr
    {
        try {
            return $this->http->getSerializedResponse(
                $this->getAuthenticatedRequest(
                    NetTools::HTTP_GET,
                    $this->http->buildApiUrl(sprintf("%s/search/byKey?key=%s", Qrs::ENDPOINT, $key))
                ),
                Qr::class
            );
        } catch (ConsumerRewardsException $e) {
            $this->logger->error($e->getMessage());
            throw new InvalidQrException($e->getMessage());
        }
    }

    /**
     * Get All Qrs for a user
     *
     * @param User $user
     * @return array
     * @throws InvalidQrException
     */
    public function getQrsByUser(User $user) : array
    {
        try {
            $response = $this->http->getParsedResponse($this->getAuthenticatedRequest(
                NetTools::HTTP_GET,
                $this->http->buildApiUrl(Qrs::ENDPOINT, $user->toArray())
            ), ['http_errors' => false]);

            $qrs = [];
            $serializer = SerializerBuilder::create()->build();

            foreach ($response->_embedded->qrs as $qr) {
                $json = $serializer->serialize($qr, 'json');
                $object  = $serializer->deserialize($json, Qr::class, 'json');
                array_push($qrs, $object);
            }

            return $qrs;

        } catch (ConsumerRewardsException $e) {
            $this->logger->error($e->getMessage());
            throw new InvalidQrException($e->getMessage());
        }
    }
}
