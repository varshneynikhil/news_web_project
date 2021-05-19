<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                     $authid=$_GET['aid'];
                    $sql="SELECT * FROM post
                     left join category ON post.category=category.category_id
                     left join user ON post.author=user.user_id WHERE author='$authid'
                            ";
                      $run1=mysqli_query($con,$sql) or die("query 1 failed");
                      $get=mysqli_fetch_assoc($run1);  
                      echo "<h2 class='page-heading'>".$get['first_name']." ".$get['last_name']."</h2>";    
                    ?>
                  
                    <?php
                    $authid=$_GET['aid'];
                     $query="SELECT * FROM post
                     left join category ON post.category=category.category_id
                     left join user ON post.author=user.user_id WHERE author='$authid'
                            ";
                    $run=mysqli_query($con,$query) or die("query 0 failed");
                    while($print=mysqli_fetch_assoc($run)){

                        ?>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?pid=<?php echo $print['post_id'] ?>"><img src="admin/upload/<?php echo $print['post_img']?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?pid=<?php echo $print['post_id'] ?>'><?php echo $print['title']?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $print['category_id'] ?>'><?php echo $print['category_name']?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?aid=<?php echo $print['author'] ?>'><?php echo $print['username']?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                           <?php echo $print['post_date']?>
                                        </span>
                                    </div>
                                    <p class="description">
                                        <?php echo substr($print['description'],0,100)?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?pid=<?php echo $print['post_id'] ?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <!-- <ul class='pagination'>
                        <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                    </ul> -->
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
