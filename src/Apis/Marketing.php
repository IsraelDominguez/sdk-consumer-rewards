<?php namespace ConsumerRewards\SDK\Apis;

use ConsumerRewards\SDK\Exception\ConsumerRewardsException;
use ConsumerRewards\SDK\Exception\InvalidQrException;
use ConsumerRewards\SDK\Exception\MaxReachedException;
use ConsumerRewards\SDK\Exception\NoContentException;
use ConsumerRewards\SDK\Tools\Container;
use ConsumerRewards\SDK\Tools\HttpStatus;
use ConsumerRewards\SDK\Tools\NetTools;
use ConsumerRewards\SDK\Transfer\Qr;
use ConsumerRewards\SDK\Transfer\User;
use GuzzleHttp\Exception\ClientException;
use JMS\Serializer\SerializerBuilder;
use Psr\Log\LoggerInterface;

class Marketing
{

    const ENDPOINT = '/marketing/';
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
     * Generate a new QR in the specified Pack for the User
     *
     * @param $pack
     * @param User $user
     * @return Qrs
     * @throws ConsumerRewardsException
     */
    public function generateQr($pack, User $user) {

        try {
            $options['body'] = \GuzzleHttp\json_encode($user);

            $request = $this->http->getAuthenticatedRequest(
                NetTools::HTTP_POST,
                $this->http->buildApiUrl(Marketing::ENDPOINT . 'packs/' . $pack),
                Container::get('JWT')->getBearer(),
                $options
            );

            return $this->http->getSerializedResponse($request, Qr::class);

        } catch (ClientException $e) {
        } catch (MaxReachedException $e) {
            $this->logger->error($e->getMessage() . sprintf("Generating Qr for Pack '%s' and User '%s'", $pack, $user->getIdentifier()));
        }
    }

    /**
     * Check status of qr by id for a specified user (dba8611d6e3ba4ca3247ab8efd3554943d39e4fab02fd10f25844164a0da47e2)
     *
     * @param string $objectId
     * @param User|null $user
     * @return string
     * @throws InvalidQrException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkById(string $objectId, User $user = null) : string
    {
        try {

            $request = $this->http->getAuthenticatedRequest(
                NetTools::HTTP_HEAD,
                $this->http->buildApiUrl(Marketing::ENDPOINT . 'qrs/' . $objectId, (!empty($user)) ? $user->toArray() : []),
                Container::get('JWT')->getBearer()
            );

            $response = $this->http->getResponse($request, ['http_errors' => false]);

            $this->logger->info(sprintf("Check Qr '%s' status: '%s'", $objectId, $response->getStatusCode()));

            switch ($response->getStatusCode()) {
                case HttpStatus::HTTP_GONE:
                    return Qr::STATUS_REDEEM;
                    break;

                case HttpStatus::HTTP_NO_CONTENT:
                    return Qr::STATUS_VALID;
                    break;

                case HttpStatus::HTTP_NOT_FOUND:
                    throw new InvalidQrException();
            }

        } catch (ClientException $e) {
        } catch (MaxReachedException $e) {
            $this->logger->error($e->getMessage() . sprintf("Generating Qr for Pack '%s' and User '%s'", $pack, $user->getIdentifier()));
        }
    }

}