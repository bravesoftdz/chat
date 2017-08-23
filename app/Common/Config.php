<?php

namespace Dykyi\Common;

/**
 * Lazy loading registry config patter
 */
class Config
{
    /**
     * @var mixed[]
     */
    protected static $data = array();
    /**
     * Add data to registry
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set($key, $value)
    {
        self::$data[$key] = $value;
    }
    /**
     * get data from registry
     *
     * @param string $key
     * @return mixed
     */
    public static function get($key)
    {
        return isset(self::$data[$key]) ? self::$data[$key] : self::load($key);
    }

    /**
     * @param $key
     *
     * @return mixed|null
     */
    public static function load($key)
    {
        $configPath = ROOT_DIR . '/config/' . $key  .'.php';
        if (file_exists($configPath)) {
            $data = require_once ROOT_DIR . '/config/' . $key . '.php';
            self::$data[$key] = $data;
            return self::$data[$key];
        }
        return null;
    }

    /**
     * Remove data from the key
     *
     * @param string $key
     * @return void
     */
    final public static function removeProduct($key)
    {
        if (array_key_exists($key, self::$data)) {
            unset(self::$data[$key]);
        }
    }
}