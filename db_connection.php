<?php

class Database {
    private $conn;

    public function __construct() {
        $dbHost = $_ENV['DB_HOST'] ?? 'localhost';
        $dbName = $_ENV['DB_NAME'] ?? 'your_database_name';
        $dbUser = $_ENV['DB_USER'] ?? 'your_database_user';
        $dbPassword = $_ENV['DB_PASSWORD'] ?? 'your_database_password';

        try {
            // Create a PDO connection
            $this->conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);

            // Set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //echo "Database connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
