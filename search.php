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
$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guides</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/guides.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.js"></script>
    <script>
      $("document").ready(function ($) {
        $("#slideshow").cycle({
          fx: "scrollHorz",
        });
      });
    </script>
    <style type="text/css">
        .guide-container img {
            width: 100%;
            height:250px;
        }
    </style>
</head>


<body>
<?php include 'includes/navbar.php'; ?>

    <aside> 
        <?php
        if (isset($_POST['keyword'])) {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS numrows FROM guide WHERE title LIKE :keyword && status='1'");
            $stmt->execute(['keyword' => '%'.$_POST['keyword'].'%']);
            $row = $stmt->fetch();
            if($row['numrows'] < 1) {
                echo '<h1>No results found for <i>'.$_POST['keyword'].'</i></h1>';
            } else {
                echo '<h1>Search results for <i>'.$_POST['keyword'].'</i></h1>';
                try {
                    $inc = 3;   
                    $stmt = $pdo->prepare("SELECT * FROM guide WHERE title LIKE :keyword && status='1'");
                    $stmt->execute(['keyword' => '%'.$_POST['keyword'].'%']);

                    foreach ($stmt as $row) {
                        $highlighted = preg_filter('/' . preg_quote($_POST['keyword'], '/') . '/i', '<b>$0</b>', $row['title']);
                        $image = (!empty($row['image'])) ? 'images/guide_images/'.$row['image'] : 'images/noimage.jpg';
                        $inc = ($inc == 3) ? 1 : $inc + 1;
                        if($inc == 1) echo "<ul>";
                        echo "
                            <div class='guide-container'>
                                <h2><a href='guide.php?guide=".$row['slug']."'>".$highlighted."</a></h2>
                                <img src='".$image."' data-cycle-title='".$highlighted."' width=380px/>
                            </div>
                        ";
                        if($inc == 3) echo "</ul>";
                    }
                    if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
                    if($inc == 2) echo "<div class='col-sm-4'></div></div>";
                } catch(PDOException $e) {
                    echo "There is some problem in connection: " . $e->getMessage();
                }
            }
        } else {
            echo "No keyword provided for search.";
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