<?php
$host = "cs361-atlee.cpt4ggui9pc3.us-east-1.rds.amazonaws.com:3306";
$dbname = "cs361";
$username = "admin";
$password = "KTqwxGtTHzzGPkp5aC9xqbnqLHE";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;

?>