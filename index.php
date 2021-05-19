<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">
                        <?php
                            include'config.php';
                            
                            if(isset($_GET['id'])){
                                $page=$_GET['id'];
                            }else{
                                $page=1;
                            }
                            $limit=3;
                            $offset=($page-1)*$limit;
                            $query="SELECT * FROM post
                              left join category ON post.category=category.category_id
                              left join user ON post.author=user.user_id 
                              ORDER BY post.post_id DESC LIMIT $offset,$limit
                            ";
                            $run=mysqli_query($con,$query) or die("query failed");
                                 while($print=mysqli_fetch_assoc($run)){

                                    ?>
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?pid=<?php echo $print['post_id'] ?>"><img src="admin/upload/<?php echo $print['post_img'] ?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?pid=<?php echo $print['post_id'] ?>'><?php echo $print['title'] ?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?cid=<?php echo $print['category_id']?>&pid=<?php echo $print['post_id'] ?>'><?php echo $print['category_name'] ?></a>
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
                                        <p class="description">
                                            <?php echo substr($print['description'],0,100)."..." ?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?pid=<?php echo $print['post_id'] ?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }

                        $sql="SELECT * FROM post";
                        $run1=mysqli_query($con,$sql) or die("query failed");
                        $total_records=mysqli_num_rows($run1);
                        $limit=3;
                        $pagination=ceil($total_records/$limit);
                        echo "<ul class='pagination'>";
                        if($page>1){
                            echo "<li><a href='index.php?id=".($page-1)."'>Prev</a></li>";
                        }
                        for($i=1; $i<=$pagination; $i++){
                            if($i==$page){
                                $active="active";
                            }else{
                                $active="";
                            }
                            echo "<li class=".$active."><a href='index.php?id=$i'>".$i."</a></li>";
                        }
                        if($page<$pagination){
                            echo "<li><a href='index.php?id=".($page+1)."'>Next</a></li>";
                        }
                        echo "</ul>";
                        ?>
                        
                        
                            <!-- <li class="active"><a href="">1</a></li> -->
                            
                        
                    </div><!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
