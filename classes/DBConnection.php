<?php
if (!defined('DB_SERVER')) {
    require_once("../initialize.php");
}

class DBConnection {
    private $host = DB_SERVER;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $database = DB_NAME;
    
    public $conn;
    
    public function __construct() {
        // Check if the constants are defined
        if (!defined('DB_SERVER') || !defined('DB_USERNAME') || !defined('DB_PASSWORD') || !defined('DB_NAME')) {
            throw new Exception("Database connection constants are not defined.");
        }

        // Create the connection
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        // Check for connection errors
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>
