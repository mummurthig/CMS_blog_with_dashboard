<!--Side area Start-->
<div class="col-sm-4" >
   <div class="card mt-4">
      <div class="card-body">
         <img src="Images/startblog.png" class="d-block img-fluid mb-3" alt="">
         <div class="text-center"> 
            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
         </div>
      </div>
   </div>
   <br>
   <div class="card">
      <div class="card-header bg-dark text-light">
         <h2 class="lead">Sign Up</h2>
      </div>
      <div class="card-body">
         <button class="btn btn-success btn-block text-center text-white mb-4">Join The Fourm</button>
         <button class="btn btn-danger btn-block text-center text-white mb-4">Login</button>
         <div class="input-group mb-3">
            <input type="text" class="form-control" name="" placeholder="Enter Your Email" value="">
            <div class="input-group-append">
               <button class="btn btn-primary btn-sm text-center text-white" type="button">Subscribe Now</button>                      
            </div>
         </div>
      </div>
   </div>
   <br>
   <div class="card">
      <div class="card-header bg-primary text-light">
         <h2 class="lead">Categories</h2>
      </div>
      <div class="card-body">
         <?php
            $sql = "SELECT * FROM category ORDER BY id DESC ";
            $stmt = $ConnectingDB->query($sql);
            while($DataRows = $stmt->fetch()){
                $CategoryId = $DataRows["id"];
                $CategoryName = $DataRows["title"];                          
             ?>
         <a href="index.php?category=<?php echo $CategoryName; ?>"><span class="heading"><?php echo $CategoryName; ?></span></a>
         <br>
         <?php } ?>
      </div>
   </div>
   <br>
   <div class="card">
      <div class="card-header bg-info text-white">
         <h2 class="lead">Recent Posts</h2>
      </div>
      <div class="card-body">
         <?php
            $sql ="SELECT * FROM posts ORDER BY id Desc LIMIT 0,5";
            $stmt = $ConnectingDB->query($sql);
            while($DataRows = $stmt->fetch()){
                $Id = $DataRows["id"];
                $Title = $DataRows["title"];
                $DateTime = $DataRows["datetime"];
                $Image = $DataRows["image"];                                                                                        
            ?>
         <div class="media">
            <img src="Uploads/<?php echo $Image; ?>" class="d-block img-fluid align-self-start" width="90" height="94"  alt="">                   
            <div class="media-body ml-2">
               <a href="FullPost.php?id=<?php echo $Id; ?>" target="_blank">
                  <h6 class="lead"><?php echo $Title; ?></h6>
               </a>
               <p class="small"><?php echo $DateTime; ?></p>
            </div>
         </div>
         <hr>
         <?php  } ?>
      </div>
   </div>
</div>
<!--Side area End -->
</div>
</div>
<!-- HEADER END-->
<br>
<!-- FOOTER -->
<footer class="bg-dark text-white">
   <div class="container">
      <div class="row">
         <div class="col">
            <p class="lead text-center"> Theme By  | Developers | &copy; <span id="year">2020</span> &copy; Allright Recerved  </p>
            <p class="text-center small"><a style="color: white; text-decoration: none; cursor: pointer;" href="https://github.com/mummurthig" target="_blank">
               It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum   <br>as opposed to using 'Content here, content here', making it look like readable English.
               </a>
            </p>
         </div>
      </div>
   </div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>   
<script>
   $('$year').text(new Date().getFullYear());
</script>
</body>
</html>