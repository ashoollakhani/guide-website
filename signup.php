<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

@include 'config.php';

if(isset($_POST['submit'])){

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = md5($_POST['password']);
  $repassword = md5($_POST['repassword']);
  $user_type = "user";

  $select = " SELECT * FROM user WHERE email = '$email' ";

  $result = mysqli_query($conn, $select);

  if(mysqli_num_rows($result) > 0){

     $error[] = 'user already exist!';

  }else{

     if($password != $repassword){
        $error[] = 'password not matched!';
     }else{
        $insert = "INSERT INTO user(name, email, password, user_type) VALUES('$name','$email','$password','$user_type')";
        mysqli_query($conn, $insert);
        header('location:login.php');
     }
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
      <h2>Create an account</h2>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <form action="" method="POST">
        <div class="form-control">
          <label2 for="name">Name:</label>
          <input type="text" id="name" name="name" required>
        </div>
        <div class="form-control">
          <label2 for="email">Email:</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="form-control">
          <label2 for="password">Password:</label>
          <input type="password" id="password" name="password" required>
        </div>
        <div class="form-control">
          <label2 for="password">Confirm Password:</label>
          <input type="password" id="password" name="repassword" required>
        </div>
        <button type="submit" name="submit">Sign Up</button>
      </form>
      <div class="additional-info">
      <p>I already have an <a href="login.php">Account</a>.</p>
        <p>By signing up, you agree to our <a href="#">Terms of Use</a>.</p>
      </div>
    </div>
  </main>

  <?php include 'includes/footer.php'; ?>
</body>
</html>
