<?php
//start session
session_start();
//include database connection 
include('../function/database.php');

//EDIT CATEGORY
//REDIRECT USER TO EDIT CAT PAGE
if(isset($_GET['editcat'])){
    //value from checkbox
    $editcategory= $_GET['editcat'];
  //store the value in the session variable status
  $_SESSION['editcat']=$_GET['editcat'];
  //redirect
  echo "<script>window.open('editcat.php','_self')</script>";  
  }
  
//DELETE CATEGORY FROM DATABASE
if(isset($_GET['deletecat'])){
    ///get the name
    $category=$_GET['deletecat'];
    //dlet query
    $delete="DELETE FROM category where cat_title='$category'";
    //run query
    $rundelete=mysqli_query($connection, $delete);
    if($rundelete){
        echo "<script>alert('$category category deleted successfully')</script>";
        echo "<script>window.open('insertcat.php','_SELF')</script>";
    }
}
?>