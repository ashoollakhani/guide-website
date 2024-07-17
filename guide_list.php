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
    <title>Website guide</title>
    <link rel="stylesheet" href="css/guides.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.js"></script>
    <style type="text/css">
        h1 {
            margin-top: 9.5rem;
            margin-bottom: 0.5rem;
        }

        h2 {
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .guide-container img {
            width: 100%;
            height:250px;
        }
    </style>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>

    <aside>
        <h1>Your Pending Guide List</h1>
        <?php
        try {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS numrows FROM guide WHERE user_name = '" . $_SESSION['user_name'] . "' && status = '0'");
            $stmt->execute();
            $row = $stmt->fetch();
            if ($row['numrows'] < 1) {
                echo '<li>No Pending Guide Available</li>';
            } else {
                $inc = 0;
                $stmt = $pdo->prepare("SELECT * FROM guide WHERE user_name = '" . $_SESSION['user_name'] . "' && status = '0'");
                $stmt->execute();

                foreach ($stmt as $row) {
                    $image = (!empty($row['image'])) ? 'images/guide_images/'.$row['image'] : 'images/noimage.jpg';
                    $inc = ($inc == 3) ? 1 : $inc + 1;
                    if($inc == 1) echo "<ul>";
                    echo "
                        <div class='guide-container'>
                            <h2>".$row['title']."</h2>
                            <li><a href='guide_delete.php?id=" . $row['id'] . "'>Delete</a></li>
                            <img src='".$image."' data-cycle-title='".$row['title']."'/>
                        </div>
                    ";

                    if($inc == 3) echo "</ul>";
                }

                if($inc % 3 != 0) {
                    echo "<li class='guide-item empty'></li>";
                }
            }
        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
        ?>
    </aside>

    <aside>
        <h1>Your Approved Guide List</h1>
        <?php
        try {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS numrows FROM guide WHERE user_name = '" . $_SESSION['user_name'] . "' && status = '1'");
            $stmt->execute();
            $row = $stmt->fetch();
            if ($row['numrows'] < 1) {
                echo '<li>No Approved Guide Available</li>';
            } else {
                $inc = 0;
                $stmt = $pdo->prepare("SELECT * FROM guide WHERE user_name = '" . $_SESSION['user_name'] . "' && status = '1'");
                $stmt->execute();

                foreach ($stmt as $row) {
                    $image = (!empty($row['image'])) ? 'images/guide_images/'.$row['image'] : 'images/noimage.jpg';
                    $inc = ($inc == 3) ? 1 : $inc + 1;
                    if($inc == 1) echo "<ul>";
                    echo "
                        <div class='guide-container'>
                            <h2>".$row['title']."</h2>
                            <li><a href='guide_delete.php?id=" . $row['id'] . "'>Delete</a></li>
                            <img src='".$image."' data-cycle-title='".$row['title']."'/>
                        </div>
                    ";

                    if($inc == 3) echo "</ul>";
                }

                if($inc % 3 != 0) {
                    echo "<li class='guide-item empty'></li>";
                }
            }
        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
        ?>
    </aside>

    <aside>
        <h1>Your Rejected Guide List</h1>
        <?php
        try {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS numrows FROM guide WHERE user_name = '" . $_SESSION['user_name'] . "' && status = '2'");
            $stmt->execute();
            $row = $stmt->fetch();
            if ($row['numrows'] < 1) {
                echo '<li>No Rejected Guide Available</li>';
            } else {
                $inc = 0;
                $stmt = $pdo->prepare("SELECT * FROM guide WHERE user_name = '" . $_SESSION['user_name'] . "' && status = '2'");
                $stmt->execute();

                foreach ($stmt as $row) {
                    $image = (!empty($row['image'])) ? 'images/guide_images/'.$row['image'] : 'images/noimage.jpg';
                    $inc = ($inc == 3) ? 1 : $inc + 1;
                    if($inc == 1) echo "<ul>";
                    echo "
                        <div class='guide-container'>
                            <h2>".$row['title']."</h2>
                            <li><a href='guide_delete.php?id=" . $row['id'] . "'>Delete</a></li>
                            <img src='".$image."' data-cycle-title='".$row['title']."'/>
                        </div>
                    ";

                    if($inc == 3) echo "</ul>";
                }

                if($inc % 3 != 0) {
                    echo "<li class='guide-item empty'></li>";
                }
            }
        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
        ?>
    </aside>

    <?php include 'includes/footer.php'; ?>

    <script>
        $('.guide-container img').each(function () {
            $(this).cycle({
                slides: 'li',
                timeout: 0,
                log: false,
                prev: $(this).parent().find('.prev'),
                next: $(this).parent().find('.next')
            });
        });
    </script>
</body>

</html>
