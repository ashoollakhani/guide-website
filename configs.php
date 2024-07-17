<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection setup
$servername = "localhost";
$username = "root";
$password = ""; // Set your MySQL password here
$dbname = "guide2";

// Create connection
try {
    $con = new mysqli($servername, $username, $password, $dbname);
    if ($con->connect_error) {
        die("Database connection failed: " . $con->connect_error);
    }
} catch (Exception $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit();
}
?>
