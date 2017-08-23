<?php

namespace Dykyi\Common;

/**
 * Class User
 */
class User
{
    private $email;
    private $id;
    private $password;

    /**
     * User constructor.
     * @param array $data
     */
    public function __construct($data)
    {
        $this->id       = empty($data['id']) ? null : $data['id'];
        $this->email    = $data['email'];
        $this->password = $data['password'];
    }

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->email;
    }

    public function getUserID()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
}