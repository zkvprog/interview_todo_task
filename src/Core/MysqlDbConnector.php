<?php

namespace App\Core;

final class MysqlDbConnector
{
    private static $dbconn = null;

    public static function getInstance()
    {
        if (is_null(self::$dbconn)) {
            $dsn = "mysql:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_DATABASE']};charset=utf8";

            $options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ];

            self::$dbconn = new \PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $options);
        }

        return static::$dbconn;
    }
}