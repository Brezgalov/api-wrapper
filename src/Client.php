<?php

namespace Brezgalov\ApiWrapper;

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

    /**
     * @var array of IResourceDecorator
     */
    protected $requestDecorators = [];

    /**
     * @var string
     */
    protected $requestClass = 'Brezgalov\ApiWrapper\Request';

    /**
     * Client constructor.
     * @param string $token - default is null
     */
    public function __construct($token = null)
    {
        $this->token = $token;
    }

    public function setRequestDecorators(array $decorators = [])
    {
        if (empty($decorators)) {
            $this->requestDecorators = [];
        } else {
            foreach ($decorators as $decorator) {
                $this->addRequestDecorator($decorator);
            }
        }
    }

    /**
     * Add this decorator to every request
     * @param IResourceDecorator $decorator
     */
    public function addRequestDecorator(IResourceDecorator $decorator)
    {
        $this->requestDecorators[] = $decorator;
        return $this;
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
    public function prepareRequest($path)
    {
        $requestClass = $this->requestClass;
        return (new $requestClass())
            ->setUrl($this->getBasePath())
            ->setPath($path)
            ->setDecorators($this->requestDecorators)
        ;
    }
}