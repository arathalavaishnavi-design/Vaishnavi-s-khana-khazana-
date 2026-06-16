<?php
$host = "localhost";
$db_user = "root";      // Default XAMPP username
$db_pass = "";          // Default XAMPP password
$db_name = "food_delivery_db";

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>