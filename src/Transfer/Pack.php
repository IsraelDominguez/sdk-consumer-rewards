<?php namespace ConsumerRewards\SDK\Transfer;

use JMS\Serializer\Annotation\Type;

class Pack extends Item
{
    /**
     * @var string
     * @Type("string")
     */
    protected $type;

    /**
     * @var string
     * @Type("string")
     */
    protected $body;

    /**
     * @var string $label
     * @Type("string")
     */
    protected $label;

    /**
     * Pack constructor.
     * @param string $body
     * @param string $label
     */
    public function __construct(string $objectId = null, string $key = null, string $displayName = null, string $caption = null, string $url = null, Document $document = null, $configuration = null, string $publishedOn = null, string $expiresOn = null, string $body = null, string $label = null, array $configurations = null, string $type = null)
    {
        parent::__construct($objectId, $key, $displayName, $caption, $url, $document, $publishedOn, $expiresOn, $configurations);

        $this->body = $body;
        $this->label = $label;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return Pack
     */
    public function setBody(string $body): Pack
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return Pack
     */
    public function setLabel(string $label): Pack
    {
        $this->label = $label;
        return $this;
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
     * @return Pack
     */
    public function setType(string $type): Pack
    {
        $this->type = $type;
        return $this;
    }

}