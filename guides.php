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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guides</title>
    <link rel="stylesheet" href="css/guides.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="js/jquery-1.11.1.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
    <style type="text/css">
        .guide-container img {
            width: 100%;
            height: 250px;
        }
    </style>
</head>
<body>
<?php include 'includes/navbar.php'; ?>

<aside>
    <h1 style="margin-top: 120px;">All Guides</h1>
    <?php
    try {
        $stmt = $pdo->prepare("SELECT *, like_count, dislike_count FROM guide WHERE status = '1'");
        $stmt->execute();

        $totalGuides = $stmt->rowCount();
        echo "<h4>Total number of guides: $totalGuides</h4>";

        if ($stmt->rowCount() < 1) {
            echo '<li>No Guide Available</li>';
        } else {
            $inc = 0;
            echo "<ul>";

            foreach ($stmt as $row) {
                $image = (!empty($row['image'])) ? 'images/guide_images/' . $row['image'] : 'images/noimage.jpg';
                $inc++;

                $likeClass = "far";
                if (isset($_SESSION['liked_disliked_guides'][$row['id']]) && $_SESSION['liked_disliked_guides'][$row['id']] === 'like') {
                    $likeClass = "fas";
                }

                $dislikeClass = "far";
                if (isset($_SESSION['liked_disliked_guides'][$row['id']]) && $_SESSION['liked_disliked_guides'][$row['id']] === 'dislike') {
                    $dislikeClass = "fas";
                }

                echo "
                    <div class='guide-container'>
                        <h2><a href='guide.php?guide=" . $row['slug'] . "'>" . $row['title'] . "</a></h2>";

                if (isset($_SESSION['user_name']) || isset($_SESSION['admin_name'])) {
                    echo "
                        <span class='pull-right'>
                            <i class='fa fa-thumbs-up like-icon ".$likeClass."' onclick='setLikeDislike(\"like\",".$row['id'].")' id='like_".$row['id']."'></i>
                            <div class='like-count' id='like_count_" . $row['id'] . "'>".$row['like_count']."</div>
                            &nbsp;&nbsp;<i class='fa fa-thumbs-down dislike-icon ".$dislikeClass."' onclick='setLikeDislike(\"dislike\"," . $row['id'] . ")' id='dislike_" . $row['id'] . "'></i>
                            <div class='dislike-count' id='dislike_count_".$row['id']."'>".$row['dislike_count']."</div>
                        </span>
                    ";
                } else {
                    echo "
                        <i class='fa fa-thumbs-up'></i>" . $row['like_count'] . "
                        <i class='fa fa-thumbs-down'></i>" . $row['dislike_count'] . "";
                }

                echo "
                        <img src='" . $image . "' data-cycle-title='" . $row['title'] . "' width='380px'/>
                    </div>";

                if ($inc % 3 == 0) {
                    echo "</ul><ul>";
                }
            }

            echo "</ul>";
        }
    } catch (PDOException $e) {
        echo "There is some problem in connection: " . $e->getMessage();
    }
    ?>
</aside>

<?php include 'includes/footer.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    function setLikeDislike(type, id) {
        $.ajax({
            url: 'setLikeDislike.php',
            type: 'post',
            data: 'type=' + type + '&id=' + id,
            success: function(result) {
                result = $.parseJSON(result);
                if (result.operation == 'like') {
                    $('#like_' + id).removeClass('far').addClass('fas');
                    $('#dislike_' + id).removeClass('fas').addClass('far');
                } else if (result.operation == 'unlike') {
                    $('#like_' + id).removeClass('fas').addClass('far');
                } else if (result.operation == 'dislike') {
                    $('#dislike_' + id).removeClass('far').addClass('fas');
                    $('#like_' + id).removeClass('fas').addClass('far');
                } else if (result.operation == 'undislike') {
                    $('#dislike_' + id).removeClass('fas').addClass('far');
                }

                $('#like_count_' + id).html(result.like_count);
                $('#dislike_count_' + id).html(result.dislike_count);
            }
        });
    }
</script>

</script>
</body>
</html>
