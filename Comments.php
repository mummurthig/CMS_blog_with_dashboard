<?php 
   require_once("Includes/DB.php");
   require_once("Includes/Functions.php");
   require_once("Includes/Sessions.php");
   ?>
<?php 
   $_SESSION["TracKingURL"] = $_SERVER["PHP_SELF"];
   Confirm_Login();
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
      <title>All Comments</title>
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
                  <h1><i class="fas fa-comments" style="color:#27aae1;"></i> Comments</h1>
               </div>
            </div>
         </div>
      </header>
      <!-- HEADER END-->
      <!-- main area -->            
      <section class="container py-2 mb-4">
         <div class="row" style="min-height:30px"; >
            <div class="col-lg-12" style="min-height:400px";>
               <?php
                  echo ErrorMessage();
                  echo SuccessMessage();
                  ?>
               <h2>Un Approved Comments</h2>
               <table class="table table-striped table-hover">
                  <thead class="thead-dark">
                     <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Date&Time</th>
                        <th>Comment</th>
                        <th>Approve</th>
                        <th>Delete</th>
                        <th>Details</th>
                     </tr>
                  </thead>
                  <?php 
                     global $ConnectingDB;
                     $sql = "SELECT * FROM comments WHERE status = 'OFF' ORDER BY id desc ";
                     $Execute = $ConnectingDB->query($sql);
                     $SrNo = 0;
                     while ($DataRows = $Execute->fetch()) {
                         $CommentId = $DataRows["id"];
                         $DataTimeOfComment = $DataRows["datetime"];
                         $CommenterName = $DataRows["name"];
                         $CommentContent = $DataRows["comment"];
                         $CommentPostID = $DataRows["post_id"];
                         $SrNo++;     
                        //  if(strlen($CommenterName)>10){$CommenterName = substr($CommenterName,0,10).'..';}                                                                                                   
                        //  if(strlen($DataTimeOfComment)>11){$DataTimeOfComment = substr($DataTimeOfComment,0,11).'..';}                                                                                                   
                     ?>
                  <tbody>
                     <tr>
                        <td><?php echo htmlentities($SrNo); ?></td>
                        <td><?php echo htmlentities($DataTimeOfComment); ?></td>
                        <td><?php echo htmlentities($CommenterName); ?></td>
                        <td><?php echo htmlentities($CommentContent); ?></td>
                        <td style="min-width:140px;"><a class="btn btn-success" href="ApproveComments.php?id=<?php echo $CommentId ?>"  >Approve</a> </td>
                        <td><a class="btn btn-danger" href="DeleteComments.php?id=<?php echo $CommentId ?>"  >Delete</a> </td>
                        <td style="min-width:140px;"><a class="btn btn-primary" href="FullPost.php?id=<?php echo $CommentPostID; ?>" target="_blank">Live PreView</a></td>
                     </tr>
                  </tbody>
                  <?php } ?>
               </table>
               <h2>Approved Comments</h2>
               <table class="table table-striped table-hover">
                  <thead class="thead-dark">
                     <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Date&Time</th>
                        <th>Comment</th>
                        <th>Revert</th>
                        <th>Delete</th>
                        <th>Details</th>
                     </tr>
                  </thead>
                  <?php 
                     global $ConnectingDB;
                     $sql = "SELECT * FROM comments WHERE status = 'ON' ORDER BY id desc ";
                     $Execute = $ConnectingDB->query($sql);
                     $SrNo = 0;
                     while ($DataRows = $Execute->fetch()) {
                         $CommentId = $DataRows["id"];
                         $DataTimeOfComment = $DataRows["datetime"];
                         $CommenterName = $DataRows["name"];
                         $CommentContent = $DataRows["comment"];
                         $CommentPostID = $DataRows["post_id"];
                         $SrNo++;     
                        //  if(strlen($CommenterName)>10){$CommenterName = substr($CommenterName,0,10).'..';}                                                                                                   
                        //  if(strlen($DataTimeOfComment)>11){$DataTimeOfComment = substr($DataTimeOfComment,0,11).'..';}                                                                                                   
                     ?>
                  <tbody>
                     <tr>
                        <td><?php echo htmlentities($SrNo); ?></td>
                        <td><?php echo htmlentities($DataTimeOfComment); ?></td>
                        <td><?php echo htmlentities($CommenterName); ?></td>
                        <td><?php echo htmlentities($CommentContent); ?></td>
                        <td style="min-width:140px;"><a class="btn btn-warning" href="DisApproveComments.php?id=<?php echo $CommentId ?>"  >Dis Approve</a> </td>
                        <td><a class="btn btn-danger" href="DeleteComments.php?id=<?php echo $CommentId ?>"  >Delete</a> </td>
                        <td style="min-width:140px;"><a class="btn btn-primary" href="FullPost.php?id=<?php echo $CommentPostID; ?>" target="_blank">Live PreView</a></td>
                     </tr>
                  </tbody>
                  <?php } ?>
               </table>
            </div>
         </div>
      </section>
      <!--End main area -->
      <?php require_once("Includes/dashboard_footer.php") ?>