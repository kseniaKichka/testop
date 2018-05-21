<?php


class Db {
    public static function getConnection() {
        $paramsPath = 'app/core/params.php';
        $params = include($paramsPath);

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new \PDO($dsn, $params['user'], $params['password']);

        $db->exec("set names utf8");
        return $db;
    }
}

