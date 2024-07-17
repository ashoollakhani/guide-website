<?php
include 'includes/slugify.php';

// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "guide2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
if (!isset($_SESSION['user_name'])) {
    header('Location: insert_guide.php');
    exit; // Add exit to stop executing further code
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $details = $_POST['details'];
    $coordinates = $_POST['coordinates'];
    $status = 0;
    $like_count = 0;
    $dislike_count = 0;
    $slug = slugify($title);
    $fname = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];
    $fsize = $_FILES['file']['size'];
    $extension = pathinfo($fname, PATHINFO_EXTENSION);
    $fnew = uniqid().'.'.$extension;

    $store = "images/guide_images/".basename($fnew);
    if (!is_dir("images/guide_images/")) {
        // Directory does not exist
        echo "The directory images/guide_images/ does not exist.";
        exit; // Stop executing further code
    } elseif (!is_writable("images/guide_images/")) {
        // Directory is not writable
        echo "The directory images/guide_images/ is not writable.";
        exit; // Stop executing further code
    } elseif (in_array($extension, ['jpg', 'png', 'jpeg', 'gif'])) { // Use in_array to check extension
        if ($fsize >= 10000000) { // 10MB limit
            $error = '
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Max Image Size is 10MB!</strong> Try a different image.
                </div>';
            echo $error;
            exit; // Stop executing further code
        } else {
            $q = "SELECT * FROM user WHERE name = ?";
            $stmt = $conn->prepare($q);
            $stmt->bind_param("s", $_SESSION['user_name']);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $stmt = $conn->prepare("INSERT INTO guide (user_name, title, details, image, status, like_count, dislike_count, slug, coordinates) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssiiiss", $_SESSION['user_name'], $title, $details, $fnew, $status, $like_count, $dislike_count, $slug, $coordinates);

                if ($stmt->execute()) {
                    move_uploaded_file($temp, __DIR__ . '/' . $store);
                    echo "Data Inserted";
                    ?>
                    <script type="text/javascript">
                        alert("Your guide has been added");
                        window.location.href = "insert_guide.php";
                    </script>
                    <?php
                    exit; // Add exit to stop executing further code
                } else {
                    echo "Data not inserted: ".$stmt->error;
                }

                $stmt->close();
            } else {
                echo "User not found.";
            }
        }
    } else {
        $error = '
            <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Invalid extension!</strong> Only PNG, JPG, JPEG, and GIF images are accepted.
        </div>';
        echo $error;
        ?>
        <script type="text/javascript">
            alert("Only PNG, JPG, JPEG, and GIF images are accepted.");
            window.location.href = "insert_guide.php";
        </script>
        <?php
        exit; // Stop executing further code
    }
} else {
    echo "Data not inserted.";
}

$conn->close(); // Move this line outside the if-else block
?>
