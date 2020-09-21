<?php 
   require_once("Includes/DB.php");
   require_once("Includes/Functions.php");
   require_once("Includes/Sessions.php");
   ?>
<?php $SearchQuryParameter = $_GET["id"]; ?>
<?php
   if(isset($_POST["Submit"])){
       $Name = $_POST["CommenterName"];
       $Email = $_POST["Commenteremail"];
       $Comment = $_POST["CommenterThoughts"];
       $admin = "Miki";
       date_default_timezone_set("Asia/Kolkata");
       $CurrentTime = time();
       $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
   
       if(empty($Name)||empty($Email)||empty($Comment) ){
          $_SESSION["ErrorMessage"] = "All fields must be filled out";
          Redirect_to("FullPost.php?id=$SearchQuryParameter");
       }elseif(strlen($Category) > 500 ){
           $_SESSION["ErrorMessage"] = "Comment should be Less than 500 Characters ";
           Redirect_to("FullPost.php?id=$SearchQuryParameter");
       }else{
   
           $sql = "INSERT INTO comments(datetime,name,email,comment,approvedby,status,post_id)";
           $sql .= "VALUES(:datetime, :name, :email, :comment,'Pending','OFF', :PostIdFromUrl)";
           $stmt = $ConnectingDB->prepare($sql);
           $stmt->bindValue(':datetime', $DateTime);
           $stmt->bindValue(':name', $Name);
           $stmt->bindValue(':email', $Email);
           $stmt->bindValue(':comment', $Comment);
           $stmt->bindValue(':PostIdFromUrl', $SearchQuryParameter);
           $Execute = $stmt->execute();
   
           if($Execute){
               $_SESSION["SuccessMessage"] = "Comments Added Successfully";
               Redirect_to("FullPost.php?id=$SearchQuryParameter");
           }
           else{
               $_SESSION["ErrorMessage"] = "Something Went Wrong , Try Agian";
               Redirect_to("FullPost.php?id=$SearchQuryParameter");
           }
       }
   }
   
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
      <title>Blog Posts</title>
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
                     <a href="Login.php" class="nav-link">Admin Login</a>
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
            else{
                $PostFromUrl = $_GET["id"];
                if(!isset($PostFromUrl)){
                    $_SESSION["ErrorMessage"] = "BAd Requst !";
                    Redirect_to("index.php?page=1");
                }
                $sql = "SELECT * FROM posts WHERE id = '$PostFromUrl'";
                $stmt = $ConnectingDB->query($sql);
                $Result = $stmt->rowcount($sql);
                if($Result !=1){
                  $_SESSION["ErrorMessage"] = "BAd Requst !";
                    Redirect_to("index.php?page=1");
                }
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
         <div class="card">
            <img src="uploads/<?php echo htmlentities($Image); ?>" style="max-height:450px;" class="img-fluid card-img-top" alt="">
            <div class="card-body">
               <h4 class="card-title"><?php echo htmlentities($PostTitle); ?></h4>
               <small class="text-muted">Category <span class="text-dark"> <a href="index.php?category=<?php echo htmlentities($Category); ?>"> <?php echo htmlentities($Category); ?></span> </a>  & Written by <span class="text-dark"> <a href="profile.php?username=<?php echo htmlentities($Admin); ?>"> <?php echo htmlentities($Admin);?></a> </span>  On <span class="text-dark"><?php echo htmlentities($DateTime); ?> </span> </small>
               <hr>
               <p class="card-text">
                  <?php echo nl2br($PostDescription);?>
               </p>
            </div>
         </div>
         <br>
         <?php  } ?>
         <!--Comment Part start -->
         <!--Fetching existing Comment Start -->
         <span class="FieldInfo">Comments</span>
         <br><br>
         <?php 
            global $ConnectingDB;
            $sql = "SELECT * FROM comments WHERE post_id= '$SearchQuryParameter' AND status = 'ON' ";
            $stmt = $ConnectingDB->query($sql);
            while ($DataRows = $stmt->fetch()) {
                $CommentDate     = $DataRows["datetime"];
                $CommenterNmae     = $DataRows["name"];
                $CommentContent     = $DataRows["comment"];
            
            
            ?>   
         <div>
            <div class="media CommentBlock">
               <img class="d-block img-fluid align-self-start" src="images/profile.png" width="100px" alt="">
               <div class="media-body ml-2">
                  <h6 class="lead"><?php echo $CommenterNmae; ?></h6>
                  <p class="small"><?php echo $CommentDate; ?></p>
                  <p><?php echo $CommentContent; ?></p>
               </div>
            </div>
         </div>
         <hr>
         <?php  } ?>                   
         <!--Fetching existing Comment End -->
         <div class="">
            <form action="FullPost.php?id=<?php echo $SearchQuryParameter; ?>" method="POST" class="ss">
               <div class="card mb-3">
                  <div class="card-header">
                     <h5 class="Fieldinfo">Share Your Thoughts about this post </h5>
                  </div>
                  <div class="card-body">
                     <div class="form-group">
                        <div class="input-group">
                           <div class="input-group-prepend"> 
                              <span class="input-group-text"><i class="fas fa-user"></i></span>                                      
                           </div>
                           <input class="form-control" type="text" name="CommenterName" placeholder="Name" value="">                                          
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="input-group">
                           <div class="input-group-prepend"> 
                              <span class="input-group-text"><i class="fas fa-envelope"></i></span>                                      
                           </div>
                           <input class="form-control" type="email" name="Commenteremail" placeholder="Email" value="">                                          
                        </div>
                     </div>
                     <div class="form-gropu"> 
                        <textarea name="CommenterThoughts" class="form-control" id="" cols="80" rows="6"></textarea><br>
                     </div>
                     <div class="">
                        <button type="submit" name="Submit" class="btn btn-primary">Submit</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <!--Comment Part End -->
      </div>
      <!--End main area -->
      <?php  require_once("Includes/footer.php"); ?>