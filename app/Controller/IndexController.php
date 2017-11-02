<?php

namespace Dykyi\Controller;

use Dykyi\Services\Push\PushClass;
use Dykyi\Services\Push\PushFactory;
use Dykyi\ControllerAbstract;
use Dykyi\Model\FriendsModel;
use Dykyi\Model\RequestModel;
use Dykyi\Model\UsersModel;

/**
 * Class IndexController
 * @package Dykyi
 *
 * @property UsersModel $userModel
 * @property FriendsModel $friendModel
 * @property RequestModel $requestModel
 */
class IndexController extends ControllerAbstract
{
    protected $userModel;
    protected $friendModel;
    protected $requestModel;

    protected $user = [];

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
            $usersList = $this->userModel->getAllWithoutMe();
        }
        else {
            $usersList = $this->userModel->getAll();
        }

        return $this->view('', [
            'requestCount' => $this->requestModel->getUserRequestCount(),
            'user'         => $this->userModel->getUserInfo(),
            'usersList'    => $usersList,
            'friendsList'  => $this->friendModel->getUserFriends(),
        ]);
    }

    public function changeStatus()
    {
        $userStatus = $this->post->get('id');
        $status     = $this->userModel->changeUserStatus($userStatus);

        return $this->json(['success' => $status]);
    }

    public function removeFriend()
    {
        $status = $this->friendModel->removeFriendByUserId($this->post->get('id'));
        if ($status) {
            $pusher = new PushFactory(new PushClass());
            $pusher->send(['user' => [
                    'id' => $this->session->get('id'),
                    'name' => $this->session->get('name'),]], 'friend-remove-event'
            );
        }

        return $this->json(['success' => $status]);
    }

}
