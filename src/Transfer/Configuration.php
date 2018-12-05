<?php namespace ConsumerRewards\SDK\Transfer;

use JMS\Serializer\Annotation\Type;

class Configuration
{

    const CONFIGURATION_TYPE_STRING = 'String';
    const CONFIGURATION_TYPE_BOOLEAN = 'Boolean';
    const CONFIGURATION_TYPE_INTEGER = 'Integer';

    /**
     * @var string
     * @Type("string")
     */
    protected $type;

    /**
     * @var string
     * @Type("string")
     */
    protected $key;

    /**
     * @var string
     * @Type("string")
     */
    protected $value;

    public function __construct(string $key, string $type, string $value)
    {
        $this->key = $key;
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Configuration
     */
    public function setType(string $type): Configuration
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return Configuration
     */
    public function setKey(string $key): Configuration
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return Configuration
     */
    public function setValue(string $value): Configuration
    {
        $this->value = $value;
        return $this;
    }

}