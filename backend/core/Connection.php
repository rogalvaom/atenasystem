<?php

class Connection
{
    private $bd;

    private $username;
    private $password;
    private $host;
    private $port;
    private $dataBase;

    public function __construct()
    {
        $this->username = $_ENV['DATABASE_USERNAME'];
        $this->password = $_ENV['DATABASE_PASSWORD'];
        $this->host     = $_ENV['DATABASE_HOST'];
        $this->port     = $_ENV['DATABASE_PORT'];
        $this->dataBase = $_ENV['DATABASE_NAME'];

        try {
            $this->bd = new PDO('mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->dataBase, $this->username, $this->password);
            $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $err) {
            echo json_encode([
                "access" => false,
                "message" => 'Database connection failed: ' . $err->getMessage()
            ]);
            die();
        }
    }

    public function getConnection(): PDO
    {
        return $this->bd;
    }
}