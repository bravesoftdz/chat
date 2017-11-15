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
    private        $connection;

    /** @var PDO - The single instance */
    private static $instance;

    /**
     * Get an instance of the Database
     *
     * @return PDO Database
     */
    public static function getInstance()
    {
        // If no instance then make one
        if (!self::$instance) {
            new self();
        }

        return self::$instance;
    }

    public function __construct()
    {
        $config   = Config::get('db');
        $dsn      = 'mysql:dbname=' . $config['mysql']['db'] . ';host=' . $config['mysql']['host'];
        $user     = $config['mysql']['user'];
        $password = $config['mysql']['password'];
        try {
            self::$instance = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Error connect: ' . $e->getMessage();
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
        return $this->connection;
    }
}