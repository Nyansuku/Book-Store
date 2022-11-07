<?php
//start session
session_start();
//include database connection 
include('../function/database.php');

//EDIT BRAND
//REDIRECT USER TO EDIT brandPAGE
if(isset($_GET['editproduct'])){
    //value from checkbox
    $editbrand= $_GET['editproduct'];
  //store the value in the session variable status
  $_SESSION['editproduct']=$_GET['editproduct'];
  //redirect
  echo "<script>window.open('editproduct.php','_SELF')</script>";  
  }

  //REDIRECT USER TO EDIT brandPAGE
if(isset($_GET['editqua'])){
    //value from checkbox
    $editbrand= $_GET['editqua'];
  //store the value in the session variable status
  $_SESSION['editquantity']=$_GET['editqua'];
  //redirect
  echo "<script>window.open('editquantity.php','_SELF')</script>";  
  }

  

//DELETE product FROM DATABASE
if(isset($_GET['deleteproduct'])){
    ///get the name
    $product=$_GET['deleteproduct'];
    //dlet query
    $delete="DELETE FROM product where product_code='$product'";
    //run query
    $rundelete=mysqli_query($connection, $delete);
    if($rundelete){
        echo "<script>alert('$product product deleted successfully')</script>";
        echo "<script>window.open('index.php','_SELF')</script>";
    }
}
?>