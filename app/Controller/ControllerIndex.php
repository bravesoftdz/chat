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
 * @property $requestModel RequestModel;
 */
class ControllerIndex extends AbstractController
{
    protected $userModel;
    protected $friendModel;
    protected $requestModel;

    protected $usersList   = [];
    protected $friendsList = [];
    protected $request     = [];
    protected $user        = [];

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
            $this->user = $this->userModel->getUserInfo();
        }
        else {
            $this->usersList = $this->userModel->getAll();
        }
        $this->friendsList = $this->friendModel->getUserFriends();
        $this->view();
        return true;
    }

    public function changeStatus()
    {
        $userStatus = $this->post->get('id');
        $status = $this->userModel->changeUserStatus($userStatus);
        echo json_encode(['success'  => $status]);
    }

    public function removeFriend()
    {
        $userID = $this->post->get('id');
        $status = $this->friendModel->removeFriendByUserId($userID);
        echo json_encode(['success'  => $status]);
    }

}
