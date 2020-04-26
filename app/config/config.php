<?php

return [

    // App
    'base_url' => 'https://framework.ru',

    // Cookie
    'cookie_path' => '/',
    'cookie_expire' => time() + 60 * 60 * 24 * 365 * 2, // 2 Year

    // Session
    'session_name' => 'session_id',

    //Security
    'csrf_protection' => TRUE,
    'csrf_expire' => time() + 7200,
    'csrf_token_name' => 'csrf_token',
    'csrf_except' => [
        
    ],

    // Time
    'default_timezone' => 'Europe/Moscow'
];