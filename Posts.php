<?php 
   require_once("Includes/DB.php");
   require_once("Includes/Functions.php");
   require_once("Includes/Sessions.php");
   ?>
<?php 
   $_SESSION["TracKingURL"] = $_SERVER["PHP_SELF"];
   Confirm_Login(); ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <script src="https://kit.fontawesome.com/d4d3e9f492.js" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
      <link rel="stylesheet" href="Css/style.css">
      <title>All Posts</title>
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
                  <h1><i class="fas fa-cog" style="color:#27aae1;"></i> Dashboard </h1>
               </div>
               <div class="col-lg-3 mb-2">
                  <a href="AddNewPost.php" class="btn btn-primary btn-block">
                  <i class="fas fa-edit"></i> Add New Post
                  </a>
               </div>
               <div class="col-lg-3 mb-2">
                  <a href="Categories.php" class="btn btn-info btn-block">
                  <i class="fas fa-folder-plus"></i> Add New Category
                  </a>
               </div>
               <div class="col-lg-3 mb-2">
                  <a href="Admins.php" class="btn btn-warning btn-block">
                  <i class="fas fa-user-plus"></i> Add New Admin
                  </a>
               </div>
               <div class="col-lg-3 mb-2">
                  <a href="Comments.php" class="btn btn-success btn-block">
                  <i class="fas fa-check"></i> Approve Comments
                  </a>
               </div>
            </div>
         </div>
      </header>
      <!-- HEADER END-->
      <!-- main area -->
      <section class="container py-2 mb-4">
         <div class="row">
            <div class="col-lg-12">
               <?php
                  echo ErrorMessage();
                  echo SuccessMessage();
                  ?>
               <table class="table table-striped table-hover">
                  <thead class="thead-dark">
                     <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date&Time</th>
                        <th>Author</th>
                        <th>Banner</th>
                        <th>Comments</th>
                        <th>Action</th>
                        <th>Live Preview</th>
                     </tr>
                  </thead>
                  <?php
                     global $ConnectingDB;
                     $sql = "SELECT * FROM posts";
                     $stmt = $ConnectingDB->query($sql);
                     while($DataRows = $stmt->fetch()){
                         $Id        = $DataRows["id"];     
                         $DateTime  = $DataRows["datetime"]; 
                         $PostTitle = $DataRows["datetime"]; 
                         $Category  = $DataRows["category"]; 
                         $Admin     = $DataRows["author"]; 
                         $Image     = $DataRows["image"]; 
                         $PostText  = $DataRows["post"]; 
                     
                     ?>
                  <!-- class="table-danger"
                     class="table-primary" -->
                  <tbody>
                     <tr>
                        <td>#</td>
                        <td >
                           <?php
                              if(strlen($PostTitle) > 20){$PostTitle = substr($PostTitle,0,18).'..';}
                              echo $PostTitle;
                              ?>                                      
                        </td>
                        <td>
                           <?php
                              if(strlen($Category) > 8){$Category = substr($Category,0,8).'..';}
                              echo $Category;
                              ?> 
                        </td>
                        <td>
                           <?php
                              if(strlen($DateTime) > 11){$DateTime = substr($DateTime,0,11).'..';}
                              echo $DateTime;
                              ?> 
                        </td>
                        <td ><?php echo $Admin;  ?></td>
                        <td><img src="Uploads/<?php echo $Image; ?>" width="170px;" height="70px;"  alt="No Image"></td>
                        <td>
                           <?php 
                              $Total = ApproveCommentAccordingtoPost($Id);
                              if($Total > 0 ){
                                  ?>
                           <span class="badge badge-success">
                           <?php 
                              echo $Total; ?>
                           </span>
                           <?php } ?>                                                         
                           <?php 
                              $Total = DisApproveCommentAccordingtoPost($Id);
                              if($Total > 0 ){
                                 ?>
                           <span class="badge badge-danger">
                           <?php 
                              echo $Total; ?>
                           </span>
                           <?php } ?>  
                        </td>
                        <td> 
                           <a href="EditPost.php?id=<?php echo $Id; ?>"><span class="btn btn-warning">Edit</span></a>
                           <a href="Deletepost.php?id=<?php echo $Id; ?>"><span class="btn btn-danger">Delete</span></a>
                        </td>
                        <td> 
                           <a href="FullPost.php?id=<?php echo $Id; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a>                      
                        </td>
                     </tr>
                  </tbody>
                  <?php } ?>
               </table>
            </div>
         </div>
      </section>
      <!--End main area -->
      <?php require_once("Includes/dashboard_footer.php") ?>