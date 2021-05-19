<?php include "header.php"; 

if($_SESSION['role']==0){
  header('location:post.php');
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method ="POST">
                    <?php
                    include'config.php';
                    $catid=$_GET['catid'];
                    $query="SELECT * FROM category WHERE category_id='$catid'";
                    $run=mysqli_query($con,$query) or die("query failed");
                    $print=mysqli_fetch_assoc($run);
                      ?>
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $print['category_id'] ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $print['category_name'] ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Update" required />
                       <?php
                       ?>
                  </form>

                </div>
              </div>
            </div>
          </div>
            <?php
                  include'config.php';
                      if(isset($_POST['save'])){
                        $newid=mysqli_real_escape_string($con,$_POST['cat_id']);
                        $newname=mysqli_real_escape_string($con,$_POST['cat_name']);
                        $query1="UPDATE category SET category_name='$newname' WHERE category_id='$newid'";
                        $run1=mysqli_query($con,$query1);
                        if($run1){
                          header('location:category.php');
                        }else{
                          echo "error";
                        }
                      }
                      ?>
<?php include "footer.php"; ?>
