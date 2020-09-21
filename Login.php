<?php 
   require_once("Includes/DB.php");
   require_once("Includes/Functions.php");
   require_once("Includes/Sessions.php");
   ?>
<?php 
   if(isset($_SESSION["UserId"])){
       Redirect_to("Dashboard.php");
   }
   
   
   if(isset($_POST["Submit"])){
        $UserName = $_POST["Username"];
        $Password = $_POST["Password"];
        if(empty($UserName) || empty($Password)){
           $_SESSION["ErrorMessage"] = "All fields must be filled out";
           Redirect_to("Login.php");
        }else{
           $Found_Account=Login_Attempt($UserName, $Password);
           if($Found_Account){
               $_SESSION["UserId"] = $Found_Account["id"];
               $_SESSION["UserName"] = $Found_Account["username"];
               $_SESSION["AdminName"] = $Found_Account["aname"];
   
               $_SESSION["SuccessMessage"] = "Welcome ".$_SESSION["AdminName"]."!";
               if(isset($_SESSION["TracKingURL"] )){
                   Redirect_to($_SESSION["TracKingURL"]);
               }else{
                   Redirect_to("Dashboard.php");
               }
               
           }else{
               $_SESSION["ErrorMessage"] = "Incorrect username / password";
               Redirect_to("Login.php");
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
      <title>Welcome Admin!</title>
   </head>
   <body>
      <!--NAVBAR-->
      <div style="height: 10px; background: #27aae1;"></div>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
         <div class="container" >
            <a href="#" class="navbar-brand">Miki Shalu</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS" >
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarcollapseCMS">
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
               </div>
            </div>
         </div>
      </header>
      <br>
      <!-- HEADER END-->
      <!-- main area Start-->
      <section class="container py-2 mb-4">
         <div class="row">
            <div class="offset-sm-3 col-sm-6" style="min-height:450px;">
               <br><br><br>
               <?php
                  echo ErrorMessage();
                  echo SuccessMessage();
                  ?>
               <div class="card bg-secondary text-light">
                  <div class="card-header">
                     <h4>Welcome Back !</h4>
                  </div>
                  <div class="card-body bg-dark">
                     <form action="Login.php" method="POST">
                        <div class="form-group">
                           <label for="username"><span class="FieldInfo">UserName</span></label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-white bg-info"><i class="fas fa-user"></i></span>
                              </div>
                              <input type="text" class="form-control" name="Username" id="username" value="">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="password"><span class="FieldInfo">Password</span></label>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text text-white bg-info"><i class="fas fa-lock"></i></span>
                              </div>
                              <input type="password" class="form-control" name="Password" id="password" value="">
                           </div>
                        </div>
                        <input type="submit" name="Submit" class="btn btn-info btn-block" value="Login">
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!--End main area -->
      <?php require_once("Includes/dashboard_footer.php") ?>