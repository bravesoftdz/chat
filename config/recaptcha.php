<?php

use Dykyi\Common\Config;

return [
    'url'     => Config::env('RECAPTCHA_URL'),
    'secret'  => Config::env('RECAPTCHA_SECRET'),
    'private' => Config::env('RECAPTCHA_PRIVATE'),
];
