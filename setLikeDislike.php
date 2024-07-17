<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('configs.php');

if(isset($_POST['type']) && $_POST['type'] !== '' && isset($_POST['id']) && $_POST['id'] > 0) {
    $type = mysqli_real_escape_string($con, $_POST['type']);
    $id = mysqli_real_escape_string($con, $_POST['id']);
    
    if($type == 'like') {
        if(isset($_COOKIE['like_'.$id])) {
            setcookie('like_'.$id, '', 1);
            $sql = "UPDATE guide SET like_count = like_count - 1 WHERE id = '$id'";
            $operation = 'unlike';
        } else {
            if(isset($_COOKIE['dislike_'.$id])) {
                setcookie('dislike_'.$id, '', 1);
                mysqli_query($con, "UPDATE guide SET dislike_count = dislike_count - 1 WHERE id = '$id'");
            }
            
            setcookie('like_'.$id, 'yes', time() + 60*60*24*365*5);
            $sql = "UPDATE guide SET like_count = like_count + 1 WHERE id = '$id'";
            $operation = 'like';
        }
    }
    
    if($type == 'dislike') {
        if(isset($_COOKIE['dislike_'.$id])) {
            setcookie('dislike_'.$id, '', 1);
            $sql = "UPDATE guide SET dislike_count = dislike_count - 1 WHERE id = '$id'";
            $operation = 'undislike';
        } else {
            if(isset($_COOKIE['like_'.$id])) {
                setcookie('like_'.$id, '', 1);
                mysqli_query($con, "UPDATE guide SET like_count = like_count - 1 WHERE id = '$id'");
            }
            
            setcookie('dislike_'.$id, 'yes', time() + 60*60*24*365*5);
            $sql = "UPDATE guide SET dislike_count = dislike_count + 1 WHERE id = '$id'";
            $operation = 'dislike';
        }
    }
    
    mysqli_query($con, $sql);
    
    $row = mysqli_fetch_assoc(mysqli_query($con, "SELECT like_count, dislike_count FROM guide WHERE id = '$id'"));
    
    echo json_encode([
        'operation' => $operation,
        'like_count' => $row['like_count'],
        'dislike_count' => $row['dislike_count']
    ]);
}
?>
