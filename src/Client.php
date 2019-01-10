<?php

namespace brezgalov\ApiWrapper;

/**
 * Extend this class in order to create api client
 * @package brezgalov\ApiWrapper
 */
abstract class Client
{
    /**
     * get Api base url
     * @return string
     */
    abstract public function getBasePath();

    /**
     * Get access token here
     * @return string
     */
    public function getAccessToken()
    {
        return null;
    }

    /**
     * prepare request
     * @param $path
     * @return Request
     */
    protected function prepareRequest($path)
    {
        return (new Request())->setUrl($this->getBasePath())->setPath($path);
    }

    /**
     * check if response has any error
     * @param array $result
     * @return bool
     */
    protected function responseIsValid(array $result)
    {
        return empty($result['errno']) && empty($result['error']);
    }
}