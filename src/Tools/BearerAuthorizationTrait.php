<?php namespace ConsumerRewards\SDK\Tools;

/**
 * Enables `Bearer` header authorization for providers.
 *
 * @link http://tools.ietf.org/html/rfc6750 Bearer Token Usage (RFC 6750)
 */
trait BearerAuthorizationTrait
{
    /**
     * Returns authorization headers for the 'bearer' grant.
     *
     * @param  mixed|null $token Either a string or an access token instance
     * @return array
     */
    protected function getAuthorizationHeaders($token = null)
    {
        //return ['Authorization' => 'Bearer ' . $token];
        return ['Authorization' =>  $token];
    }
}