<?php namespace ConsumerRewards\SDK\Security;


class JWT
{
    /**
     * @var string $bearer
     */
    protected $bearer;

    /**
     * @var float $expiresAt
     */
    protected $expiresAt;

    /**
     * JWT constructor.
     * @param string $bearer
     * @param float $expiration
     */
    public function __construct(string $bearer, float $expiresAt)
    {
        $this->bearer = $bearer;
        $this->expiresAt = $expiresAt;
    }

    /**
     * @return string
     */
    public function getBearer(): string
    {
        return $this->bearer;
    }

    /**
     * @param string $bearer
     * @return JWT
     */
    public function setBearer(string $bearer): JWT
    {
        $this->bearer = $bearer;
        return $this;
    }

    /**
     * @return float
     */
    public function getExpiresAt(): float
    {
        return $this->expiresAt;
    }

    /**
     * @param float $expiresAt
     * @return JWT
     */
    public function setExpiresAt(float $expiresAt): JWT
    {
        $this->expiresAt = $expiresAt;
        return $this;
    }

    /**
     * Returns the token key.
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getBearer();
    }

    public function isExpired() {
        return microtime() >= $this->getExpiresAt();
    }
}