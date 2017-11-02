<?php

namespace Dykyi\Controller;

use Dykyi\Services\Push\PushClass;
use Dykyi\Services\Push\PushFactory;
use Dykyi\ControllerAbstract;
use Dykyi\Model\RequestModel;
use Dykyi\Model\UsersModel;

/**
 * Class RequestController
 * @package Dykyi
 *
 * @property requestModel $requestModel
 * @property UsersModel $userModel
 */
class RequestController extends ControllerAbstract
{
    protected $friendModel;
    protected $requestModel;

    public function __construct()
    {
        parent::__construct();

        $this->requestModel = new RequestModel();
        $this->userModel = new UsersModel();
    }

    public function index()
    {
        $this->requestModel->viewed();

        return $this->view('', [
            'user'        => $this->userModel->getUserInfo(),
            'requestList' => $this->requestModel->getUserRequest(),
        ]);
    }

    /**
     * Json send request
     */
    public function add()
    {
        $status = $this->requestModel->sendRequest($this->post->get('id'));
        if ($status) {
            $pusher = new PushFactory(new PushClass());
            $pusher->send(['user' => ['id' => $this->post->get('id')]], 'request-send-event');
        }

        return $this->json(['success' => $status]);
    }

    /**
     * Json Accepted
     */
    public function accept()
    {
        $status = $this->requestModel->accept($this->post->get('id'));
        if ($status) {
            $pusher = new PushFactory(new PushClass());
            $pusher->send(['user' => [
                'id'   => $this->session->get('id'),
                'name' => $this->session->get('name')
            ], 'decline_id' => $this->session->get('id')], 'friend-accept-event');
        }

        return $this->json(['success' => $status]);
    }

    /**
     * Json Decline
     */
    public function decline()
    {
        $status = $this->requestModel->decline($this->post->get('id'));
        if ($status) {
            $pusher = new PushFactory(new PushClass());
            $pusher->send(['user' => ['id' => $this->post->get('id')], 'decline_id' => $this->session->get('id')], 'request-decline-event');
        }

        return $this->json(['success' => $status]);
    }

}
