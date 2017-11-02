<?php

namespace Dykyi\Services\Push;

/**
 * Interface PushInterface
 * @package Dykyi\Common
 */
interface PushInterface
{
    /**
     * @param $data
     * @param $event
     * @param $chanel
     * @return mixed
     */
    public function send($data, $event, $chanel);
}