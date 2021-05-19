<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                        <?php 
                        $post_id=$_GET['pid'];
                        include'config.php';
                         $query="SELECT * FROM post
                                left join category ON post.category=category.category_id
                                left join user ON post.author=user.user_id WHERE post_id='$post_id'

                        ";
                        $run=mysqli_query($con,$query) or die("query failed");
                        $print=mysqli_fetch_assoc($run);
                        ?>
                        <div class="post-content single-post">
                            <h3><?php echo $print['title'] ?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href="category.php?cid=<?php echo $print['category_id'] ?>"><?php echo $print['category_name'] ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?aid=<?php echo $print['author'] ?>'><?php echo $print['username'] ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $print['post_date'] ?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?php echo $print['post_img']?>" alt=""/>
                            <p class="description">
                                <?php echo $print['description'] ?>
                            </p>
                        </div>
                        <?php
                         ?>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
