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