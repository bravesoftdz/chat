<?php

namespace Dykyi\Common;

/**
 * Class PostData
 * @package Dykyi\Common
 */
class PostData  extends GetDataAbstract
{
    /**
     * PostData constructor.
     */
    public function __construct()
    {
        $this->data = $_POST;
    }

}