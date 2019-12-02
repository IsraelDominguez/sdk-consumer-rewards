<?php namespace ConsumerRewards\SDK\Transfer;

use JMS\Serializer\Annotation\Type;

class User implements \JsonSerializable
{
    /**
     * @var string $identifier
     * @Type("string")
     */
    protected $identifier;

    /**
     * @var string $provider
     * @Type("string")
     */
    protected $provider;

    /**
     * User constructor.
     * @param string $identifier
     * @param string $provider
     */
    public function __construct(string $identifier, string $provider = 'druid')
    {
        $this->identifier = $identifier;
        $this->provider = $provider;
    }


    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     * @return User
     */
    public function setIdentifier(string $identifier): User
    {
        $this->identifier = $identifier;
        return $this;
    }

    /**
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * @param string $provider
     * @return User
     */
    public function setProvider(string $provider): User
    {
        $this->provider = $provider;
        return $this;
    }

    public function toArray()
    {
        return [
            'identifier' => $this->identifier,
            'provider' => $this->provider

        ];
    }

    /**
     * @return array|mixed to json_encode for api calls
     */
    public function jsonSerialize()
    {
        return [
            'user' => $this->toArray()
        ];
    }
}
