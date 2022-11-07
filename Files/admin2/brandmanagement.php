<?php
//start session
session_start();
//include database connection 
include('../function/database.php');

//EDIT BRAND
//REDIRECT USER TO EDIT brandPAGE
if(isset($_GET['editbrand'])){
    //value from checkbox
    $editbrand= $_GET['editbrand'];
  //store the value in the session variable status
  $_SESSION['editbrand']=$_GET['editbrand'];
  //redirect
  echo "<script>window.open('editbrand.php','_SELF')</script>";  
  }
  

//DELETE brand FROM DATABASE
if(isset($_GET['deletebrand'])){
    ///get the name
    $brand=$_GET['deletebrand'];
    //dlet query
    $delete="DELETE FROM brand where brand_title='$brand'";
    //run query
    $rundelete=mysqli_query($connection, $delete);
    if($rundelete){
        echo "<script>alert('$brand Brand deleted successfully')</script>";
        echo "<script>window.open('insertbrand.php','_SELF')</script>";
    }
}
?>