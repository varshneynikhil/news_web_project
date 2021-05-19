<?php
include'config.php';
$pagename= basename($_SERVER['PHP_SELF']);
switch($pagename){
    case 'category.php';
         if(isset($_GET['cid'])){
           $catid=$_GET['cid'];
           $query="SELECT * FROM  category WHERE category_id='$catid'";
           $run=mysqli_query($con,$query);
           $print=mysqli_fetch_assoc($run);
           $title=$print['category_name']." News";
         }else{
            $title="no result found";
         }
         break;
    case 'author.php';
         
         if(isset($_GET['aid'])){
           $aid=$_GET['aid'];
           $query="SELECT * FROM  user WHERE user_id='$aid'";
           $run=mysqli_query($con,$query);
           $print=mysqli_fetch_assoc($run);
           $title=$print['first_name']." ".$print['last_name']." News";
         }else{
            $title="no result found";
         }
         break;
    case 'single.php';
         if(isset($_GET['pid'])){
           $pid=$_GET['pid'];
           $query="SELECT * FROM  post WHERE post_id='$pid'";
           $run=mysqli_query($con,$query);
           $print=mysqli_fetch_assoc($run);
           $title=$print['title'];
         }else{
            $title="no result found";
         }
         break;
    case 'search.php';
          if(isset($_GET['search'])){
           $title=$_GET['search'];
           
           
         }else{
            $title="no result found";
         }
         
         break;
         default:$title= "News-site";  
         break;       
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/news.jpg"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    include'config.php';
                    if(isset($_GET['cid'])){
                      $catid=$_GET['cid'];
                    }
                    
                    $active="";
                    $query="SELECT * FROM category WHERE post > 0";
                    $run=mysqli_query($con,$query) or die("query failed");
                    echo "<ul class='menu'>";
                    ?>
                    <li><a href="index.php">Home</a></li>
                    <?php
                   
                    while($print=mysqli_fetch_assoc($run)){
                        if(isset($_GET['cid'])){
                              if($print['category_id']==$catid){
                                   $active="active";
                              }else{
                                    $active="";
                        }
                        }
                        
                        echo " <li ><a class='".$active."' href='category.php?cid=$print[category_id]'>".$print['category_name']."</a></li>";
                    }
                    echo "</ul>";
                    ?>               
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
