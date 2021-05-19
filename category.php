<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                    
                    $category_id=$_GET['cid'];
                    $sql="SELECT * FROM category WHERE category_id='$category_id'";
                    $run1=mysqli_query($con,$sql) or die("sql failed");
                    $fetch=mysqli_fetch_assoc($run1);

                    ?>
                    <h2 class="page-heading"><?php echo $fetch['category_name']?></h2>
                    <?php
                    
                    $query="SELECT * FROM post
                              left join category ON post.category=category.category_id
                              left join user ON post.author=user.user_id 
                               WHERE post.category='$category_id'
                            ";
                    $run=mysqli_query($con,$query) or die("query failed2");
                    while($get=mysqli_fetch_assoc($run)){

                    ?>
                  
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?pid=<?php echo $get['post_id'] ?>"><img src="admin/upload/<?php echo $get['post_img']?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?pid=<?php echo $get['post_id'] ?>'><?php echo $get['title']?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $category_id?>'><?php echo $get['category_name']?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?aid=<?php echo $get['author'] ?>'><?php echo $get['username']?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $get['post_date']?>
                                        </span>
                                    </div>
                                    <p class="description">
                                        <?php echo substr($get['description'],0,130)?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?pid=<?php echo $get['post_id'] ?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }

                    // $query2="SELECT * FROM post WHERE"; //gadbad header file me query join laga ke likhni hai
                    // $run2=mysqli_query($con,$query2) or die("pagination query failed");
                    // $total_records=mysqli_num_rows($run2);
                    // $limit=2;
                    // $pagination=ceil($total_records/$limit);
                    // echo $pagination;
                    // echo "<ul class='pagination'>";
                   
                    // echo "</ul>";
                   ?>
                    
                        <!-- <li class="active"><a href="">1</a></li> -->
                        
                        <!-- <li><a href="">3</a></li> -->
                    
                    
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
