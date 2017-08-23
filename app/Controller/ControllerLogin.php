<?php

namespace Dykyi\Controller;

use Dykyi\Common\SignUp;
use Dykyi\Common\Login;
use Dykyi\AbstractController;
use Dykyi\Model\UsersModel;

/**
 * Class ControllerLogin
 * @package Dykyi
 *
 * @property UsersModel;
 */
class ControllerLogin extends AbstractController
{
    private $message = '';

    protected $users;

    public function __construct()
    {
        parent::__construct();
        $this->users = new UsersModel();
    }

    /**
     * Login
     */
    public function login()
    {
        $login = new Login($this->post->get());
        $user  = $this->users->findByEmail($this->post->get('email'));
        if ($user) {
            $is_verify = $login->verifyUser($user);
            if ($is_verify) {
                if ($this->post->get('remember')) {
                    $login->remember($user);
                }
                $this->message = 'Welcome, ' . $user->getUserEmail();
                $this->render();
            }
            else
                $this->message = $login->getError();
        }
        return $this->render();
    }

    /**
     * @return bool
     */
    public function signup()
    {
        $signUp = new SignUp($this->post->get());
        if ($signUp->validation()) {
            if ($this->users->save($this->post->get())) {
                $this->message = 'Successful registration! Thanks!';
            }
        }
        else {
            $this->message = $signUp->getError();
        }

        return $this->render('login');
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function index()
    {
        $this->view();

        if (empty($this->post->get())) {
            return false;
        }

        if ($this->post->get('register_form')) {
            $this->signUp();
        }
        else {
            $this->login();
        }

        return true;
    }

    /**
     * Logout user
     */
    public function logout()
    {
        $this->users->logoutByEmail($this->session->get('user'));
        session_destroy();
        header("Location: /");
    }
}
