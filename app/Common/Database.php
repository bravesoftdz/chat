<?php

namespace Dykyi\Common;

use PDO;
use PDOException;

/**
 * Class Database
 * @package Dykyi\Common
 */
class Database
{
    private        $_connection;
    private static $_instance; //The single instance

    /**
     * Get an instance of the Database
     *
     * @return Database
     */
    public static function getInstance()
    {
        if (!self::$_instance) { // If no instance then make one
            new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        $config   = Config::get('db');
        $dsn      = 'mysql:dbname=' . $config['mysql']['db'] . ';host=' . $config['mysql']['host'];
        $user     = $config['mysql']['user'];
        $password = $config['mysql']['password'];
        try {
            self::$_instance = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Error conect: ' . $e->getMessage();
        }
    }

    /**
     * Magic method clone is empty to prevent duplication of connection
     */
    private function __clone()
    {
        // ...
    }

    /**
     * Get mysqli connection
     *
     * @return mixed
     */
    public function getConnection()
    {
        return $this->_connection;
    }
}