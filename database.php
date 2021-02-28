<?php

class Database
{

    public static function getConnection()
    {
        $params = [
            'host' => 'localhost',
            'db' => 'todo',
            'user' => 'root',
            'pass' => '1111'
        ];

        $dsn = "mysql:host={$params['host']};dbname={$params['db']}";
        $dbh = new PDO($dsn, $params['user'], $params['pass']);

        $dbh->exec("set names utf8");
        return $dbh;
    }

}

?>