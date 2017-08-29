<?php

namespace Dykyi\Controller;

use Dykyi\AbstractController;
use Dykyi\Model\MessageModel;

/**
 * Class ControllerMessages
 * @package Dykyi
 *
 * @property $messageModel MessageModel;
 */
class ControllerMessage extends AbstractController
{
    protected $messageModel;

    public function __construct()
    {
        parent::__construct();
        $this->messageModel = new MessageModel();
    }

    public function index()
    {
        return true;
    }

    public function send()
    {
        $recipient_id = $this->post->get('id');
        $message      = $this->post->get('message');
        $status       = $this->messageModel->sendMessage($recipient_id, $message);
        echo json_encode(['success' => $status]);
    }

    public function read()
    {
        $messageText = $this->messageModel->readMessage();
        echo json_encode(['success'     => $messageText !== false, 'messageText' => $messageText]);
    }

    public function getMessageHistory()
    {
        $recipient_id = $this->post->get('id');
        $messages     = $this->messageModel->getMessageHistory($recipient_id);
        echo json_encode(['success'  => $messages !== false, 'messages' => $messages]);
    }
}
