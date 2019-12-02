<?php namespace ConsumerRewards\SDK\Transfer;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class Item
{
    /**
     * @var string $objectId
     * @Type("string")
     * @SerializedName("objectId")
     */
    protected $objectId = '';

    /**
     * @var string $key
     * @Type("string")
     */
    protected $key = '';

    /**
     * @var string $displayName
     * @Type("string")
     * @SerializedName("displayName")
     */
    protected $displayName = '';

    /**
     * @var string $caption
     * @Type("string")
     */
    protected $caption = '';

    /**
     * @var string $url
     * @Type("string")
     */
    protected $url = '';

    /**
     * @var Document $document
     * @Type("ConsumerRewards\SDK\Transfer\Document")
     */
    protected $document;

    /**
     * @var string $createdOn
     * @Type("string")
     * @SerializedName("createdOn")
     */
    protected $createdOn;

    /**
     * @var string $publishedOn
     * @Type("string")
     * @SerializedName("publishedOn")
     */
    protected $publishedOn;

    /**
     * @var string $expiresOn
     * @Type("string")
     * @SerializedName("expiresOn")
     */
    protected $expiresOn;

    /**
     * @var array(Configuration)
     * @Type("array<ConsumerRewards\SDK\Transfer\Configuration>")
     */
    protected $configurations;

    /**
     * Item constructor.
     * @param string $objectId
     * @param string $key
     * @param string $displayName
     * @param string $caption
     * @param string $url
     * @param Document $document
     * @param string $createdOn
     * @param string $publishedOn
     * @param string $expiresOn
     */
    public function __construct(string $objectId = null, string $key = null, string $displayName = null, string $caption = null, string $url = null, Document $document = null, string $publishedOn = null, string $expiresOn = null, $configurations = null)
    {
        $this->objectId = $objectId;
        $this->key = $key;
        $this->displayName = $displayName;
        $this->caption = $caption;
        $this->url = $url;
        $this->document = $document;
        $this->publishedOn = $publishedOn;
        $this->expiresOn = $expiresOn;
        $this->configurations = $configurations;
    }

    /**
     * @return string
     */
    public function getObjectId(): string
    {
        return $this->objectId;
    }

    /**
     * @param string $objectId
     * @return Item
     */
    public function setObjectId(string $objectId): Item
    {
        $this->objectId = $objectId;
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
     * @return Item
     */
    public function setKey(string $key): Item
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    /**
     * @param string $displayName
     * @return Item
     */
    public function setDisplayName(string $displayName): Item
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @param string $caption
     * @return Item
     */
    public function setCaption(string $caption): Item
    {
        $this->caption = $caption;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Item
     */
    public function setUrl(string $url): Item
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return Document
     */
    public function getDocument(): Document
    {
        return $this->document;
    }

    /**
     * @param Document $document
     * @return Item
     */
    public function setDocument(Document $document): Item
    {
        $this->document = $document;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedOn(): string
    {
        return $this->createdOn;
    }

    /**
     * @param string $createdOn
     * @return Item
     */
    public function setCreatedOn(string $createdOn): Item
    {
        $this->createdOn = $createdOn;
        return $this;
    }

    /**
     * @return string
     */
    public function getPublishedOn(): string
    {
        return $this->publishedOn;
    }

    /**
     * @param string $publishedOn
     * @return Item
     */
    public function setPublishedOn(string $publishedOn): Item
    {
        $this->publishedOn = $publishedOn;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpiresOn(): string
    {
        return $this->expiresOn;
    }

    /**
     * @param string $expiresOn
     * @return Item
     */
    public function setExpiresOn(string $expiresOn): Item
    {
        $this->expiresOn = $expiresOn;
        return $this;
    }

    /**
     * @return Array
     */
    public function getConfigurations(): Array
    {
        return $this->configurations;
    }

    /**
     * @param Array $configurations
     * @return Item
     */
    public function setConfigurations(Array $configurations)
    {
        $this->configurations = $configurations;
        return $this;
    }



}
