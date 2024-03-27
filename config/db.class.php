<?php 
class DB {
    // Database configuration as static properties
    protected static $servername = "localhost";
    protected static $username = "root";
    protected static $password = "";
    protected static $dbname = "qlnhansu";
    
    // Database connection
    protected static $connection;
    
    // Connect to the database
    public static function connect() {
        if(!isset(self::$connection)) {
            self::$connection = new mysqli(self::$servername, self::$username, self::$password, self::$dbname);
        }

        // Handle connection error
        if(self::$connection === false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
            return false;
        }
        return self::$connection;
    }
    
    // Execute a database query
    public function query_execute($queryString) {
        $connection = self::connect(); // Use self:: to access static method
        $result = $connection->query($queryString);
        return $result;
    }
    
    // Fetch a result set as an array
    public function select_to_array($queryString) {
        $rows = array();
        $result = $this->query_execute($queryString);
        if($result === false) {
            return false;
        }
        while ($item = $result->fetch_assoc()) {
            $rows[] = $item;
        }
        return $rows;
    }
}
