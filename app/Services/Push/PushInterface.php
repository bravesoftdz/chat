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
     * @return bool
     */
    public function send($data, $event, $chanel);
}