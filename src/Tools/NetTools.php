<?php namespace ConsumerRewards\SDK\Tools;
use ConsumerRewards\SDK\Exception\ConsumerRewardsException;
use ConsumerRewards\SDK\Exception\MaxPackageReachedException;
use ConsumerRewards\SDK\Exception\MaxReachedException;
use ConsumerRewards\SDK\Exception\MaxUserReachedException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Psr7\Response;
use JMS\Serializer\EventDispatcher\EventDispatcher;
use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\SerializerBuilder;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class NetTools
{

    use BearerAuthorizationTrait;
    use QueryBuilderTrait;
    use JsonHeadersTrait;
    use ArrayAccessorTrait;

    /** Http Methods */
    const HTTP_POST = 'POST';
    const HTTP_PUT = 'PUT';
    const HTTP_GET = 'GET';
    const HTTP_DELETE = 'DELETE';
    const HTTP_HEAD = 'HEAD';

    /**
     * @var RequestFactory
     */
    protected $requestFactory;

    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * @var array
     */
    protected $endpoints;

    /**
     * NetTools constructor.
     * @param ClientInterface $http
     * @param RequestFactory $requestFactory
     * @param array $endpoints
     */
    public function __construct(ClientInterface $http, RequestFactory $requestFactory, array $endpoints)
    {
        $this->setHttpClient($http)->setRequestFactory($requestFactory)->setEndpoints($endpoints);
    }

    /**
     * @return RequestFactory
     */
    public function getRequestFactory(): RequestFactory
    {
        return $this->requestFactory;
    }

    /**
     * @param RequestFactory $requestFactory
     * @return NetTools
     */
    public function setRequestFactory(RequestFactory $requestFactory): NetTools
    {
        $this->requestFactory = $requestFactory;
        return $this;
    }

    /**
     * @return ClientInterface
     */
    public function getHttpClient(): ClientInterface
    {
        return $this->httpClient;
    }

    /**
     * @param ClientInterface $httpClient
     * @return NetTools
     */
    public function setHttpClient(ClientInterface $httpClient): NetTools
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndpoints()
    {
        return $this->endpoints;
    }

    /**
     * @param array $endpoints
     * @return NetTools
     */
    public function setEndpoints(array $endpoints): NetTools
    {
        $this->endpoints = $endpoints;
        return $this;
    }

    /**
     * Returns an authenticated PSR-7 request instance.
     *
     * @param  string $method
     * @param  string $url
     * @param  JWT|string $bearer
     * @param  array $options Any of "headers", "body", and "protocolVersion".
     * @return RequestInterface
     */
    public function getAuthenticatedRequest(string $method, string $url, $bearer, array $options = [])
    {
        return $this->createRequest($method, $url, $bearer, $options);
    }

    /**
     * Returns an authenticated PSR-7 request instance.
     *
     * @param  string $method
     * @param  string $url
     * @param  array $options Any of "headers", "body", and "protocolVersion".
     * @return RequestInterface
     */
    public function getRequest($method, $url, array $options = [])
    {
        return $this->createRequest($method, $url, null, $options);
    }

    /**
     * Creates a PSR-7 request instance.
     *
     * @param  string $method
     * @param  string $url
     * @param  AccessToken|string|null $token
     * @param  array $options
     * @return RequestInterface
     */
    public function createRequest($method, $url, $token, array $options)
    {
        $defaults = [
            'headers' => $this->getHeaders($token),
        ];
        $options = array_merge_recursive($defaults, $options);

        return $this->getRequestFactory()->getRequestWithOptions($method, $url, $options);
    }


    /**
     * Returns all headers used by this provider for a request.
     *
     * The request will be authenticated if an access token is provided.
     *
     * @param  mixed|null $bearer object or string
     * @return array
     */
    public function getHeaders($bearer = null)
    {
        if ($bearer) {
            return array_merge(
                $this->getDefaultHeaders(),
                $this->getAuthorizationHeaders($bearer)
            );
        }
        return $this->getDefaultHeaders();
    }

    /**
     * Returns the default headers used
     *
     * @return array
     */
    protected function getDefaultHeaders()
    {
        return $this->getJsonHeaders();
    }

    /**
     * Sends a request instance and returns a response instance.
     *
     * WARNING: This method does not attempt to catch exceptions caused by HTTP
     * errors! It is recommended to wrap this method in a try/catch block.
     *
     * @param RequestInterface $request
     * @param array $options
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getResponse(RequestInterface $request, array $options = []) : ResponseInterface
    {
        return $this->getHttpClient()->send($request, $options);
    }

    /**
     * @param string $url
     * @param array $params
     * @return string
     */
    public function buildWebUrl(string $url, $params = []) : string{
        return $this->buildUrl('web', $url, $params);
    }

    /**
     * @param string $url
     * @param array $params
     * @return string
     */
    public function buildApiUrl(string $url, $params = []) : string{
        return $this->buildUrl('api', $url, $params);
    }

    /**
     * @param string $endpoint
     * @param string $url
     * @param $params
     * @return string
     */
    private function buildUrl(string $endpoint, string $url, array $params): string
    {
        $url = $this->getValueByKey($this->getEndpoints(), $endpoint) . $url;
        $url = $this->appendQuery($url, $this->buildQueryString($params));

        return $url;
    }

    /**
     * Appends a query string to a URL.
     *
     * @param  string $url The URL to append the query to
     * @param  string $query The HTTP query string
     * @return string The resulting URL
     */
    private function appendQuery($url, $query)
    {
        $query = trim($query, '?&');
        if ($query) {
            $glue = strstr($url, '?') === false ? '?' : '&';
            return $url . $glue . $query;
        }
        return $url;
    }

    /**
     * Sends a request and returns the parsed response.
     *
     * @param RequestInterface $request
     * @return array
     * @throws ConsumerRewardsException
     * @throws MaxReachedException
     */
    public function getParsedResponse(RequestInterface $request)
    {
        try {
            $response = $this->getResponse($request);
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
        }
        $parsed = $this->parseResponse($response);

        return $parsed;
    }

    /**
     * Parses the response
     *
     * @param ResponseInterface $response
     * @return array
     * @throws MaxReachedException|ConsumerRewardsException
     */
    protected function parseResponse(ResponseInterface $response)
    {
        $content = $response->getBody();

        if ($response->getStatusCode() != HttpStatus::HTTP_OK) {
            if ($response->getStatusCode() === HttpStatus::HTTP_TOO_MANY_REQUESTS) {
                $errors = array_pop(json_decode($content)->errors);
                switch ($errors->errorCode) {
                    case 'UserMaxReached':
                        throw new MaxUserReachedException($errors->errorCode);
                    case 'PackageMaxReached':
                        throw new MaxPackageReachedException($errors->errorCode);
                    default:
                        throw new MaxReachedException($errors->errorCode);
                }
            }
            throw new ConsumerRewardsException("Error in Request: " . $response->getStatusCode());
        } else {
            return $this->parseJson($content);
        }
    }

    protected function parseJson($content)
    {
        $content = json_decode($content);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \UnexpectedValueException(sprintf(
                "Failed to parse JSON response: %s",
                json_last_error_msg()
            ));
        }
        return $content;
    }

    /**
     * Method to Cast response to Object of toClass Instance
     *
     * @param RequestInterface $request
     * @param string $toClass
     * @return array|\JMS\Serializer\scalar|mixed|object
     * @throws ConsumerRewardsException
     */
    public function getSerializedResponse(RequestInterface $request, string $toClass) {
        $response = $this->getParsedResponse($request);

        $serializer = SerializerBuilder::create()->build();

//        $serializer = SerializerBuilder::create()->configureHandlers(function(HandlerRegistry $registry) {
//            $registry->registerSubscribingHandler(new LinkPackDeserializeHandler());
//        })->build();

//        $serializer = SerializerBuilder::create()->configureListeners(function(EventDispatcher $dispatcher) {
//            $dispatcher->addSubscriber(new LinksHateoasEventSubscriber());
//        })->build();

        $json = $serializer->serialize($response, 'json');
        $object  = $serializer->deserialize($json, $toClass, 'json');

        if (!($object instanceof $toClass)) {
            throw new ConsumerRewardsException("Error Serialized Response of class " .  $toClass);
        }

        return $object;
    }
}