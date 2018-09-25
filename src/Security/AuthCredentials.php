<?php namespace ConsumerRewards\SDK\Security;

class AuthCredentials implements \JsonSerializable
{
    /**
     * @var string $username
     */
    private $username;

    /**
     * @var string $password
     */
    private $password;

    /**
     * AuthCredentials constructor.
     * @param string $username
     * @param string $password
     */
    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return AuthCredentials
     */
    public function setUsername(string $username): AuthCredentials
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return AuthCredentials
     */
    public function setPassword(string $password): AuthCredentials
    {
        $this->password = $password;
        return $this;
    }


    public function jsonSerialize()
    {
        return [
            'username' => $this->getUsername(),
            'password' => $this->getPassword()
        ];
    }
}