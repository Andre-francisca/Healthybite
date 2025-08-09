<?php
class Database {
    public static function connect() {
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $dbname = 'healthybite'; // change this

        $conn = new mysqli($host, $user, $pass, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}
