<?php

namespace Dykyi\Common;

/**
 * Class User
 */
class UserEntity
{
    private $email;
    private $name;
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
        $this->name     = $data['name'];
    }

    public function getUserEmail()
    {
        return $this->email;
    }

    public function getUserID()
    {
        return $this->id;
    }

    public function getUserName()
    {
        return $this->name;
    }

    public function getPassword()
    {
        return $this->password;
    }
}