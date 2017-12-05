<?php

namespace Dykyi\Common;

/**
 * Class Session
 * @package Dykyi\Common
 */
class Session implements SessionInterface, GetDataInterface
{
    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        return empty($_SESSION[$key]) ? '' : $_SESSION[$key];
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
        return $_SESSION[$key];
    }

    /**
     * {@inheritdoc}
     */
    public function remove($key)
    {
        unset($_SESSION[$key]);
        return true;
    }

}