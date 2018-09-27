<?php namespace ConsumerRewards\SDK\Security;

use ConsumerRewards\SDK\Exception\ConsumerRewardsSdkAuthException;
use ConsumerRewards\SDK\Tools\Container;
use ConsumerRewards\SDK\Tools\RequiredParameterTrait;
use ConsumerRewards\SDK\Tools\UserPasswordGrantTrait;

class Authentication
{
    use RequiredParameterTrait;
    use UserPasswordGrantTrait;

    /**
     * @var AuthCredentials $credentials
     */
    private $credentials;

    /**
     * @var JWT $jwt
     */
    protected $jwt;

    public static function build() {
        return new Authentication();
    }

    /**
     * AuthCredentials constructor.
     */
    public function __construct() { }

    /**
     * @return AuthCredentials
     */
    public function getCredentials(): AuthCredentials
    {
        return $this->credentials;
    }

    /**
     * @param AuthCredentials $credentials
     * @return Authentication
     */
    public function setCredentials(AuthCredentials $credentials): Authentication
    {
        $this->credentials = $credentials;
        return $this;
    }

    /**
     * @return JWT
     */
    public function getJwt(): JWT
    {
        return $this->jwt;
    }

    /**
     * @param JWT $jwt
     */
    public function setJwt(JWT $jwt)
    {
        $this->jwt = $jwt;
    }


    /**
     * @return JWT token for Bearer Auth Request
     */
    public function authorize() {

        try {
            $this->checkRequiredParameters($this->getRequiredRequestParameters(), $this->getCredentials()->jsonSerialize());

            $options['body'] = \GuzzleHttp\json_encode($this->getCredentials());

            $request = Container::get('http')->getRequest('POST', Container::get('http')->buildApiUrl('/auth'), $options);
            $response = Container::get('http')->getResponse($request);

            if (($response->hasHeader('Authorization')) && ($response->hasHeader('Expires'))) {
                $this->setJwt(new JWT($response->getHeaderLine('Authorization'), strtotime($response->getHeaderLine('Expires'))));
            } else {
                throw new ConsumerRewardsSdkAuthException("Not Auth Response from Server");
            }

            return $this->getJwt();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }

}