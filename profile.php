<?php 
   require_once("Includes/DB.php");
   require_once("Includes/Functions.php");
   require_once("Includes/Sessions.php");
   ?>
<!--Fetching Existing Data-->
<?php 
   $SearchQueryParameter = $_GET["username"];
   $sql = "SELECT aname,aheadline,bio,aimage FROM admins WHERE username=:userName";
   $stmt = $ConnectingDB->prepare($sql);
   $stmt->bindValue(':userName', $SearchQueryParameter);
   $stmt->execute();
   $Result = $stmt->rowcount();
   if($Result==1){
       while($DataRows = $stmt->fetch()){
           $ExistingName = $DataRows["aname"];
           $ExistingBio = $DataRows["bio"];
           $ExistingImage = $DataRows["aimage"];
           $ExistingHeadLine = $DataRows["aheadline"];
           
       }
   }else {
       $_SESSION["ErrorMessage"] = "Bad Request !";
       Redirect_to("index.php?page=1");   
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
      <title>Admin Profile</title>
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
                     <a href="index.php?page=1" class="nav-link">Home</a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">About Us</a>
                  </li>
                  <li class="nav-item">
                     <a href="$" class="nav-link">Blog</a>
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
      <header class="bg-dark text-white py-3">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <h1><i class="fas fa-user text-success mr-2" style="color:#27aae1;"></i><?php echo $ExistingName; ?></h1>
                  <h3><?php echo $ExistingHeadLine; ?></h3>
               </div>
            </div>
         </div>
      </header>
      <!-- HEADER END-->
      <!-- main area -->
      <section class="container py-2 mb-4">
         <div class="row">
            <div class="col-md-3">
               <img src="images/<?php echo $ExistingImage; ?>" class="d-block img-fluid mb-3 rounded-circle" alt="">                     
            </div>
            <div class="col-md-9" style="min-height:400px; ">
               <div class="card">
                  <div class="card-body">
                     <p><?php echo $ExistingBio; ?></p>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!--End main area -->
      <?php require_once("Includes/dashboard_footer.php") ?>