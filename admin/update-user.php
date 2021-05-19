<?php include "header.php"; 

if($_SESSION['role']==0){
  header('location:post.php');
}
if(isset($_POST['submit'])){
  include 'config.php';
  $uid=$_GET['id'];
  $fname=mysqli_real_escape_string($con,$_POST['f_name']);
  $lname=mysqli_real_escape_string($con,$_POST['l_name']);
  $user=mysqli_real_escape_string($con,$_POST['username']);
  $password=mysqli_real_escape_string($con,md5($_POST['password']));
  $role=mysqli_real_escape_string($con,$_POST['role']);

  $updatequery="UPDATE user SET first_name='$fname',last_name='$lname',username='$user',role='$role' WHERE user_id='$uid'";
  $edit=mysqli_query($con,$updatequery);
  if($edit){
    header('location:users.php');
  }

}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF'] ?>" method ="POST">
                    <?php 
                    $uid=$_GET['id'];
                    include'config.php';
                    $readquery="SELECT * FROM user WHERE user_id=$uid";
                    $run=mysqli_query($con,$readquery) or die("query failed");
                    $print=mysqli_fetch_assoc($run);

                    ?>
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="1" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $print['first_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $print['last_name']?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php  echo $print['username']?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $print['role']; ?>">
                            <?php
                            if($print['role']==1){
                              echo "  <option value='0'>normal User</option>
                              <option value='1' selected>Admin</option>";
                            }else{
                              echo "  <option value='0' selected>normal User</option>
                              <option value='1'>Admin</option>";
                            }
                            ?>
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
