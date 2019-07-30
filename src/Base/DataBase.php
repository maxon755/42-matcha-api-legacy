<?php

namespace App\Base;



class DataBase{

    public $pdo;
    private $tableName;
    private static $dbInstance;



    private function __construct(array $config=null)
    {
        $this->getConnection($config);
    }


    public static function getInstance(array $config=null): DataBase //string $tableName=null,
    {
        if (!self::$dbInstance)
            self::$dbInstance = new self($config);
//        if ($tableName !== null) {
//            self::$dbInstance->useTable($tableName);
//        }
        return self::$dbInstance;
    }


    private function getConnection(array $config=null): void
    {
//        $config = $config ? $config : self::$config['db'];
        $driver     = $config['driver'];
        $host       = $config['host'];
        $dbname     = $config['dbname'];
        $user       = $config['user'];
        $password   = $config['password'];
        $dsn = "{$driver}:host={$host};dbname={$dbname};user={$user};password={$password}";
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new \PDO($dsn, $user, $password, $options);
    }
}