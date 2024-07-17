<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

@include 'config.php';
session_start();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.js"></script>
    <style type="text/css">
      h1{
        margin-top: 9.5rem;
        margin-bottom: 0.5rem;
      }
      h2{
        margin-top: 1.5rem;
        margin-bottom: 0.5rem;
      }
    </style>
</head>


<body>
<?php include 'includes/navbar.php'; ?>

<aside>  
    <h2>Approved Guides List</h2>
    <ul>
        <?php
        $q = "SELECT * FROM guide WHERE status = '1'";
        $rs = $conn->query($q);
        if ($rs) {
            while ($r = $rs->fetch_assoc()) {
                echo '
                <div>
                    <h2>'.$r['title'].'</h2>
                    <li><a href="#">Approved</a></li>
                    <img src="images/guide_images/'.$r['image'].'" data-cycle-title='.$r['title'].' width=380px/>
                </div>';
            }
        } else {
            echo "Error executing the query: ".$conn->error;
        }
        ?>
    </ul>
</aside>


</div>

    <footer>
      <p>&copy; </p>
    </footer>
    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
  </body>
</html>