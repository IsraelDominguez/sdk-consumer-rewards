<?php namespace ConsumerRewards\SDK\Transfer;

use JMS\Serializer\Annotation\Type;

class Pack extends Item
{
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
    public function __construct(string $objectId, string $key, string $displayName, string $caption, string $url, Document $document, string $publishedOn, string $expiresOn, string $body, string $label)
    {
        parent::__construct($objectId, $key, $displayName, $caption, $url, $document, $publishedOn, $expiresOn);

        $this->body = $body;
        $this->label = $label;
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


}