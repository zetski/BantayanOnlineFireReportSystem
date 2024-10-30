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
        // Enable error reporting
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        // Create a new mysqli connection
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        // Check for connection errors
        if ($this->conn->connect_error) {
            die('Connect Error (' . $this->conn->connect_errno . '): ' . $this->conn->connect_error);
        }
    }

    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>
