<?php
if(!defined('DB_SERVER')){
    require_once("../initialize1.php");
}
class DBConnection{

    // LIVE SERVER
    private $host = "127.0.0.1:3306";
    private $username = "u510162695_ofrs_db";
    private $password = "1Ofrs_db";
    private $database = "u510162695_ofrs_db";

    // LOCALHOST
    // private $host = DB_SERVER;
    // private $username = DB_USERNAME;
    // private $password = DB_PASSWORD;
    // private $database = DB_NAME;
    
    public $conn;
    
    public function __construct(){

        if (!isset($this->conn)) {
            
            // Attempting to establish a connection to the database
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            
            // Check for connection errors and display detailed error message
            if ($this->conn->connect_error) {
                die('Connection failed: ' . $this->conn->connect_error);
            }
        }    
    }

    public function __destruct(){
        $this->conn->close();
    }
}
?>
