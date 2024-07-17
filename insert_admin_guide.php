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
    <link rel="stylesheet" href="css/signup.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>


<body>
<?php include 'includes/navbar.php'; ?>

<main style="margin-top: 120px; margin-bottom: 120px;">
    <div class="signup-box">
      <h2>Add a Guide</h2>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <form action="admin_guide_add.php" method="POST" enctype="multipart/form-data">
      <div class="form-control">
          <label2 for="title">Title:</label>
          <input type="text" id="title" name="title" required>
        </div>
        <div class="form-control">
          <label2 for="file">Select Image:</label>
          <input type="file" id="file" name="file" required>
        </div>
        <div class="form-control">
          <label2 for="coordinates">Coordinates:</label>
          <input type="text" id="coordinates" name="coordinates" required>
        </div>
        <div class="form-control">
          <label2 for="detail">Detail (1000 Characters):</label><br>
          <textarea id="detail" name="details" rows="5" cols="53" required></textarea>
        </div>
        <button type="submit" name="submit">Add Guide</button>
      </form>
    </div>
  </main>

  <?php include 'includes/footer.php'; ?>
  </body>
</html>