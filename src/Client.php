<?php

namespace brezgalov\ApiWrapper;

/**
 * Extend this class in order to create api client
 * @package brezgalov\ApiWrapper
 */
class Client
{
    /**
     * @var string
     */
    public $baseUrl = '';

    /**
     * store your token here
     * @var string
     */
    public $token;

    /**
     * prepare request
     * @param $path
     * @return Request
     */
    public function prepareRequest($path)
    {
        return (new Request())->setUrl($this->baseUrl)->setPath($path);
    }
}