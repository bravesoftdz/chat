<?php

namespace Dykyi\Common;

/**
 * Class PostData
 * @package Dykyi\Common
 */
class GetDataAbstract implements GetDataInterface
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * {@inheritdoc}
     */
    public function get($key = '')
    {
        if ($key === ''){
            return $this->data;
        }
        return empty($this->data[$key]) ? '' : $this->data[$key];
    }

}