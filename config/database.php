<?php

namespace Config;

class Database {
    private static $instance = null;
    private $connection;
    
    private function __construct() {
        $config = require_once 'config.php';
        try {
            $this->connection = new \PDO(
                "pgsql:host={$config['host']};dbname={$config['database']}",
                $config['username'],
                $config['password']
            );
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e) {
            throw new \Exception("Connection failed: " . $e->getMessage());
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
}
