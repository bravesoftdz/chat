<?php

namespace Dykyi\Common;

/**
 * Class Login
 */
class Login
{
    private $error = '';
    private $user  = null;

    public function __construct($post)
    {
        $this->user = new User($post);
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param User $existUser
     * @return bool
     */
    public function verifyUser(User $existUser)
    {
        if ($this->user->getUserEmail() == $existUser->getUserEmail()) {
            if (password_verify($this->user->getPassword(), $existUser->getPassword())) {
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
     * @param $user
     * @return bool
     */
    public function remember($user)
    {
        $hour = time() + 3600 * 24 * 30;
        setcookie('user', $user->name, $hour);
        setcookie('password', $user->password, $hour);
        return true;
    }
}