<?php

$host = "localhost";
$dbname = "eventsdb";
$username = "root";
$password = "";
$root = 3307;

$mysqli = new mysqli(hostname: $host,
                     username: $username,
                     password: $password,
                     database: $dbname,
                    port: 3307);
                     
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
?>