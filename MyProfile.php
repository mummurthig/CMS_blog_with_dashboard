<?php 
   require_once("Includes/DB.php");
   require_once("Includes/Functions.php");
   require_once("Includes/Sessions.php");
   ?>
<?php
   // Fetching the existing Admin data Start
   $AdminId = $_SESSION["UserId"];
   $sql = "SELECT * FROM admins WHERE id = '$AdminId'";
   $stmt = $ConnectingDB->query($sql);
   while ($Datarows = $stmt->fetch()){
       $ExistingName = $Datarows["aname"];
       $ExistingUserName= $Datarows["username"];
       $ExistingHeadline= $Datarows["aheadline"];
       $ExistingBio = $Datarows["bio"];
       $ExistingImage = $Datarows["aimage"];
   }
   // Fetching the existing Admin data End
   $_SESSION["TracKingURL"] = $_SERVER["PHP_SELF"];
   Confirm_Login(); ?>
<?php
   if(isset($_POST["Submit"])){
       $AName = $_POST["Name"];
       $AHeadline = $_POST["Headline"];
       $ABio = $_POST["Bio"];
       $Image = $_FILES["Image"]["name"];
       $Target = "Images/".basename($_FILES["Image"]["name"]);
       
       if(strlen($AHeadline) > 30 ){
           $_SESSION["ErrorMessage"] = "Headline should be Less than 30 Characters";
           Redirect_to("MyProfile.php");
       }elseif(strlen($ABio) > 500){
           $_SESSION["ErrorMessage"] = "Bio should be Less than 500 Characters";
           Redirect_to("MyProfile.php");
       }else{
   
           if(!empty($_FILES["Image"]["name"])){
               $sql = "UPDATE admins
               SET aname = '$AName', aheadline	= '$AHeadline', bio= '$ABio', aimage = '$Image'
               WHERE id= '$AdminId'";
           }elseif(!empty($AHeadline)){
               $sql = "UPDATE admins
               SET aname = '$AName', aheadline= '$AHeadline', bio= '$ABio'
               WHERE id= '$AdminId'";
           }
           else{
               $sql = "UPDATE admins
               SET aname = '$AName',  bio= '$ABio'
               WHERE id= '$AdminId'";
           }       
           $Execute = $ConnectingDB->query($sql);        
           move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);
   
           $Execute = $stmt->execute();
   
           if($Execute){
               $_SESSION["SuccessMessage"] = "Deatils Updated Successfully";
               Redirect_to("MyProfile.php");
           }
           else{
               $_SESSION["ErrorMessage"] = "Something Went Wrong , Try Agian";
               Redirect_to("MyProfile.php");
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
      <title>My Profile</title>
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
                  <h1><i class="fas fa-user mr-2" style="color:#27aae1;"></i>@<?php echo $ExistingUserName; ?></h1>
                  <small><?php echo $ExistingHeadline; ?></small>
               </div>
            </div>
         </div>
      </header>
      <!-- HEADER END-->
      <!-- main area -->
      <section class="container py-2 mb-4">
         <div class="row" >
            <!--Left Aera-->
            <div class="col-md-3">
               <div class="card">
                  <div class="card-header bg-dark text-light">
                     <h3><?php echo $ExistingName; ?> </h3>
                  </div>
                  <div class="card-body">
                     <img src="images/<?php echo $ExistingImage; ?>" class="block img-fluid mb-3" alt="">
                     <div class="">
                        <?php echo $ExistingBio; ?>
                     </div>
                  </div>
               </div>
            </div>
            <!--Left Aera-->
            <div class="col-lg-9" style="min-height: 400px;">
               <?php
                  echo ErrorMessage();
                  echo SuccessMessage();
                  ?>
               <form action="MyProfile.php" method="POST" enctype="multipart/form-data">
                  <div class="card bg-dark text-light" >
                     <div class="card-header bg-secondary text-light">
                        <h4>Edit Profile</h4>
                     </div>
                     <div class="card-body ">
                        <div class="form-group">                                   
                           <input class="form-control" type="text"  name="Name" id="title" placeholder="Your name" value="<?php echo $ExistingName; ?>">                                    
                        </div>
                        <div class="form-group">                                   
                           <input class="form-control" type="text"  id="title" placeholder="Headline" name="Headline" value="<?php echo $ExistingHeadline; ?>">
                           <small class="text-muted"> Add a Professional headline like, 'Enginner' at XYZ or 'Architech'</small>
                           <span class="text-danger">Not more than 30 characters</span>
                        </div>
                        <div class="form-group">                                   
                           <textarea placeholder="Bio"  class="form-control" name="Bio" id="Post" cols="80" rows="8"><?php echo $ExistingBio; ?></textarea>
                        </div>
                        <div class="form=group">
                           <label for="Image "> <span class="FieldInfo"> Select Image:</span> </label>
                           <div class="custom-file">
                              <input type="File" name="Image" id="imageSelect">
                           </div>
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