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
       $Category = $_POST["CategoryTitle"];
       $admin = $_SESSION["UserName"];
       date_default_timezone_set("Asia/Kolkata");
       $CurrentTime = time();
       $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
   
       if(empty($Category)){
          $_SESSION["ErrorMessage"] = "All fields must be filled out";
          Redirect_to("Categories.php");
       }elseif(strlen($Category) < 3 ){
           $_SESSION["ErrorMessage"] = "Category title should be greater than 2 Characters";
           Redirect_to("Categories.php");
       }elseif(strlen($Category) > 49){
           $_SESSION["ErrorMessage"] = "Category title should be Less than 50 Characters";
           Redirect_to("Categories.php");
       }else{
   
           $sql = "INSERT INTO category(title,author,datetime)";
           $sql .= "VALUES(:categoryName, :adminName, :dateTime)";
           $stmt = $ConnectingDB->prepare($sql);
           $stmt->bindValue(':categoryName', $Category);
           $stmt->bindValue(':adminName', $admin);
           $stmt->bindValue(':dateTime', $DateTime);
           $Execute = $stmt->execute();
   
           if($Execute){
               $_SESSION["SuccessMessage"] = "Category with id : " .$ConnectingDB->lastInsertId()." Added Successfully";
               Redirect_to("Categories.php");
           }
           else{
               $_SESSION["ErrorMessage"] = "Something Went Wrong , Try Agian";
               Redirect_to("Categories.php"); 
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
      <title>Add New Category</title>
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
                  <h1><i class="fas fa-edit" style="color:#27aae1;"></i> Manage Categories</h1>
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
               <form action="Categories.php" method="POST">
                  <div class="card bg-secondary text-light mb-3" >
                     <div class="card-header">
                        <h1>Add New Category</h1>
                     </div>
                     <div class="card-body bg-dark">
                        <div class="form-group">
                           <label for="title "> <span class="FieldInfo"> Category Title:</span> </label>
                           <input class="form-control" type="text"  name="CategoryTitle" id="title" placeholder="Type title here">
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
               <h2>Existing Categories</h2>
               <table class="table table-striped table-hover">
                  <thead class="thead-dark">
                     <tr>
                        <th>No.</th>
                        <th>Date&Time</th>
                        <th>Category Name</th>
                        <th>Creator Name</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <?php 
                     global $ConnectingDB;
                     $sql = "SELECT * FROM category  ORDER BY id desc ";
                     $Execute = $ConnectingDB->query($sql);
                     $SrNo = 0;
                     while ($DataRows = $Execute->fetch()) {
                         $CategoryId = $DataRows["id"];
                         $CategoryDate = $DataRows["datetime"];
                         $CategoryName = $DataRows["title"];
                         $CreatorName = $DataRows["author"];                        
                         $SrNo++;                             
                     ?>
                  <tbody>
                     <tr>
                        <td><?php echo htmlentities($SrNo); ?></td>
                        <td><?php echo htmlentities($CategoryDate); ?></td>
                        <td><?php echo htmlentities($CategoryName); ?></td>
                        <td><?php echo htmlentities($CreatorName); ?></td>
                        <td><a class="btn btn-danger" href="DeleteCategory.php?id=<?php echo $CategoryId ?>"  >Delete</a> </td>
                     </tr>
                  </tbody>
                  <?php } ?>
               </table>
            </div>
         </div>
      </section>
      <!--End main area -->
      <?php require_once("Includes/dashboard_footer.php") ?>