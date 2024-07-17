<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

@include 'config.php';
session_start();

// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "guide2";

// Create connection
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit();
}

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    header('Location: guide.php');
    exit();
}

// Get the guide slug from the URL parameter
$guideSlug = $_GET['guide'] ?? '';

// Get the comment from the POST data
$comment = $_POST['comment'] ?? '';

// Prepare and execute the query to insert the comment
try {
    $stmt = $pdo->prepare("INSERT INTO comment (guide_slug, user_name, comment) VALUES (:slug, :username, :comment)");
    $stmt->execute([
        'slug' => $guideSlug,
        'username' => $_SESSION['user_name'],
        'comment' => $comment
    ]);
    
    // Redirect back to the guide page with a success message
    header('Location: guide.php?guide=' . $guideSlug . '&success=1');
    exit();
} catch (PDOException $e) {
    echo "There is some problem in connection: " . $e->getMessage();
    exit();
}
