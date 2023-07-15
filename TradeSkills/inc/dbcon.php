<?php
class DatabaseConnection
{
    private $conn;

    public function __construct()
    {
        $config = require 'config.php';

        $host = $config['db_host'];
        $username = $config['db_username'];
        $password = $config['db_password'];
        $database = $config['db_name'];

        $this->conn = new mysqli($host, $username, $password, $database);

        if ($this->conn->connect_error) {
            error_log("Connection failed: " . $this->conn->connect_error);
            throw new Exception("Failed to connect to the database.");
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }


    public static function sanitizeInput($input)
    {
        $trimmedInput = trim($input);
        $sanitizedInput = htmlspecialchars($trimmedInput, ENT_QUOTES, 'UTF-8');
        return $sanitizedInput;
    }

    public function executeQuery($query, $params = [])
    {
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Query preparation failed: " . $this->conn->error);
        }
        if (!empty($params)) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }
        $result = $stmt->execute();
        if (!$result) {
            throw new Exception("Query execution failed: " . $stmt->error);
        }
        return $result;
    }

    public function insert($table, $data)
    {
        $columns = implode(',', array_keys($data));
        $placeholders = implode(',', array_fill(0, count($data), '?'));
        $values = array_values($data);
        
        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        return $this->executeQuery($query, $values);
    }

}
?>

