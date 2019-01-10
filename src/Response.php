<?php

namespace brezgalov\ApiWrapper;

/**
 * Class contains api response
 * @package brezgalov\ApiWrapper
 */
class Response
{
    /**
     * @var http response status
     */
    public $status;

    /**
     * Possible errors
     * @var array
     */
    public $errors = [];

    /**
     * Server response
     * @var null
     */
    public $data = null;

    /**
     * Response has no errors and $status ~ 200?
     * @return bool
     */
    public function isSuccessful()
    {
        return empty($this->errors) && $this->status >= 200 && $this->status < 300;
    }
}