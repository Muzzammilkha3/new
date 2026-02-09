<?php
class Database
{
    private static ?PDO $connection = null;

    public static function connection(): PDO
    {
        if (self::$connection === null) {
            $config = require __DIR__ . '/../../config/config.php';
            date_default_timezone_set($config['app']['timezone']);
            self::$connection = new PDO(
                $config['db']['dsn'],
                $config['db']['username'],
                $config['db']['password'],
                $config['db']['options']
            );
        }

        return self::$connection;
    }
}
