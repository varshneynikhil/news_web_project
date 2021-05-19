<?php
include'config.php';
$catid=$_GET['catid'];
$query="DELETE FROM category WHERE category_id='$catid' ";
$run=mysqli_query($con,$query);
if($run){
	header('location:category.php');
}
?>