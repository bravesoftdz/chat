<?php

namespace Dykyi\Controller;

use Dykyi\AbstractController;
use Dykyi\Common\PusherClass;
use Dykyi\Common\PushFactory;
use Dykyi\Model\FriendsModel;
use Dykyi\Model\RequestModel;
use Dykyi\Model\UsersModel;

/**
 * Class ControllerLogin
 * @package Dykyi
 *
 * @property $userModel UsersModel;
 * @property $friendModel FriendsModel;
 * @property $requestModel requestModel;
 */
class ControllerIndex extends AbstractController
{
    protected $userModel;
    protected $friendModel;
    protected $requestModel;

    protected $usersList   = [];
    protected $friendsList = [];
    protected $request     = [];

    public function __construct()
    {
        parent::__construct();
        $this->userModel    = new UsersModel();
        $this->requestModel = new RequestModel();
        $this->friendModel  = new FriendsModel();
    }

    public function index()
    {
        if ($this->session->get('id')) {
            $this->usersList = $this->userModel->getAllWithoutMe();
            $this->request['count'] = $this->requestModel->getUserRequestCount();
        }
        else {
            $this->usersList = $this->userModel->getAll();
        }
        $this->friendsList = $this->friendModel->getUserFriends();
        $this->view();
        return true;
    }

}
