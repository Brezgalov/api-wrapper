<?php

namespace brezgalov\ApiWrapper;

/**
 * Extend this class in order to create api client
 * @package brezgalov\ApiWrapper
 */
abstract class Client
{
    /**
     * @var string
     */
    protected $token;

    public function __construct($token = null)
    {
        $this->token = $token;
    }

    /**
     * get Api base url
     * @return string
     */
    abstract public function getBasePath();

    /**
     * prepare request
     * @param $path
     * @return Request
     */
    protected function prepareRequest($path)
    {
        return (new Request())->setUrl($this->getBasePath())->setPath($path);
    }
}