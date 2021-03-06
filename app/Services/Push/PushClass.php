<?php

namespace Dykyi\Services\Push;

use Dykyi\Common\Config;
use Pusher\Pusher;

/**
 * Class PushClass
 * @package Dykyi\Common
 */
class PushClass implements PushInterface
{
    private $push;

    /**
     * PushClass constructor.
     * @param array $config
     */
    public function __construct($config)
    {
        $this->push = new Pusher($config['auth_key'], $config['secret'], $config['app_id'], $config['options']);
    }

    public function send($data, $event, $chanel)
    {
       return $this->push->trigger($chanel, $event, $data);
    }
}