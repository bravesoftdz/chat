<?php

namespace Dykyi\Common;

/**
 * Interface ISession
 * @package Dykyi\Common
 */
interface ISession
{
    /**
     * Get session value
     *
     * @param $key
     * @return mixed
     */
    public function get($key);

    /**
     * Set session key and value
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($key, $value);

    /**
     * Remove key from session
     *
     * @param $key
     * @return mixed
     */
    public function remove($key);
}