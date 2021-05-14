<?php

namespace core;

class DB
{
    private $conn;

    public function __construct(
        private string $host,
        private string $user,
        private string $pass,
        private string $db,
    )
    {
        $this->connect();
        $this->createDb();
        $this->createTable();
    }

    public function connect()
    {
        try {
            $this->conn = new \PDO("mysql:host=$this->host", $this->user, $this->pass);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function createDb()
    {
        $sql = "CREATE DATABASE IF NOT EXISTS $this->db";
        $this->conn->exec($sql);
    }

    public function createTable()
    {
        $sql = "USE $this->db;
        CREATE TABLE IF NOT EXISTS urls (
            id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            url VARCHAR(255),
            short VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE = InnoDB";
        $this->conn->exec($sql);
    }

    public function insert($url, $short)
    {
        $sql = "INSERT INTO urls (url, short) VALUES (:url, :short)";
        $this->conn->prepare($sql)->execute([
            'url'   => $url,
            'short' => $short,
        ]);
    }

    public function find($key, $value)
    {
        $sql = "SELECT * FROM urls WHERE $key=:$key";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$key => $value]);
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        
        return $stmt->fetch();
    }
}