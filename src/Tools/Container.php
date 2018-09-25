<?php namespace ConsumerRewards\SDK\Tools;

use ConsumerRewards\SDK\Exception\ConsumerRewardsContainerException;
use ConsumerRewards\SDK\Exception\ConsumerRewardsException;

class Container
{

    /**
     * @var array
     */
    protected static $instances = [];

    /**
     * @param $abstract
     * @param null $concrete
     */
    public static function set($abstract, $concrete = NULL)
    {
        if ($concrete === NULL) {
            $concrete = $abstract;
        }
        self::$instances[$abstract] = $concrete;
    }

    /**
     * @param $abstract
     * @return mixed|null Instance or null if not Exist
     */
    public static function get($abstract)
    {
        if (!isset(self::$instances[$abstract])) {
            return null;
        }
        return self::$instances[$abstract];
    }

}