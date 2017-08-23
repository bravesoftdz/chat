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

}

/**
 * Class Session
 * @package Dykyi\Common
 */
class Session implements ISession
{

    public function get($key)
    {
        return empty($_SESSION[$key]) ? '' : $_SESSION[$key];
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
        return $_SESSION[$key];
    }

}