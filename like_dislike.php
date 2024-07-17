<?php
session_start();

@include 'config.php';

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

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['guide']) && isset($_GET['action'])) {
    $guideId = $_GET['guide'];
    $action = $_GET['action'];

    // Check if the user has already liked or disliked the guide
    if (isset($_SESSION['liked_disliked_guides'][$guideId])) {
        // User has already liked or disliked the guide
        // You can handle this scenario based on your requirements
        // echo "You have already liked or disliked this guide.";
        header("Location: guides.php");
        exit();
    }

    // Update the like or dislike count in the database
    try {
        if ($action === 'like') {
            $stmt = $pdo->prepare("UPDATE guide SET like_count = like_count + 1 WHERE id = :guideId");
        } elseif ($action === 'dislike') {
            $stmt = $pdo->prepare("UPDATE guide SET dislike_count = dislike_count + 1 WHERE id = :guideId");
        } else {
            // Invalid action
            echo "Invalid action.";
            exit();
        }

        $stmt->bindParam(':guideId', $guideId);
        $stmt->execute();

        // Mark the guide as liked or disliked for the current user
        $_SESSION['liked_disliked_guides'][$guideId] = $action;

        // Redirect back to the guides page
        header("Location: guides.php");
        exit();
    } catch (PDOException $e) {
        echo "There was an error updating the like or dislike count: " . $e->getMessage();
        exit();
    }
} else {
    // Invalid request
    echo "Invalid request.";
    exit();
}
?>
