<?php

class BDD {
    private static $nombreDB = 'user1';
    private static $hostDB = 'localhost';
    private static $usernameDB = 'user1';
    private static $contrasenaDB = '123456';
    private static $conexion = null;

    public function __construct() {
        exit('Función inicial no está permitida');
    }

    public static function connect() {
        if (null == self::$conexion) {
            try {
                self::$conexion = new PDO("mysql:host=" . self::$hostDB . ";" . "dbname=" . self::$nombreDB, self::$usernameDB, self::$contrasenaDB);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$conexion;
    }

    public static function disconnect() {
        self::$conexion = null;
    }

}