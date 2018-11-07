<?php namespace ConsumerRewards\SDK\Tools;

/**
 * Class Container This is a generic data container. Used for messages and model data classes, can contains set of
 * keys.
*/
class Container
{

    /**
     * @var array
     */
    protected static $instances = [];

    /**
     * Set a concrete class in the Container
     *
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
     * Get the concrete class stored in the Container for the abstract class required
     *
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