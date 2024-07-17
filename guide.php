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
<?php
$conn = $pdo; // Use the existing PDO object

$slug = $_GET['guide'] ?? ''; // Use 'guide' instead of 'product' and add null coalescing operator

try {
    $stmt = $conn->prepare("SELECT * FROM guide WHERE slug = :slug"); // Correct the SQL query
    $stmt->execute(['slug' => $slug]);
    $guide = $stmt->fetch();
} catch (PDOException $e) {
    echo "There is some problem in connection: " . $e->getMessage();
    exit(); // Add an exit statement to stop further execution
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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.js"></script>
    <script>
        $(document).ready(function () {
            $("#slideshow").cycle({
                fx: "scrollHorz",
            });
        });
    </script>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>

    <aside>
        <h1>Guide To <?php echo $guide['title']; ?></h1>
        <ul>
            <div>
                <h2><?php echo $guide['title']; ?></h2>
                <li>Added By <?php echo $guide['user_name']; ?></li>
                <img src="<?php echo (!empty($guide['image'])) ? 'images/guide_images/'.$guide['image'] : 'images/noimage.jpg'; ?>" data-cycle-title="<?php echo $guide['title']; ?>"
                    data-cycle-desc="Coordinates: <?php echo $guide['coordinates']; ?>" width="380px">
                <p class="guide-coordinates" onclick="openGoogleMaps('<?php echo $guide['coordinates']; ?>')" >Coordinates: <?php echo $guide['coordinates']; ?></p>
                <p class="guide-description">Details: <?php echo $guide['details']; ?></p>
                <div class="comments-section">
                    <h3>Comments</h3>
                    <ul class="comments-list">
                    <?php
                         // Retrieve comments for the guide
                          $commentsStmt = $conn->prepare("SELECT * FROM comment WHERE guide_slug = :slug");
                          $commentsStmt->execute(['slug' => $guide['slug']]);
                          $comments = $commentsStmt->fetchAll();

                         // Iterate through each comment and display them
                          foreach ($comments as $comment) {
                            echo '<li> <p><strong><u>'. $comment['user_name'] .':</u></strong> ' . $comment['comment'] . '</p></li>';
                          }
                     ?> 
                    </ul>
                    <?php
        if (isset($_SESSION['user_name'])) {
            echo '
            <form class="comment-form" action="comment.php?guide='.$guide['slug'].'" method="POST" enctype="multipart/form-data">
            <input type="text" name="comment" placeholder="Add a comment" required>
            <button type="submit" name="submit">Submit</button>
      </form>
            ';
        } elseif (isset($_SESSION['admin_name'])) {
            echo '
            <form class="comment-form" action="acomment.php?guide='.$guide['slug'].'" method="POST" enctype="multipart/form-data">
            <input type="text" name="comment" placeholder="Add a comment" required>
            <button type="submit" name="submit">Submit</button>
      </form>
            ';
        }else {
            echo '
                <div></div>
            ';
        } 
        ?>
        
                </div>
            </div>
        </ul>
    </aside>

    <?php include 'includes/footer.php'; ?>

    <script>
        function openGoogleMaps(coordinates) {
            var url = "https://www.google.com/maps/search/?api=1&query=" + coordinates;
            window.open(url);
        }
    </script>
</body>

</html>
