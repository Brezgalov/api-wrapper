<?php

namespace brezgalov\ApiWrapper;

class Response
{
    public $status;

    public $errors = [];

    public $data = null;

    public function isSuccess()
    {
        return empty($this->errors);
    }
}