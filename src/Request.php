<?php

namespace brezgalov\ApiWrapper;

class Request
{
    /**
     * base api url
     * @var string
     */
    public $baseUrl = '';

    /**
     * endpoint name
     * @var string
     */
    public $path = '';

    /**
     * request verb
     * @var string
     */
    public $method = 'GET';

    /**
     * @var array|string
     */
    public $queryParams = [];

    /**
     * @var array|string
     */
    public $bodyParams = [];

    /**
     * @param $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->baseUrl = $url;
        return $this;
    }

    /**
     * @param $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param $method
     * @return $this
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @param $param
     * @return bool
     */
    public function validateParams($param)
    {
        if (!is_string($param) && !is_array($param)) {
            throw new \Exception('Формат параметров обязан быть string или array');
        }
    }

    /**
     * @param $params
     * @return $this
     * @throws \Exception
     */
    public function setBodyParams($params)
    {
        $this->validateParams($params);
        $this->bodyParams = $params;
        return $this;
    }

    /**
     * @param $params
     * @return $this
     * @throws \Exception
     */
    public function setQueryParams($params)
    {
        $this->validateParams($params);
        $this->queryParams = $params;
        return $this;
    }

    /**
     * Prepare resource
     * @return resource
     */
    public function prepareCurlResourse()
    {
        $method = strtoupper($this->method);
        $path = $this->path;
        if (!empty($this->queryParams)) {
            if (is_string($this->queryParams)) {
                $path .= '?' . $this->queryParams;
            } else {
                $path .= '?' . http_build_query($this->queryParams);
            }

        }
        $ch = curl_init($this->baseUrl . $path);
        if (!in_array($method, ['GET', 'HEAD', 'OPTIONS'])) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            if (!empty($this->bodyParams)) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $this->bodyParams);
            }
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return $ch;
    }

    /**
     * Execute request and get response
     * @param array $decorator - array of IResourceDecorator
     * @return array
     */
    public function exec(array $decorators = [])
    {
        $ch = $this->prepareCurlResourse();
        foreach ($decorators as $decorator) {
            if ($decorator instanceof IResourceDecorator) {
                $decorator->decorate($ch);
            }
        }
        $data = $this->getResponse($ch);
        curl_close($ch);
        return $data;
    }

    /**
     * Parse response from resource
     * @param resource $ch
     * @return array
     */
    public function getResponse($ch)
    {
        return [
            'data' => curl_exec($ch),
            'errno' => curl_errno($ch),
            'error' => curl_error($ch),
        ];
    }
}