<?php
include'config.php';
$pid=$_GET['id'];
$cat_id=$_GET['cid'];
$sql="SELECT * FROM post WHERE post_id='$pid'";
$run1=mysqli_query($con,$sql) or die("select query failed");
$get=mysqli_fetch_assoc($run1);
unlink("upload/".$get['post_img']);


$query="DELETE FROM post WHERE post_id='$pid';";
$query.="UPDATE category SET post=post-1 WHERE category_id='$cat_id'";

$run=mysqli_multi_query($con,$query);
if($run){
	header('location:post.php');
}
?>