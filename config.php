<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "nieuwegein";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $conn -> connect_error;
    exit();
}
?>