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
    private $push;

    /**
     * PushFactory constructor.
     * @param PushInterface $push
     */
    public function __construct(PushInterface $push)
    {
        $this->push = $push;
    }

    /**
     * @param $data
     * @param $event
     * @param string $chanel
     * @return mixed
     */
    public function send($data, $event, $chanel = 'chat-channel')
    {
        return $this->push->send($data, $event, $chanel);
    }

}