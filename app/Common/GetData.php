<?php

namespace Dykyi\Common;

/**
 * Interface IGetData
 * @package Dykyi\Common
 */
interface IGetData
{
    /**
     * Get get value
     *
     * @param $key
     * @return mixed
     */
    public function get($key);
}

/**
 * Class GetData
 * @package Dykyi\Common
 */
class GetData implements IGetData
{
    private $data = [];

    public function __construct()
    {
        $this->data = $_GET;
    }

    public function get($key = '')
    {
        if ($key == ''){
            return $this->data;
        }
        return empty($this->data[$key]) ? '' : $this->data[$key];
    }

}