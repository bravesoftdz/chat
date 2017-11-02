<?php

namespace Dykyi\Common;

/**
 * Class GetData
 * @package Dykyi\Common
 */
class GetData implements IGetData
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * GetData constructor.
     */
    public function __construct()
    {
        $this->data = $_GET;
    }

    /**
     * @param string $key
     * @return array|mixed|string
     */
    public function get($key = '')
    {
        if ($key === ''){
            return $this->data;
        }

        return empty($this->data[$key]) ? '' : $this->data[$key];
    }

}