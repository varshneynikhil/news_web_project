<?php
include'config.php';
if(isset($_POST['submit'])){
	$post_id=mysqli_real_escape_string($con,$_POST['post_id']);
	$title=mysqli_real_escape_string($con,$_POST['post_title']);
	$desc=mysqli_real_escape_string($con,$_POST['postdesc']);
	$category=mysqli_real_escape_string($con,$_POST['category']);
    $old_category=mysqli_real_escape_string($con,$_POST['old_category']);
	$img=$_FILES['new-image']['name'];
	$tmpimg=$_FILES['new-image']['tmp_img'];
    move_uploaded_file($tmpimg,"upload/$img");

    $query="UPDATE post SET title='$title', description='$desc', category='$category', post_img='$img' WHERE post_id='$post_id';";
    if($old_category!=$category){
        $query.="UPDATE category SET post=post-1  WHERE category_id='$old_category';";
        $query.="UPDATE category SET post=post+1 WHERE category_id='$category'";
    }
    $run=mysqli_multi_query($con,$query);
    if($run){
    	header('location:post.php');
    }else{
    	echo "error";
    }


}
?>