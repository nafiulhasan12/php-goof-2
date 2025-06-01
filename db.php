<?php
$connection = 'localhost';
$username = 'phpgoof';
$connection = 'localhost';
$username = 'phpgoof';
$password = 'password';
$database = 'phpgoof';

class Database {
    private $connection;
    private $username;
    private $password;
    private $database;

    public function __construct() {
        $this->connection = 'localhost';
        $this->username = 'phpgoof';
        $this->password = 'password';
        $this->database = 'phpgoof';
        $this->connect();
    }

    private function connect() {
        $conn = mysqli_connect($this->connection, $this->username, $this->password, $this->database);
    }
}

session_start();

$db = new Database();
$database = 'phpgoof';

session_start();

$conn = mysqli_connect($connection, $username, $password, $database);

?>