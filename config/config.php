<?php

use Dykyi\Common\Config;

return [
    'cache' => Config::env('none'),
    'db'    => Config::env('mysql'),
    'log'   => Config::env('file'),
];

