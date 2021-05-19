<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
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
                        $query="SELECT * FROM category ORDER BY category_id DESC LIMIT $offset,$limit";
                        $run=mysqli_query($con,$query) or die("query failed");
                     if(mysqli_num_rows($run)>0){
                      $serial=$offset+1;
                              while($print=mysqli_fetch_assoc($run)){
                         ?>

                       
                        <tr>
                            <td class='id'><?php echo $serial ?></td>
                            <td><?php echo $print['category_name'] ?></td>
                            <td><?php echo $print['post'] ?></td>
                            <td class='edit'><a href='update-category.php?catid=<?php echo $print['category_id'] ?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?catid=<?php echo $print['category_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php
                        $serial++;
                      }
                                 }


                         ?>
                        
                    </tbody>
                </table>
                <?php
                  $query1="SELECT * FROM category";
                  $run1=mysqli_query($con,$query1) or die("query failed");
                  $total_records=mysqli_num_rows($run1);
                  $limit=3;
                  $paginate=ceil($total_records/$limit);
                  echo "<ul class='pagination admin-pagination'>";
                  if($page>1){
                     echo "<li><a href='category.php?page=".($page-1)."'>prev</a></li>";
                  }
                  for($i=1; $i<=$paginate; $i++){
                        echo "<li><a href='category.php?page=$i'>".$i."</a></li>";
                  }
                  if($page<$paginate){
                      echo "<li><a href='category.php?page=".($page+1)."'>next</a></li>";
                  }
                  echo "</ul>";

                ?>

                
                    <!-- <li class="active"><a>1</a></li> -->
                    
                    
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
