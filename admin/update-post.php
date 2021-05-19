<?php include "header.php";?>
<?php
include'config.php';
if($_SESSION['role']==0){
    $pid=$_GET['id'];
    $query0="SELECT * FROM post WHERE post_id='$pid'";
    $run0=mysqli_query($con,$query0);
    $print0=mysqli_fetch_assoc($run0);
    if($print0['author']!=$_SESSION['user_id']){
        header('location:post.php');
    }
}
?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <?php
include'config.php';
//ye sahi hai
$pid=$_GET['id'];
$query="SELECT * FROM post WHERE post_id='$pid'";
$run=mysqli_query($con,$query) or die("query failed");
if(mysqli_num_rows($run)>0){
    while($print=mysqli_fetch_assoc($run)){
        ?>
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $pid ?>" placeholder="">
            </div>
            <div class="form-group">
                <input type="hidden" name="old_category"  class="form-control" value="<?php echo $print['category'] ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $print['title'] ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                    <?php echo $print['description'] ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                    <?php
                      $query1="SELECT * FROM category";
                      $run1=mysqli_query($con,$query1) or die("query1 failed");
                      while($get=mysqli_fetch_assoc($run1)){
                        if($print['category']==$get['category_id']){
                            $selected="selected";
                        }else{
                            $selected="";
                        }
                        echo "<option ".$selected." value='".$get['category_id']."'>".$get['category_name']."</option>";
                                           
                      }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                
                <img  src="upload/<?php echo $print['post_img'] ?>" height="150px">

            </div>
            <?php
            }
}

?>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
