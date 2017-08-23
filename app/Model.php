<?php

namespace Dykyi;

use Dykyi\Common\Database;
use Dykyi\Common\Session;

/**
 * Class Model
 * @package Dykyi
 */
abstract class Model
{
    protected $db = null;
    protected $session = [];


    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->session = new Session();
    }

}