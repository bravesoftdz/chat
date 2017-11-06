<?php

use \Dykyi\Common\Config;

return [
    'auth_key' => Config::env('PUSHER_KEY'),
    'secret'   => Config::env('PUSHER_SECRET'),
    'app_id'   => Config::env('PUSHER_APP_ID'),
    'options'  => ['encrypted' => true],
];