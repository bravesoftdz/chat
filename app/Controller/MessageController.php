<?php

namespace Dykyi\Controller;

use Dykyi\ControllerAbstract;
use Dykyi\Model\MessageModel;

/**
 * Class MessageController
 * @package Dykyi
 *
 * @property MessageModel $messageModel
 */
class MessageController extends ControllerAbstract
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

        return $this->json(['success' => $status]);
    }

    public function read()
    {
        $messageText = $this->messageModel->readMessage();

        return $this->json(['success'     => $messageText !== false, 'messageText' => $messageText]);
    }

    public function getMessageHistory()
    {
        $recipient_id = $this->post->get('id');
        $messages     = $this->messageModel->getMessageHistory($recipient_id);

        return $this->json(['success'  => $messages !== false, 'messages' => $messages]);
    }
}
