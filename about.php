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
    <title>About Us</title>
    <link rel="stylesheet" href="css/about.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
<?php include 'includes/navbar.php'; ?>

    <main style="margin-top: 120px;">
        <section class="about-section">
            <div class="about-content">
                <h2>About Us</h2>
                <p>Welcome to our world of endless exploration and unforgettable experiences! We firmly believe that travel is more than just a destination; it's a transformative journey that opens your eyes to new possibilities. Our mission is to empower you, the intrepid traveler, to embark on meaningful adventures and make the most of your travel experiences.</p>
                <p>With hundreds of passionate local guides, you can effortlessly navigate through the intricacies of different languages, customs, and traditions that often make traveling to a foreign place overwhelming. We understand that the best way to truly immerse yourself in a destination is through the guidance of a knowledgeable local, and that's exactly what we provide.</p>
                <p>We invite you to join the family of explorer, where every journey becomes a story worth sharing. Let us be your trusted companions as you venture into the unknown, encounter the extraordinary, and create memories that will last a lifetime.</p>
            </div>
            <div class="statistics">
                <div class="statistics-item">
                </div>
                </div>
              </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>
