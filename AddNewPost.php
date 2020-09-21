<?php 
   require_once("Includes/DB.php");
   require_once("Includes/Functions.php");
   require_once("Includes/Sessions.php");
   ?>
<?php
   $_SESSION["TracKingURL"] = $_SERVER["PHP_SELF"];
   Confirm_Login(); ?>
<?php
   if(isset($_POST["Submit"])){
       $PosTitle = $_POST["PostTitle"];
       $Category = $_POST["Category"];
       $Image = $_FILES["Image"]["name"];
       $Target = "Uploads/".basename($_FILES["Image"]["name"]);
       $PostText = $_POST["PostDescription"];
   
       $admin = $_SESSION["UserName"];
       date_default_timezone_set("Asia/Kolkata");
       $CurrentTime = time();
       $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
   
       if(empty($PosTitle)){
          $_SESSION["ErrorMessage"] = "Title Cant be Empty";
          Redirect_to("AddNewPost.php");
       }elseif(strlen($PosTitle) < 5 ){
           $_SESSION["ErrorMessage"] = "Post title should be greater than 5 Characters";
           Redirect_to("AddNewPost.php");
       }elseif(strlen($PostText) > 9999){
           $_SESSION["ErrorMessage"] = "Post Description should be Less than 10000 Characters";
           Redirect_to("AddNewPost.php");
       }else{
   
           $sql = "INSERT INTO posts(datetime, title, category, author,image, post)";
           $sql .= "VALUES(:dateTime,:postTitle,:categoryName,  :adminName, :imageName, :postDescription)";
           $stmt = $ConnectingDB->prepare($sql);
           $stmt->bindValue(':dateTime', $DateTime);
           $stmt->bindValue(':postTitle', $PosTitle);
           $stmt->bindValue(':categoryName', $Category);
           $stmt->bindValue(':adminName', $admin);
           $stmt->bindValue(':imageName', $Image);
           $stmt->bindValue(':postDescription', $PostText);
           move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);
   
           $Execute = $stmt->execute();
   
           if($Execute){
               $_SESSION["SuccessMessage"] = "Post with id : " .$ConnectingDB->lastInsertId()." Added Successfully";
               Redirect_to("AddNewPost.php");
           }
           else{
               $_SESSION["ErrorMessage"] = "Something Went Wrong , Try Agian";
               Redirect_to("AddNewPost.php"); 
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
      <title>Add New Posts</title>
   </head>
   <body>
      <!--NAVBAR-->
      <div style="height: 10px; background: #27aae1;"></div>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
         <div class="container" >
            <a href="#" class="navbar-brand">CMS Blog </a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS" >
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarcollapseCMS">
               <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                     <a href="MyProfile.php" class="nav-link"><i class="fas fa-user text-success"></i> My Profile</a>
                  </li>
                  <li class="nav-item">
                     <a href="Dashboard.php" class="nav-link">Dashboard</a>
                  </li>
                  <li class="nav-item">
                     <a href="Posts.php" class="nav-link">Posts</a>
                  </li>
                  <li class="nav-item">
                     <a href="Categories.php" class="nav-link">Categories</a>
                  </li>
                  <li class="nav-item">
                     <a href="Admins.php" class="nav-link">Manage Admins</a>
                  </li>
                  <li class="nav-item">
                     <a href="Comments.php" class="nav-link">Comments</a>
                  </li>
                  <li class="nav-item">
                     <a href="index.php?page=1" target="_blank" class="nav-link">Live Blog</a>
                  </li>
               </ul>
               <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                     <a class="nav-link text-danger" href="Logout.php"><i class="fas fa-user-times "></i> Logout</a>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
      <div style="height: 10px; background: #27aae1;"></div>
      <!-- NAVBAR END -->
      <!-- HEADER -->
      <header class="bg-dark text-white py-3">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h1><i class="fas fa-edit" style="color:#27aae1;"></i> Add New Post</h1>
               </div>
            </div>
         </div>
      </header>
      <!-- HEADER END-->
      <!-- main area -->
      <section class="container py-2 mb-4">
         <div class="row" >
            <div class="offset-lg-1 col-lg-10" style="min-height: 400px;">
               <?php
                  echo ErrorMessage();
                  echo SuccessMessage();
                  ?>
               <form action="AddNewPost.php" method="POST" enctype="multipart/form-data">
                  <div class="card bg-secondary text-light mb-3" >
                     <div class="card-body bg-dark">
                        <div class="form-group">
                           <label for="title "> <span class="FieldInfo"> Post Title:</span> </label>
                           <input class="form-control" type="text"  name="PostTitle" id="title" placeholder="Type title here">
                        </div>
                        <div class="form-group">
                           <label for="title "> <span class="FieldInfo"> Chose Category:</span> </label>
                           <select class="form-control" name="Category" id="CategoryTitle">
                              <?php
                                 //Fetch all Categories from database
                                 global $ConnectingDB;
                                 $sql = "SELECT id, title FROM category";
                                 $stmt = $ConnectingDB->query($sql);
                                 while($Datarows = $stmt->fetch()){
                                     $Id = $Datarows['id'];
                                     $CategoryName = $Datarows["title"];                                                                                                                  
                                 ?>
                              <option > <?php echo $CategoryName; ?></option>
                              <?php } ?> 
                           </select>
                        </div>
                        <div class="form=group">
                           <label for="Image "> <span class="FieldInfo"> Select Image:</span> </label>
                           <div class="custom-file">
                              <input type="File" name="Image" id="imageSelect">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="title "> <span class="FieldInfo"> Post Title:</span> </label>
                           <textarea  class="form-control" name="PostDescription" id="Post" cols="80" rows="8"></textarea>
                        </div>
                        <div class="row"  >
                           <div class="col-lg-6 mb-2">
                              <a href="Dashboard.php" class="btn btn-warning btn-block "> <i class="fas fa-arrow-left"></i> Back To DashBoard </a>
                           </div>
                           <div class="col-lg-6 mb-2">
                              <button type="submit" name="Submit" class="btn btn-success btn-block" >
                              <i class="fas fa-check"></i> Publish
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </section>
      <!--End main area -->
      <?php require_once("Includes/dashboard_footer.php") ?>