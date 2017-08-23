<?php

if ($_ENV == 'dev') {
    return [
        'mysql' => [
            'host' => "vm-slave",
            'db'   => "uvo",
            'user' => "root",
            'password' => "password",
        ]
    ];
} else {
    return [
        'mysql' => [
            'host' => "127.0.0.1",
            'db' => "chat",
            'user' => "root",
            'password' => "",
        ]
    ];
}



