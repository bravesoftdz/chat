<?php

namespace Dykyi\Common;

use Pusher\Pusher;

/**
 * Interface PushInterface
 * @package Dykyi\Common
 */
interface PushInterface
{
    public function send($data, $event, $chanel);
}

/**
 * Class PusherClass
 * @package Dykyi\Common
 */
class PusherClass implements PushInterface
{
    private $push;

    public function __construct()
    {
        $config = Config::get('pusher');
        $this->push = new Pusher($config['auth_key'], $config['secret'], $config['app_id'], $config['options']);
    }

    public function send($data, $event, $chanel)
    {
        $this->push->trigger($chanel, $event, $data);
    }
}

/**
 * Class PushFactory
 * @package Dykyi\Common
 */
class PushFactory
{
    private $_push;

    public function __construct(PushInterface $push)
    {
        $this->_push = $push;
    }

    public function send($data, $event, $chanel = 'chat-channel')
    {
        $this->_push->send($data, $event, $chanel);
    }

}