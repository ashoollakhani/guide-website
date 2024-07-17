<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


	@include 'config.php';

	session_start();

	if(!isset($_SESSION['admin_name'])){
	   header('location:aguide_list.php');
	}

	
	$q= "UPDATE guide SET status='1' WHERE id='$_GET[app]'";

	if(mysqli_query($conn, $q)){
		echo "Data deleted";?>
		<script type="text/javascript">
			alert("Guide Approved");
			window.location.href= "aguide_list.php";
		</script>
		<?php
	}else{
		echo "Failed to delete data";
		echo $con->error();

	}

?>