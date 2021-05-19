<?php
session_start();
include'config.php';
if(isset($_POST['submit'])){
	$title=mysqli_real_escape_string($con,$_POST['post_title']);
    $disc=mysqli_real_escape_string($con,$_POST['postdesc']);
    $category=mysqli_real_escape_string($con,$_POST['category']);
    $image=$_FILES['upload']['name'];
    $tmp_image=$_FIlES['upload']['tmp_name'];
    move_uploaded_file($tmp_image,"upload/$image");
    $date=date("d M, Y");
    $author=$_SESSION['user_id'];
    $query="INSERT INTO post(title,description,category,post_date,author,post_img) VALUES ('$title','$disc','$category','$date','$author','$image');";
    $query.="UPDATE category SET post=post+1 WHERE category_id='$category'";
    $run=mysqli_multi_query($con,$query);
    if($run){
    	header('location:post.php');
    }else{
    	echo "oops";
    }


}


?>