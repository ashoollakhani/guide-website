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
    <link rel="stylesheet" href="css/contact.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body>
<?php include 'includes/navbar.php'; ?>

  <main style="margin-top: 75px;">
    <div class="contact-box">
      <h2>Contact Us</h2>
      <form>
        <div class="form-control">
          <label2 for="name">Name:</label>
          <input type="text" id="name" name="name" required>
        </div>
        <div class="form-control">
          <label2 for="email">Email:</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="form-control">
          <label2 for="message">Message:</label><br>
          <textarea id="message" name="message" required></textarea>
        </div>
        <button type="submit">Send Message</button>
      </form>
      <div class="additional-info">
        <p>For any inquiries or feedback, please fill out the form and we'll get back to you as soon as possible.</p>
      </div>
    </div>
  </main>

  <?php include 'includes/footer.php'; ?>

</body>
</html>
