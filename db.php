<?php
class DB {

    // Database variables
    private $host = "localhost";
	private $username = "root";
	private $password = "";
	private $database = "shopping-market";
	private $conn;

    // Constructor to initialize Database connection
    function __construct() {
		$this->conn = $this->connectDB();
	}

    function connectDB() {
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }
        catch(PDOException $e){
            echo "Connection error: " . $e->getMessage();
        }
  
        return $this->conn;
	}
}
?>