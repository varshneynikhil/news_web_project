<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="print" autocomplete="off">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php
        include'config.php';
        $limit=3;
        $query="SELECT * FROM post
                left join category ON post.category=category.category_id
               ORDER BY post.post_id DESC LIMIT $limit;
        ";
        $run=mysqli_query($con,$query) or die("query failed");
        while($print=mysqli_fetch_assoc($run)){
       ?>
        <div class="recent-post">
            <a class="post-img" href="single.php?pid=<?php echo $print['post_id'] ?>">
                <img src="admin/upload/<?php echo $print['post_img'] ?>" alt=""/>
            </a>
            <div class="post-content">
                <h5><a href="single.php?pid=<?php echo $print['post_id'] ?>"><?php echo $print['title'] ?></a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?cid=<?php echo $print['category_id'] ?>'><?php echo $print['category_name'] ?></a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php echo $print['post_date'] ?>
                </span>
                <a class="read-more" href="single.php?pid=<?php echo $print['post_id'] ?>">read more</a>
            </div>
        </div>
        <?php

        }
        ?>
    </div>
    <!-- /recent posts box -->
</div>
