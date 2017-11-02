<?php

namespace Dykyi\Services\Push;

/**
 * Class PushFactory
 * @package Dykyi\Common
 */
class PushFactory
{
    /**
     * @var PushInterface
     */
    private $_push;

    /**
     * PushFactory constructor.
     * @param PushInterface $push
     */
    public function __construct(PushInterface $push)
    {
        $this->_push = $push;
    }

    /**
     * @param $data
     * @param $event
     * @param string $chanel
     */
    public function send($data, $event, $chanel = 'chat-channel')
    {
        $this->_push->send($data, $event, $chanel);
    }

}