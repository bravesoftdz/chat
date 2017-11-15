<?php

namespace Dykyi\Common;

/**
 * Class GetData
 * @package Dykyi\Common
 */
class GetData extends GetDataAbstract
{
    /**
     * GetData constructor.
     */
    public function __construct()
    {
        $this->data = $_GET;
    }
}