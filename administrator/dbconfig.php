<?php

$host = "localhost";
$database = "greenville";
$username = "root";
$password = "";

$db = new mysqli($host, $username, $password, $database);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
