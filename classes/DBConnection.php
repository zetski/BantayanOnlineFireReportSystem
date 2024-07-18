<?php
if(!defined('DB_SERVER')){
    require_once("../initialize.php");
}
class DBConnection{

    private $host = "127.0.0.1:3306";
    private $username = "u510162695_ofrs_db";
    private $password = "1Ofrs_db";
    private $database = "u510162695_ofrs_db";
    
    public $conn;
    
    public function __construct(){

        if (!isset($this->conn)) {
            
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            
            if (!$this->conn) {
                echo 'Cannot connect to database server';
                exit;
            } 
            echo "success";           
        }    
        
    }
    public function __destruct(){
        $this->conn->close();
    }
}
?>