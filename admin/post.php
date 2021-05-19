<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php
                        include'config.php';
                        if(isset($_GET['page'])){
                        $page=$_GET['page'];
                      }else{
                        $page=1;
                      }
                        $limit=3;
                        $offset=($page-1)*$limit;
                        if($_SESSION['role']==1){
                        
                        $query="SELECT * FROM post
                                left join category ON post.category=category.category_id
                                left join user ON post.author=user.user_id ORDER BY post.post_id DESC LIMIT $offset,$limit

                        ";
                      }elseif ($_SESSION['role']==0) {
                        $query="SELECT * FROM post
                                left join category ON post.category=category.category_id
                                left join user ON post.author=user.user_id WHERE post.author=".$_SESSION['user_id']." LIMIT $offset,$limit

                        ";
                      }
                        $run=mysqli_query($con,$query) or die("query failed1");
                        if(mysqli_num_rows($run)>0){
                          $sn=$offset+1;
                          while($print=mysqli_fetch_assoc($run)){
                            
                       ?>
                             
                          <tr>
                              <td class='id'><?php echo $sn ?></td>
                              <td><?php echo $print['title'] ?></td>
                              <td><?php echo $print['category_name'] ?></td>
                              <td><?php echo $print['post_date'] ?></td>
                              <td><?php echo $print['username'] ?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $print['post_id'] ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $print['post_id']?>&cid=<?php echo $print['category'] ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php
                          $sn++;
                        }
                          }
                        ?>
                      </tbody>
                  </table>
                  <?php
                    $sql="SELECT * FROM post";
                    $run1=mysqli_query($con,$sql) or die("query failed");
                    $total_result=mysqli_num_rows($run1);
                    $limit=3;
                    $paginate=ceil($total_result/$limit);
                    echo "<ul class='pagination admin-pagination'>";
                    if($page>1){
                      echo "<li><a href='post.php?page=".($page-1)."'>prev</a></li>";
                    }

                      for($i=1; $i<=$paginate; $i++){
                        if($page==$i){
                      $active="active";
                    }else{
                      $active="";
                    }
                        echo "<li class=".$active."><a href='post.php?page=$i'>".$i."</a></li>";
                      }
                      if($page<$paginate){
                        echo "<li><a href='post.php?page=".($page+1)."'>next</a></li>";
                      }
                    echo "</ul>";
                  ?>

                      <!-- <li class="active"><a>1</a></li> -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
