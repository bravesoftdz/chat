<?php

namespace Dykyi\Controller;

use Dykyi\AbstractController;
use Dykyi\Common\PusherClass;
use Dykyi\Common\PushFactory;
use Dykyi\Model\RequestModel;
use Dykyi\Model\UsersModel;

/**
 * Class ControllerRequest
 * @package Dykyi
 *
 * @property $requestModel requestModel;
 * @property $userModel userModel;
 */
class ControllerRequest extends AbstractController
{
    protected $friendModel;
    protected $requestModel;

    protected $requestList = [];
    protected $request     = [];

    public function __construct()
    {
        parent::__construct();
        $this->requestModel = new RequestModel();
        $this->userModel = new UsersModel();
    }

    public function index()
    {
        $this->requestList = $this->requestModel->getUserRequest();
        $this->user = $this->userModel->getUserInfo();
        $this->requestModel->viewed();
        $this->view();
        return true;
    }

    /**
     * Json send request
     */
    public function add()
    {
        $status = $this->requestModel->sendRequest($this->post->get('id'));
        if ($status) {
            $pusher = new PushFactory(new PusherClass());
            $pusher->send(['user' => ['id' => $this->post->get('id')]], 'request-send-event');
        }
        echo json_encode(['success' => $status]);
    }

    /**
     * Json Accepted
     */
    public function accept()
    {
        $status = $this->requestModel->accept($this->post->get('id'));
        echo json_encode(['success' => $status]);
    }

    /**
     * Json Decline
     */
    public function decline()
    {
        $status = $this->requestModel->decline($this->post->get('id'));
        if ($status) {
            $pusher = new PushFactory(new PusherClass());
            $pusher->send(['user' => ['id' => $this->post->get('id')], 'decline_id' => $this->session->get('id')], 'request-decline-event');
        }
        echo json_encode(['success' => $status]);
    }

}
