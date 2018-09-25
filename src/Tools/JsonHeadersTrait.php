<?php namespace ConsumerRewards\SDK\Tools;
/**
 * Provides a standard way to generate query strings.
 */
trait JsonHeadersTrait
{

    /**
     * Returns the default headers used by this provider.
     *
     * Typically this is used to set 'Accept' or 'Content-Type' headers.
     *
     * @return array
     */
    protected function getJsonHeaders()
    {
        return ['Content-Type' => 'application/json'];
    }
}