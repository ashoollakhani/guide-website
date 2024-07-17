<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


	@include 'config.php';

	session_start();

	if(!isset($_SESSION['user_name'])){
	   header('location:guide_list.php');
	}

	
	$q= "DELETE FROM guide WHERE id='" . $_GET["id"] . "'";

	if(mysqli_query($conn, $q)){
		echo "Data deleted";?>
		<script type="text/javascript">
			alert("Data deleted");
			window.location.href= "guide_list.php";
		</script>
		<?php
	}else{
		echo "Failed to delete data";
		echo $con->error();

	}

?>