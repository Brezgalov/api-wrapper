<?php

namespace brezgalov\ApiWrapper;

class Response
{
    public $status;

    public $errors = [];

    public $data = null;

    public function isValid()
    {
        return empty($this->errors);
    }
}