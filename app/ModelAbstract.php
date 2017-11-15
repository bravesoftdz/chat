<?php

namespace Dykyi;

use Dykyi\Common\Database;
use Dykyi\Common\Session;

/**
 * Class ModelAbstract
 *
 * @package Dykyi
 */
abstract class ModelAbstract
{
    protected $db = null;
    protected $table = null;
    protected $session = [];

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->session = new Session();
    }

}