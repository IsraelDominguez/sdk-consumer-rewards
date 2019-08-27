<?php namespace ConsumerRewards\SDK\Transfer;

use JMS\Serializer\Annotation\Type;

class Qr extends Item
{
    const STATUS_VALID = 'valid';
    const STATUS_INVALID = 'invalid';
    const STATUS_REDEEM = 'redeem';
    const STATUS_EXPIRED = 'expired';
    const STATUS_NOT_PUBLISHED = 'not_published';

    /**
     * @var string
     * @Type("string")
     */
    protected $type;

    /**
     * @var Pack
     * @Type("ConsumerRewards\SDK\Transfer\Pack")
     */
    protected $pack;

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
     * @var User $user
     * @Type("ConsumerRewards\SDK\Transfer\User")
     */
    protected $user;

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
     * Qr constructor.
     * @param string $type
     * @param Pack $pack
     * @param string $body
     * @param string $label
     * @param User $user
     * @param string $status
     * @param string $content
     */
    public function __construct(string $objectId, string $key, string $displayName, string $caption, string $url, Document $document, string $publishedOn, string $expiresOn, string $type, Pack $pack, string $body, string $label, User $user, string $status, string $content)
    {
        parent::__construct($objectId, $key, $displayName, $caption, $url, $document, $publishedOn, $expiresOn);
        $this->type = $type;
        $this->pack = $pack;
        $this->body = $body;
        $this->label = $label;
        $this->user = $user;
        $this->status = $status;
        $this->content = $content;
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
     * @return Pack
     */
    public function getPack(): Pack
    {
        return $this->pack;
    }

    /**
     * @param Pack $pack
     * @return Qr
     */
    public function setPack(Pack $pack): Qr
    {
        $this->pack = $pack;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
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

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Qr
     */
    public function setUser(User $user): Qr
    {
        $this->user = $user;
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



}
