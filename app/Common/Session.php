<?php

namespace Dykyi\Common;

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

    public function remove($key)
    {
        unset($_SESSION[$key]);
        return true;
    }

}