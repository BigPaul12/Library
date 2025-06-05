<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$servername = "localhost"; 
$username = "root";         
$password = "";           
$dbname = "library";     

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>