<?php

namespace Dykyi\Controller;

use Dykyi\AbstractController;
use Dykyi\Common\PusherClass;
use Dykyi\Common\PushFactory;
use Dykyi\Model\RequestModel;

/**
 * Class ControllerRequest
 * @package Dykyi
 *
 * @property $requestModel requestModel;
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
    }

    public function index()
    {
        $this->requestList = $this->requestModel->getUserRequest();
        $this->view();
        return true;
    }

    /**
     * Json request
     */
    public function add()
    {
        $status = $this->requestModel->sendRequest($this->post->get('id'));
        if ($status) {
            $pusher = new PushFactory(new PusherClass());
            $pusher->send(['user' => ['id' => $this->post->get('id')]]);
        }
        echo json_encode(['success' => $status]);
    }

    public function accepted()
    {
        $status = $this->requestModel->accepted($this->post->get('id'));
        echo json_encode(['success' => $status]);
    }

    public function decline()
    {
        $status = $this->requestModel->decline($this->post->get('id'));
        echo json_encode(['success' => $status]);
    }

}
