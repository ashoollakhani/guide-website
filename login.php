<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = md5($_POST['password']);
   $repassword = md5($_POST['repassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user WHERE email = '$email' && password = '$password' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:index.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:index.php');

      }

   }else{
      $error[] = 'incorrect email or password!';
   }

};
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

  <main style="margin-top: 120px;">
    <div class="signup-box">
      <h2>Login</h2>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <form action="" method="POST">
        <div class="form-control">
          <label2 for="email">Email:</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="form-control">
          <label2 for="password">Password:</label>
          <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" name="submit">Login</button>
      </form>
      <div class="additional-info">
        <p>Don't have an account <a href="signup.php">Sign Up</a></p>
      </div>
    </div>
  </main>

  <?php include 'includes/footer.php'; ?>

</body>
</html>
