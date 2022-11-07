<?php 
include("../function/function.php");
include("../function/database.php");
//if the logging session are created
if(isset($_SESSION['adminlogin']) &&  $_SESSION['adminlogin']=true){
  $adminlogin= true;
  $adminemail =$_SESSION['email'];
  $adminname=$_SESSION['fullname'];
}
else{
  $adminlogin = false;
  $adminemail= 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Bookshop Store</title>
  <link rel="stylesheet" href="../styles/style.css">
  <script>
      function inputvalidation(){
        productcats=document.userform.productcat.value;
        //product brand validation
        if(productcats==""){ //empty other name field
        alert("product category is a required field"); //error message
        document.getElementById("productcat").focus();
        return false;
        } 
      }
  </script>
</head>
<body>
  
<!--wrapper starts here-->
<div class="main_wrapper">
    <!--header starts here-->
    <div class="header_wrapper">
        <center>
        <h1 id="logo">Stationery Chapchap</h1> 
        </center>
        
    </div>
    <!--header ends here-->

    <!--naviagtion bar start here-->
    <div class="menubar">
    <ul id ="menu">
                 <li><a href="index.php">Home</a></li>
                 <li><a href="insertbrand.php">Brands</a></li>
                 <li><a href="insertcat.php">Categories</a></li>
                 <li><a href="insert_product.php">Products</a></li>
                 <li><a href="orders.php">Orders</a></li>
                 <li><a href="logout.php">Logout</a></li>
             </ul>
             <h3 style="margin-left:1100px; margin-top:-28px; color:black;">Welcome Admin:<br> <?php echo $adminname; ?></h3>
         </div>
    <!--Navigation bar ends here-->
<hr>
<center>
      <h2>Edit Product Category</h2>
</center>
      <hr>
<!--insert product form-->
<br>

<form action="" style="border:1px solid #ccc" class="forms" method="post" name="userform" onsubmit="return inputvalidation()">
    <h2>Edit Category.</h2>
    <hr>
    <label  class="insertlabel"><b>Product Category</b></label><br>
    <input type="text" name="productcat" placeholder="<?php echo $_SESSION['editcat'];?>" id="productcat" style="margin-left:30px;" class="insertinput"> <br>

    <input type="submit" class="submitbutton" value=" edit Category" name="edit_category">
</form>

<br><br><br>
</div> 
</body>
</html>
<!-- INSERT INTO DATABASE TABLE PRODUCT QUERY-->
<?php
//if the submit button is clicked
if(isset($_POST['edit_category'])){
    //get the input name
    //value
    $value=$_SESSION['editcat'];
    $catname=$_POST['productcat'];
    //edit query
    $editcat="UPDATE category SET cat_title='$catname' where cat_title= '$value'";
    //run edit
    $runeditcat=mysqli_query($connection, $editcat);
    if($runeditcat){
        echo "<script>alert('Product category updated successfuly')</script>";
        echo "<script>window.open('insertcat.php','_SELF')</script>";
    }
    else{
        echo "<script>alert('Failed to update category')</script>";
        echo "<script>window.open('insertcat.php','_SELF')</script>"; 
    }
   
}


?>