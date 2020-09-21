<?php 
   require_once("Includes/DB.php");
   require_once("Includes/Functions.php");
   require_once("Includes/Sessions.php");
   ?>
<?php 
   $_SESSION["TracKingURL"] = $_SERVER["PHP_SELF"];
   Confirm_Login();
   ?>
<?php
   if(isset($_POST["Submit"])){    
       $UserName = $_POST["Username"];
       $Name = $_POST["Name"];
       $Password = $_POST["Password"];
       $ConFirmPassword = $_POST["ConfirmPassword"];
       $admin = $_SESSION["UserName"];
       date_default_timezone_set("Asia/Kolkata");
       $CurrentTime = time();
       $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
   
       if(empty($UserName)||empty($Password)||empty($ConFirmPassword) ){
          $_SESSION["ErrorMessage"] = "All fields must be filled out";
          Redirect_to("Admins.php");
       }elseif(strlen($Password)<4 ){
           $_SESSION["ErrorMessage"] = "Password be grater than 3 Characters ";
           Redirect_to("Admins.php");
       }elseif($Password !== $ConFirmPassword ){
           $_SESSION["ErrorMessage"] = "Password and ConfirmPassword should not match";
           Redirect_to("Admins.php");
       }elseif(ChechUserName($UserName)){
           $_SESSION["ErrorMessage"] = "UserName Existe .Try Another One!";
           Redirect_to("Admins.php");
       }else{
   
           $sql = "INSERT INTO admins(datetime,username,password,aname,addedby)";
           $sql .= "VALUES(:datetime,:userName,:password,:aName,:adminName)";
           $stmt = $ConnectingDB->prepare($sql);
           $stmt->bindValue(':datetime', $DateTime);
           $stmt->bindValue(':userName', $UserName);
           $stmt->bindValue(':password', md5($Password));
           $stmt->bindValue(':aName', $Name);
           $stmt->bindValue(':adminName', $admin);
           $Execute = $stmt->execute();
   
           if($Execute){
               $_SESSION["SuccessMessage"] = "New Admin with the name of ".$Name." Added Successfully";
               Redirect_to("Admins.php");
           }
           else{
               $_SESSION["ErrorMessage"] = "Something Went Wrong , Try Agian";
               Redirect_to("Admins.php");
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
      <title>Manage Admins</title>
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
                  <h1><i class="fas fa-user" style="color:#27aae1;"></i> Manage Admins</h1>
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
               <form action="Admins.php" method="POST">
                  <div class="card bg-secondary text-light mb-3" >
                     <div class="card-header">
                        <h1>Add New Category</h1>
                     </div>
                     <div class="card-body bg-dark">
                        <div class="form-group">
                           <label for="username "> <span class="FieldInfo">User Name:</span> </label>
                           <input class="form-control" type="text"  name="Username" id="username"   >
                        </div>
                        <div class="form-group">
                           <label for="username "> <span class="FieldInfo"> Name:</span> </label>
                           <input class="form-control" type="text"  name="Name" id="name" >
                           <small class="text-muted">*Optional</small>
                        </div>
                        <div class="form-group">
                           <label for="title "> <span class="FieldInfo"> Password:</span> </label>
                           <input class="form-control" type="password"  name="Password" id="password" >
                        </div>
                        <div class="form-group">
                           <label for="title "> <span class="FieldInfo">Confirm Password :</span> </label>
                           <input class="form-control" type="password"  name="ConfirmPassword" id="password" >
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
               <h2>Existing Admins</h2>
               <table class="table table-striped table-hover">
                  <thead class="thead-dark">
                     <tr>
                        <th>No.</th>
                        <th>Date&Time</th>
                        <th>UserName</th>
                        <th>Admin Name</th>
                        <th>Added By</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <?php 
                     global $ConnectingDB;
                     $sql = "SELECT * FROM admins ORDER BY id desc ";
                     $Execute = $ConnectingDB->query($sql);
                     $SrNo = 0;
                     while ($DataRows = $Execute->fetch()) {
                         $AdminId = $DataRows["id"];
                         $DateTime = $DataRows["datetime"];
                         $AdminUsername = $DataRows["username"];                       
                         $AdminName = $DataRows["aname"];
                         $AddedBy = $DataRows["addedby"];
                         $SrNo++;     
                        //  if(strlen($CommenterName)>10){$CommenterName = substr($CommenterName,0,10).'..';}                                                                                                   
                        //  if(strlen($DataTimeOfComment)>11){$DataTimeOfComment = substr($DataTimeOfComment,0,11).'..';}                                                                                                   
                     ?>
                  <tbody>
                     <tr>
                        <td><?php echo htmlentities($SrNo); ?></td>
                        <td><?php echo htmlentities($DateTime); ?></td>
                        <td><?php echo htmlentities($AdminUsername); ?></td>
                        <td><?php echo htmlentities($AdminName); ?></td>
                        <td><?php echo htmlentities($AddedBy); ?></td>
                        <td><a class="btn btn-danger" href="DeleteAdmin.php?id=<?php echo $AdminId ?>"  >Delete</a> </td>
                     </tr>
                  </tbody>
                  <?php } ?>
               </table>
            </div>
         </div>
      </section>
      <!--End main area -->
      <?php require_once("Includes/dashboard_footer.php") ?>