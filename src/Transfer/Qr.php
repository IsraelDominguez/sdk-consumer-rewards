<?php namespace ConsumerRewards\SDK\Transfer;

use JMS\Serializer\Annotation\Type;

class Qr
{
    const STATUS_VALID = 'valid';
    const STATUS_INVALID = 'invalid';
    CONST STATUS_REDEEM = 'redeem';

    /**
     * @var string
     * @Type("string")
     */
    protected $objectId;

    /**
     * @var string
     * @Type("string")
     */
    protected $caption;

    /**
     * @var string
     * @Type("string")
     */
    protected $url;

    /**
     * @var string
     * @Type("string")
     */
    protected $publishedOn;

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
     * @var string
     * @Type("string")
     */
    protected $status;

    /**
     * @var string
     * @Type("string")
     */
    protected $content;

    /**
     * @var Document $document
     * @Type("ConsumerRewards\SDK\Transfer\Document")
     */
    protected $document;

    /**
     * @var User $user
     * @Type("ConsumerRewards\SDK\Transfer\User")
     */
    protected $user;

    /**
     * @var string $label
     * @Type("string")
     */
    protected $label;


    /**
     * Qr constructor.
     * @param string $objectId
     * @param string $caption
     * @param string $url
     * @param string $publishedOn
     * @param string $type
     * @param string $body
     * @param string $status
     * @param string $content
     * @param Document $document
     * @param User $user
     */
    public function __construct(string $objectId, string $caption, string $label, string $url, string $publishedOn, string $type, string $body, string $status, string $content, Document $document, User $user)
    {
        $this->objectId = $objectId;
        $this->caption = $caption;
        $this->url = $url;
        $this->publishedOn = $publishedOn;
        $this->type = $type;
        $this->body = $body;
        $this->status = $status;
        $this->content = $content;
        $this->document = $document;
        $this->user = $user;
        $this->label = $label;
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
     * @return Qr
     */
    public function setObjectId(string $objectId): Qr
    {
        $this->objectId = $objectId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCaption(): string
    {
        return $this->caption;
    }

    /**
     * @param string $caption
     * @return Qr
     */
    public function setCaption(string $caption): Qr
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
     * @return Qr
     */
    public function setUrl(string $url): Qr
    {
        $this->url = $url;
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
     * @return Qr
     */
    public function setPublishedOn(string $publishedOn): Qr
    {
        $this->publishedOn = $publishedOn;
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
     * @return Qr
     */
    public function setType(string $type): Qr
    {
        $this->type = $type;
        return $this;
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
     * @return Qr
     */
    public function setBody(string $body): Qr
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Qr
     */
    public function setStatus(string $status): Qr
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Qr
     */
    public function setContent(string $content): Qr
    {
        $this->content = $content;
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
     * @return Qr
     */
    public function setDocument(Document $document): Qr
    {
        $this->document = $document;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
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
     * @return Qr
     */
    public function setLabel(string $label): Qr
    {
        $this->label = $label;
        return $this;
    }

}