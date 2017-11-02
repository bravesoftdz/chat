<?php

namespace Dykyi\Common;

/**
 * Class PostData
 * @package Dykyi\Common
 */
class PostData implements IGetData
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * PostData constructor.
     */
    public function __construct()
    {
        $this->data = $_POST;
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