<?php 

require "constants.php";

class Connection {
    protected static $db;

    private function __construct() {
        try {
            $host = DB_URL;
            $dbName = DB_BANCO;
            $user = DB_USER;
            $pwd = DB_PWD;
            
            $pdo = new PDO("mysql:host=$host;dbname=$dbName", $user, $pwd);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            self::$db = new NotORM($pdo);
        } catch(PDOException $e) {
            print "Connection error!" . $e->getMessage();
            die();
        }
    }
    public static function getConnection() {
        if (!self::$db) {
            new Connection();
        }

        return self::$db;
    }
}
?>