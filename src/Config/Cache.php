<?php namespace ConsumerRewards\SDK\Config;

use Cache\Adapter\Apcu\ApcuCachePool;
use Cache\Adapter\Common\AbstractCachePool;
use Cache\Adapter\Filesystem\FilesystemCachePool;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class Cache extends AbstractConfig
{

    /**
     * @inheritdoc
     */
    protected function getName() : string
    {
        return 'cache';
    }

    /**
     * @param array $options
     *
     * @return AbstractCachePool $cache
     */
    public function config(array $options)
    {
        if (function_exists('apcu_fetch')) {
            return new ApcuCachePool();
        } else {
            //TODO: get cacheDir from options
            $tmp_dir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'sdk-cr' . DIRECTORY_SEPARATOR;

            if (!file_exists($tmp_dir)) {
                mkdir($tmp_dir);
            }

            return new FilesystemCachePool(new Filesystem(new Local($tmp_dir)));
        }
    }
}
