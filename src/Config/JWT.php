<?php namespace ConsumerRewards\SDK\Config;


use ConsumerRewards\SDK\Exception\ConsumerRewardsSdkAuthException;
use ConsumerRewards\SDK\Security\AuthCredentials;
use ConsumerRewards\SDK\Security\Authentication;
use ConsumerRewards\SDK\Tools\Container;

class JWT extends AbstractConfig
{

    /**
     * @inheritdoc
     */
    protected function getName() : string
    {
        return 'cache';
    }

    /**
     * @var \ConsumerRewards\SDK\Security\JWT $jwt
     *
     */
    protected $jwt;
    /**
     * @param array $config
     *
     * @return JWT $jwt
     */
    public function config(array $config)
    {
        $this->jwt = Container::get('cache')->getItem('JWT')->get();

        if ((empty($this->jwt))||($this->jwt->isExpired())) {
            try {
                Container::get('logger')->debug('JWT empty or expired');

                $this->jwt = Authentication::build()
                    ->setCredentials(new AuthCredentials($config['username'], $config['password']))
                    ->authorize();

                Container::get('cache')->set('JWT', $this->jwt);
            } catch (ConsumerRewardsSdkAuthException $e) {
                Container::get('logger')->error($e->getMessage());
            }
        } else {
            Container::get('logger')->debug('Get JWT from cache');
        }

        return $this->jwt;
    }
}