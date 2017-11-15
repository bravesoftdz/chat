<?php

namespace Dykyi\Common;

/**
 * Interface SessionInterface
 * @package Dykyi\Common
 */
interface SessionInterface
{
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