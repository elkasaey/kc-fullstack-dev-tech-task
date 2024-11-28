<?php

namespace App\Database;

use PDO;

class DB
{
    private static $pdo;

    public static function connect()
    {
        if (!self::$pdo) {
            self::$pdo = new PDO(
                'mysql:host=db;dbname=course_catalog',
                'test_user',
                'test_password',
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        }

        return self::$pdo;
    }

    public static function query($sql, $params = [], $single = false)
    {
        $stmt = self::connect()->prepare($sql);
        $stmt->execute($params);
        return $single ? $stmt->fetch(PDO::FETCH_ASSOC) : $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
