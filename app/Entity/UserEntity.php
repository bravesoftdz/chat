<?php

namespace Dykyi\Entity;

use InvalidArgumentException;

/**
 * Class User
 */
class UserEntity
{
    const ERROR_1 = 'Data is Empty';

    private $email;
    private $name;
    private $id;
    private $password;

    /**
     * User constructor.
     * @throws \Exception
     * @param array $data
     */
    public function __construct($data)
    {
        if (empty($data)){
            throw new InvalidArgumentException(self::ERROR_1);
        }

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