<?php 
   require_once("Includes/DB.php");
   require_once("Includes/Functions.php");
   require_once("Includes/Sessions.php");
   ?>
<?php
   if(isset($_GET["id"])){
       $SearchQueryParameter = $_GET["id"];
       global $ConnectingDB;   
       $sql = "DELETE FROM comments  WHERE id='$SearchQueryParameter'";
       $Execute = $ConnectingDB->query($sql);
       if($Execute){
           $_SESSION["SuccessMessage"] = "Comments Deleted Successfully";
           Redirect_to("Comments.php");
       }else{
           $_SESSION["ErrorMessage"] = "Something Went Wrong. Try Again!";
           Redirect_to("Comments.php");
       }
   }
   
   ?>