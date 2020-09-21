<?php 
   require_once("Includes/DB.php");
   require_once("Includes/Functions.php");
   require_once("Includes/Sessions.php");
   $SearchQuryParameter = $_GET["id"];
   global $ConnectingDB;               
                   $sql = "SELECT * FROM posts WHERE id = '$SearchQuryParameter'";
                   $stmt = $ConnectingDB->query($sql);
                   while($Datarows = $stmt->fetch()){
                       $TitleToBeDeleted      = $Datarows["title"];
                       $CategoryToBeDeleted    = $Datarows["category"];
                       $ImageToBeDeleted      = $Datarows["image"];
                       $PostToBeDeleted       = $Datarows["post"];
                   }
   ?>
<?php Confirm_Login(); ?>
<?php
   if(isset($_POST["Submit"])){
      
           $sql = "DELETE FROM posts WHERE id = '$SearchQuryParameter'";
   
           $Execute = $ConnectingDB->query($sql);        
           move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);
   
           if($Execute){
               $Target_path_To_DELETE_Image = "Uploads/$ImageToBeDeleted";
               unlink($Target_path_To_DELETE_Image);
               $_SESSION["SuccessMessage"] = "Post Deleted Successfully";
               Redirect_to("posts.php");
           }
           else{
               $_SESSION["ErrorMessage"] = "Something Went Wrong , Try Agian";
               Redirect_to("posts.php"); 
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
      <title>Delete Post</title>
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
                  <h1><i class="fas fa-edit" style="color:#27aae1;"></i> Delete Post</h1>
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
               <form action="Deletepost.php?id=<?php echo $SearchQuryParameter; ?>" method="POST" enctype="multipart/form-data">
                  <div class="card bg-secondary text-light mb-3" >
                     <div class="card-body bg-dark">
                        <div class="form-group">
                           <label for="title "> <span class="FieldInfo"> Post Title:</span> </label>
                           <input disabled class="form-control" type="text"  name="PostTitle" id="title" placeholder="Type title here" value="<?php echo $TitleToBeDeleted ; ?>">
                        </div>
                        <div class="form-group">
                           <span class="FieldInfo">Existing Category :</span>
                           <?php echo $CategoryToBeDeleted;  ?>
                        </div>
                        <div class="form=group">
                           <span class="FieldInfo">Existing Category :</span>
                           <img src="uploads/<?php echo $ImageToBeDeleted; ?>" width="170px"; height="70px"; alt="">                                                                                                  
                        </div>
                        <div class="form-group">
                           <label for="title "> <span class="FieldInfo"> Post Title:</span> </label>
                           <textarea disabled  class="form-control" name="PostDescription" id="Post" cols="80" rows="8"><?php echo $PostToBeDeleted; ?>
                           </textarea>
                        </div>
                        <div class="row"  >
                           <div class="col-lg-6 mb-2">
                              <a href="Dashboard.php" class="btn btn-warning btn-block "> <i class="fas fa-arrow-left"></i> Back To DashBoard </a>
                           </div>
                           <div class="col-lg-6 mb-2">
                              <button type="submit" name="Submit" class="btn btn-danger btn-block" >
                              <i class="fas fa-trash"></i> Delete
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