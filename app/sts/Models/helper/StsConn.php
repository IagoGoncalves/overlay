<?php
namespace Sts\Models\helper;

use PDO;
use PDOException;

if(!defined('URL')) {
    header("Location: /mvc/");
    exit;
}

class StsConn {
    
    private static $name = DB_NAME;
    private static $host = DB_HOST;
    private static $user = DB_USER;
    private static $pass = DB_PASS;
    
    private static $pdo;

    public static function getConnect() {

        if(empty(self::$pdo)) {
            try {
                self::$pdo = new PDO(
                    "mysql:dbhost=" . self::$host . ";dbname=" . self::$name,
                    self::$user,
                    self::$pass
                );
    
            } catch (PDOException $e) {
                die("<h1>Oooooooooppppppssss, Erro no Banco");
            }
        }

        return self::$pdo;
    }
}