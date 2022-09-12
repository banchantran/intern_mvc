<?php

class Config
{
    private static $config = [
        'version'               => '0.0.1',
        'db_host'               => '127.0.0.1',
        'db_name'               => 'db_project1',
        'db_user'               => 'root',
        'db_password'           => '',
    ];

    public static function get($key)
    {
        return array_key_exists($key, self::$config) ? self::$config[$key] : NULL;
    }
}
