<?php
$con=mysqli_connect('localhost','root','','guide');
$type=$_POST['type'];
$id=$_POST['id'];
if($type=='like'){
	$sql="update guide set like_count=like_count+1 where id=$id";
}else{
	$sql="update guide set dislike_count=dislike_count+1 where id=$id";
}
$res=mysqli_query($con,$sql);
?>