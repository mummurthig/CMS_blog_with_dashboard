<?php 
   require_once("Includes/DB.php");
   require_once("Includes/Functions.php");
   require_once("Includes/Sessions.php");
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <script src="https://kit.fontawesome.com/d4d3e9f492.js" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
      <link rel="stylesheet" href="Css/style.css">
      <title>CMS | All Posts</title>
      <style>
         .heading{
         font-family: Bitter, Georgia, 'Times New Roman', Times, serif;
         font-weight: bold;
         color: #005E90;
         }
         .heading:hover{
         color: #0090DB;
         }
      </style>
   </head>
   <body>
      <!--NAVBAR-->
      <div style="height: 10px; background: #27aae1;"></div>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
         <div class="container" >
            <a href="#" class="navbar-brand">CMS Blog</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS" >
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarcollapseCMS">
               <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                     <a href="index.php?page=1" class="nav-link">Home</a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">About Us</a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">Blog</a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">Contact Us</a>
                  </li>
                  <li class="nav-item">
                     <a href="login.php" target="_blank" class="nav-link">Admin Login</a>
                  </li>
               </ul>
               <ul class="navbar-nav ml-auto">
                  <form class="form-inline d-none d-sm-block" action="index.php">
                     <div class="form-group">
                        <input class="form-control mr-2" type="text" name="search" placeholder="Search here" value="">
                        <button  class="btn btn-primary" name="SearchButton" >Go</button>
                     </div>
                  </form>
               </ul>
            </div>
         </div>
      </nav>
      <div style="height: 10px; background: #27aae1;"></div>
      <!-- NAVBAR END -->
      <!-- HEADER -->
      <div class="container">
      <div class="row mt-4" >
      <!-- main area Start -->
      <div class="col-sm-8">
         <h1>The complete responsive CMS Blog</h1>
         <?php
            echo ErrorMessage();
            echo SuccessMessage();
            ?>
         <h1 class="lead">It is a long established fact that a reader </h1>
         <?php
            global $ConnectingDB;
            
            if(isset($_GET["SearchButton"])){
                $Search = $_GET["search"];
                $sql = "SELECT * FROM posts 
                WHERE datetime LIKE :search
                OR title LIKE :search
                OR category LIKE :search
                OR post LIKE :search";
                $stmt = $ConnectingDB->prepare($sql);
                $stmt->bindValue(':search', '%'.$Search.'%');
                $stmt->execute();
            
            }
            //Query When Pagination is Acvtive i.e index.php?page=1                    
            elseif(isset($_GET["page"])){
                $Page = $_GET["page"];
                if($Page == 0 || $Page<1){
                    $ShowPostFrom =0;
                }else{
                    $ShowPostFrom=($Page*5)-5; 
                }                            
                $sql = "SELECT * FROM posts ORDER BY id desc LIMIT $ShowPostFrom,5";                   
                $stmt = $ConnectingDB->query($sql);
            
            }
            elseif(isset($_GET["category"])){
                $Category =$_GET["category"];
                $sql = "SELECT * FROM posts WHERE category= '$Category' ORDER BY id desc";
                $stmt = $ConnectingDB->query($sql);
            
            }                    
            //The Default SQL query
            else{
                $sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,3 ";
                $stmt = $ConnectingDB->query($sql);
            }
            while($DataRows = $stmt->fetch()){
                $PostID          = $DataRows["id"];
                $DateTime        = $DataRows["datetime"];
                $PostTitle       = $DataRows["datetime"];
                $Category        = $DataRows["category"];
                $Admin           = $DataRows["author"];
                $Image           = $DataRows["image"];
                $PostDescription = $DataRows["post"];                   
            ?>
         <div class="card ">
            <img src="uploads/<?php echo htmlentities($Image); ?>" style="max-height:450px;" class="img-fluid card-img-top" alt="">
            <div class="card-body ">
               <h4 class="card-title "><?php echo htmlentities($PostTitle); ?></h4>
               <small class="text-muted">Category <span class="text-dark"> <a href="index.php?category=<?php echo htmlentities($Category); ?>"> <?php echo htmlentities($Category); ?></span> </a>  & Written by <span class="text-dark"> <a href="profile.php?username=<?php echo htmlentities($Admin); ?>"> <?php echo htmlentities($Admin);?></a> </span>  On <span class="text-dark"><?php echo htmlentities($DateTime); ?> </span> </small>
               <span style="float:right" class="badge badge-dark text-light">Comments 
               <?php echo ApproveCommentAccordingtoPost($PostID); ?></span>
               <hr>
               <p class="card-text">
                  <?php 
                     if(strlen($PostDescription)>150){$PostDescription = substr($PostDescription,0,150)."...";}       
                     echo nl2br($PostDescription);                                                   
                     ?>
               </p>
               <a href="FullPost.php?id=<?php echo $PostID; ?>" style="float:right;">
               <span class="btn btn-info">Read More >></span>
               </a>
            </div>
         </div>
         <br>
         <?php  } ?>
         <br>
         <a href="index.php?page=1" >
            <h6 class="lead"> Read More Posts</h6>
         </a>
         <!--Pagination-->
         <nav>
            <ul class="pagination pagination-lg">
               <!--Creating Backward Button-->
               <?php if(isset($Page)){
                  if($Page>1){?>
               <li class="page-item  ">
                  <a href="index.php?page= <?php echo $Page-1; ?> " class="page-link ">&laquo;</a>
               </li>
               <?php }
                  } ?>
               <?php 
                  $sql = "SELECT COUNT(*) FROM posts";
                  $stmt = $ConnectingDB->query($sql);
                  $RowPagination = $stmt->fetch();
                  $TotalPosts = array_shift($RowPagination);
                  //  echo $TotalPosts."<br>";
                  $PostPagination = $TotalPosts/5;
                  $PostPagination = ceil($PostPagination);
                  //  echo $PostPagination;
                  for($i=1; $i <= $PostPagination; $i++){                        
                      if(isset($Page)) {
                          if($i==$Page){  ?> 
               <li class="page-item active ">
                  <a href="index.php?page= <?php echo $i; ?> " class="page-link "><?php echo $i; ?></a>
               </li>
               <?php
                  }else {
                     ?>
               <li class="page-item  ">
                  <a href="index.php?page= <?php echo $i; ?> " class="page-link "><?php echo $i; ?></a>
               </li>
               <?php } } }?>
               <!--Creating Forward Button-->
               <?php if(isset($Page)&&!empty($Page)){
                  if($Page+1<=$PostPagination){?>
               <li class="page-item  ">
                  <a href="index.php?page= <?php echo $Page+1; ?> " class="page-link ">&raquo;</a>
               </li>
               <?php } } ?>                           
            </ul>
         </nav>
      </div>
      <!--End main area -->
      <?php  require_once("Includes/footer.php"); ?>