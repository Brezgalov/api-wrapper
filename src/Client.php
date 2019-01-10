<?php

namespace brezgalov\ApiWrapper;

/**
 * Extend this class in order to create api client
 * @package brezgalov\ApiWrapper
 */
class Client
{
    /**
     * get Api base url
     * @return string
     */
    public function getBasePath()
    {
        return '';
    }

    /**
     * Get access token here
     * @return string
     */
    public function getAccessToken()
    {
        return '';
    }

    /**
     * prepare request
     * @param $path
     * @return Request
     */
    public function prepareRequest($path)
    {
        return (new Request())->setUrl($this->getBasePath())->setPath($path);
    }
}