<?php
session_start();
if($_SESSION['role']==0){
  header('location:post.php');
}
$uid=$_GET['id'];
include'config.php';
$query="DELETE FROM user WHERE user_id='$uid'";
$run=mysqli_query($con,$query);
if($run){
	header('location:users.php');
}

?>