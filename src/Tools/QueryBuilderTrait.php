<?php namespace ConsumerRewards\SDK\Tools;
/**
 * Provides a standard way to generate query strings.
 */
trait QueryBuilderTrait
{
    /**
     * Build a query string from an array.
     *
     * @param array $params
     *
     * @return string
     */
    protected function buildQueryString(array $params)
    {
        return http_build_query($params, null, '&', \PHP_QUERY_RFC3986);
    }
}