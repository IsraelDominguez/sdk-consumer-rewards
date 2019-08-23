<?php namespace ConsumerRewards\SDK\Apis;

use ConsumerRewards\SDK\Exception\ConsumerRewardsException;
use ConsumerRewards\SDK\Exception\InvalidQrException;
use ConsumerRewards\SDK\Exception\MaxReachedException;
use ConsumerRewards\SDK\Tools\Container;
use ConsumerRewards\SDK\Tools\HttpStatus;
use ConsumerRewards\SDK\Tools\NetTools;
use ConsumerRewards\SDK\Transfer\Pack;
use ConsumerRewards\SDK\Transfer\Qr;
use ConsumerRewards\SDK\Transfer\User;
use GuzzleHttp\Exception\ClientException;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerBuilder;

class Marketing extends ApiGeneric
{
    const ENDPOINT = '/marketing';

    /**
     * Marketing constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Generate a new QR in the specified Pack for the User, and redirect to this new Qr
     *
     * @param $pack
     * @param User $user
     */
    public function generateQrAndRedirect($pack, User $user) {
        $this->logger->info(sprintf("Generate Qr for Pack '%s' and User '%s'", $pack, $user->getIdentifier()));

        header('Location: ' . $this->http->buildWebUrl(Marketing::ENDPOINT . $pack, $user->toArray()));
        exit;
    }

    /**
     * @param Pack $pack
     * @param bool $generate_max
     * @return Pack
     * @throws ConsumerRewardsException
     */
    public function createPack($pack, $generate_max = false) {
        try {
            $serializer = SerializerBuilder::create()->setPropertyNamingStrategy(new IdenticalPropertyNamingStrategy())->build();
            $options['body'] =  $serializer->serialize($pack, 'json');

            $request = $this->http->getAuthenticatedRequest(
                NetTools::HTTP_POST,
                $this->http->buildApiUrl(Marketing::ENDPOINT . 'packs', ['generateMax' => ($generate_max) ? 'true' : 'false']),
                $options
            );

            return $this->http->getSerializedResponse($request, Pack::class);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new ConsumerRewardsException($e->getMessage());
        }
    }

    /**
     * Generate a new QR in the specified Pack for the User
     *
     * @param $pack
     * @param User $user
     * @return Qr
     * @throws ConsumerRewardsException
     */
    public function generateQr($pack, User $user) {

        try {
            $options['body'] = \GuzzleHttp\json_encode($user);

            $request = $this->http->getAuthenticatedRequest(
                NetTools::HTTP_POST,
                $this->http->buildApiUrl(Marketing::ENDPOINT . 'packs/' . $pack),
                $options
            );

            return $this->http->getSerializedResponse($request, Qr::class);

        } catch (ClientException $e) {
        } catch (MaxReachedException $e) {
            $this->logger->error($e->getMessage() . sprintf("Generating Qr for Pack '%s' and User '%s'", $pack, $user->getIdentifier()));
            throw $e;
        }
    }

    /**
     * Check status of qr by id (dba8611d6e3ba4ca3247ab8efd3554943d39e4fab02fd10f25844164a0da47e2)
     *
     * @param string $objectId
     * @return string
     * @throws InvalidQrException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkById(string $objectId) : string
    {
        try {
            $response = $this->http->getResponse($this->getAuthenticatedRequest(
                NetTools::HTTP_HEAD,
                $this->http->buildApiUrl(sprintf("%s/qrs/%s", Marketing::ENDPOINT, $objectId))
            ), ['http_errors' => false]);

            $this->logger->info(sprintf("Check Qr '%s' status: '%s'", $objectId, $response->getStatusCode()));

            switch ($response->getStatusCode()) {
                case HttpStatus::HTTP_GONE:
                    return Qr::STATUS_REDEEM;
                    break;

                case HttpStatus::HTTP_NO_CONTENT:
                    return Qr::STATUS_VALID;
                    break;

                case HttpStatus::HTTP_REQUESTED_RANGE_NOT_SATISFIABLE:
                    return Qr::STATUS_NOT_PUBLISHED;
                    break;

                case HttpStatus::HTTP_REQUEST_TIMEOUT:
                    return Qr::STATUS_EXPIRED;
                    break;

                case HttpStatus::HTTP_NOT_FOUND:
                    throw new InvalidQrException();
            }

        } catch (ClientException $e) {
        } catch (MaxReachedException $e) {
            $this->logger->error($e->getMessage() . sprintf("Check Qr by Id '%s' and User '%s'", $objectId, $user->getIdentifier()));
        }
    }

}
