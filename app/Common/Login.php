<?php

namespace Dykyi\Common;

use Dykyi\Entity\UserEntity;

/**
 * Class Login
 */
class Login
{
    private $error = '';
    private $user  = null;

    public function __construct($post)
    {
        $this->user = new UserEntity($post);
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param UserEntity $existUser
     * @return bool
     */
    public function verifyUser(UserEntity $existUser)
    {
        if ($this->user->getUserEmail() === $existUser->getUserEmail()) {
            if (password_verify($this->user->getPassword(), $existUser->getPassword())) {
                $_SESSION['name']   = $existUser->getUserName();
                $_SESSION['user'] = $existUser->getUserEmail();
                $_SESSION['id']   = $existUser->getUserID();
                return true;
            }
        }
        else {
            $this->error = 'Error login or password!';
        }
        return false;
    }

    /**
     * @param $dayCount
     * @return int
     */
    private function days($dayCount)
    {
        return 3600*24*$dayCount;
    }

    /**
     * @param $user
     * @return bool
     */
    public function remember($user)
    {
        $hour = time() + $this->days(30);
        setcookie('user', $user->name, $hour);
        setcookie('password', $user->password, $hour);

        return true;
    }
}