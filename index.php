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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/contact.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <?php include 'includes/navbar.php'; ?>

    <?php
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) AS numrows FROM guide WHERE status='1'");
        $stmt->execute();
        $row = $stmt->fetch();
        if ($row['numrows'] < 1) {
            echo '<li>No Guide Available</li>';
        } else {
            $inc = 0;
            $stmt = $pdo->prepare("SELECT * FROM guide WHERE status='1' ORDER BY id DESC LIMIT 3");
            $stmt->execute();

            // echo "<div class='slideshow'>";
            ?>

            
        

                <div id="slideshow" data-cycle-timeout="3000" data-cycle-slides="> div">

                <?php

foreach ($stmt as $row) {
    $image = (!empty($row['image'])) ? 'images/guide_images/' . $row['image'] : 'images/noimage.jpg';
    $inc++;
?>
      <div>
        <div class="slide-text"></div>
        <img class="slides" src="<?php echo $image ?>" data-cycle-title="<?php echo $row['title'] ?>" />
      </div>
   
    <?php
            }

            ?>

</div>
    <div class="cycle-slideshow second-slideshow" 
      data-cycle-fx="simpleFade" 
      data-cycle-timeout="3000"
      data-cycle-slides=".second-slideshow-slide"
    >

    <?php
  $stmt = $pdo->prepare("SELECT * FROM guide WHERE status='1' ORDER BY id DESC LIMIT 3");
  $stmt->execute();
foreach ($stmt as $row) {
    // $image = (!empty($row['image'])) ? 'images/guide_images/' . $row['image'] : 'images/noimage.jpg';
    // $inc++;
?>
      <div class="second-slideshow-slide" style="background:#fff">
        <div class="text-box">
          <h2 class="title1"><?php echo $row['title'] ?></h2>
          <p><?php echo $row['details'] ?></p>
          <p><a href="guide.php?guide=<?php echo $row['slug'] ?>">Guide to <?php echo $row['title'] ?></a></p>
          <p class='guide-coordinates' onclick='openGoogleMaps("<?php echo $row['coordinates'] ?>")'>Coordinates: <?php echo $row['coordinates'] ?></p>
        </div>
      </div>
    <!-- </div> -->
<?php
            }

            ?>    
            </div>

            <?php
            // echo "</div>";

            if ($inc % 3 != 0) {
                echo "<li class='guide-item empty'></li>";
            }
        }
    } catch (PDOException $e) {
        echo "There is some problem in connection: " . $e->getMessage();
    }
    ?>

<?php include 'includes/footer.php'; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.js"></script>
    <script>
        $(document).ready(function () {
            $("#slideshow").cycle({
                fx: "scrollHorz",
            });
        });

        function openGoogleMaps(coordinates) {
            var url = "https://www.google.com/maps/search/?api=1&query=" + coordinates;
            window.open(url);
        }
    </script>
</body>

</html>