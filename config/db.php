<?php

use \Dykyi\Common\Config;

return [
    'mysql' => [
        'host' => Config::env('DB_HOST'),
        'db'   => Config::env('DB_DATABASE'),
        'user' => Config::env('DB_USERNAME'),
        'password' => Config::env('DB_PASSWORD'),
    ],
];