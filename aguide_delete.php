<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


	@include 'config.php';

	session_start();

	if(!isset($_SESSION['admin_name'])){
	   header('location:admin_guide.php');
	}

	
	$q= "DELETE FROM guide WHERE id='" . $_GET["id"] . "'";

	if(mysqli_query($conn, $q)){
		echo "Data deleted";?>
		<script type="text/javascript">
			alert("Data deleted");
			window.location.href= "admin_guide.php";
		</script>
		<?php
	}else{
		echo "Failed to delete data";
		echo $con->error();

	}

?>