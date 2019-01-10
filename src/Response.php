<?php

namespace brezgalov\ApiWrapper;

/**
 * Stores api response
 * @package brezgalov\ApiWrapper
 */
class Response
{
    /**
     * @var array
     */
    public $response;

    /**
     * @var bool
     */
    public $isError;

    /**
     * Response constructor
     * @param array $response
     * @param bool $isError
     */
    public function __construct(array $response = [], $isError = false)
    {
        $this->response = $response;
        $this->isError = $isError;
    }
}