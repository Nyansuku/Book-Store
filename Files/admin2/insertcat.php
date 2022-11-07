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
      <h2>Product Category Management</h2>
</center>
      <hr>
<!--insert product form-->
<br>

<form action="" style="border:1px solid #ccc" class="forms" method="post" name="userform" onsubmit="return inputvalidation()">
    <h2>Insert New Product category.</h2>
    <hr>
    <label  class="insertlabel"><b>Product Category</b></label><br>
    <input type="text" name="productcat" id="productcat" style="margin-left:30px;" class="insertinput" placeholder="product category"> <br>

    <input type="submit" class="submitbutton" value="Add New Category" name="add_category">
</form>


<!--DISPLAY THE PRODUCT BRANDS IN TABULAR FORMAT FOR EDITING-->
<table class="displaytable" style="width:800px;">
    <center><h1><i>Category Management</i> </h1></center>
    <thead>
        <tr>
            <th>Category ID</th>
            <th>Category Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <!--SELECT FROM BRAND TABLE-->
    <?php
    $selectcat="select * from category";
    $runselectcat=mysqli_query($connection, $selectcat);
    $countcat=mysqli_num_rows($runselectcat);
        ?>
    <tbody>
        <?php
    //fetch values from the database table
        while($fetchcat=mysqli_fetch_array($runselectcat)){
        ?>
       <tr style="height:35px;">
            <td><?php echo $fetchcat['cat_id']; ?></td>
            <td><?php echo $fetchcat['cat_title']; ?></td>
            <td><a style=" font-weight:bold; text-align:center; color:black; text-decoration:none; padding:10px;" href="catmanagement.php?editcat=<?php echo $fetchcat['cat_title'];  ?>" >Edit</a></td>
            <td><a style=" font-weight:bold; text-align:center; color:red; text-decoration:none; padding:10px;" href="catmanagement.php?deletecat=<?php echo $fetchcat['cat_title'];  ?>" >Delete</a></td>
            
            </tr>
            <?php  } ?>
    </tbody>
</table>
<br><br><br>
</div> 
</body>
</html>
<!-- INSERT INTO DATABASE TABLE PRODUCT QUERY-->
<?php
//if the submit button is clicked
if(isset($_POST['add_category'])){
    //get the input name
    $catname=$_POST['productcat'];
    //check if the brand exists
    $checkcat="select * from category where cat_title='$catname'";
    $runcheckcat=mysqli_query($connection, $checkcat);
    //run the records in the database in relation to the title
    $countcat=mysqli_num_rows($runcheckcat);
    //if the product exist
    if($countcat>0){
        echo "<script>alert('Sorry the product product; $catname Exist in the database.')</script>";
        echo "<script>window.open('insertcat.php','_self')</script>";
    }
    //if the product does not exist
    else{
        //insert product
        $insertcat="INSERT INTO category(cat_title) VALUES('$catname')";
        //run insert query
        $runinsertcat=mysqli_query($connection, $insertcat);
        if($runinsertcat){
            echo "<script>alert('category $catname, added successfully.')</script>";
            echo "<script>window.open('insertcat.php','_self')</script>";
        }
    }
}


?>