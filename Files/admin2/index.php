<?php 
include("../function/function.php");
include("../function/database.php");
$value=1;
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
//search button
if(isset($_POST['search_customer'])){
    
    $search_customer=$_POST['search_customer'];
    //use the customer name placed to search
    $search="select * from product where (product_code like '%$search_customer%') || (product_title like '%$search_customer%') ";
    $runsearch=mysqli_query($connection, $search);

}
else{
   
    $search="select * from product";
    $runsearch=mysqli_query($connection, $search);
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
      <h2>All Products</h2>
      </center>
      <hr>
<!--insert product form-->
<br>


<!--DISPLAY THE PRODUCT BRANDS IN TABULAR FORMAT FOR EDITING-->
<table class="displaytable" style="width:1000px;">
    <center><h1><i>Product Management</i> </h1></center>
    <center>
    <form action="" method="post">
    <label for="" style="font-size:20px;">Search Product Code or Name</label><br>
          <input type="text" name="search_customer" style="width:250px; margin-top:10px; height:30px;" placeholder="Search by Product Code or Name">
    </form>
    <br><br>
    </center>
    <thead>
        <tr>
            <th>number</th>
            <th>product Code</th>
            <th>Image</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <!--SELECT FROM BRAND TABLE-->
    <tbody>
        <?php
    //fetch values from the database table
        while($fetchproduct=mysqli_fetch_array($runsearch)){
            $proimage=$fetchproduct['product_image'];
        ?>
        <tr style="height:35px;">
            <td><?php echo $value; ?></td>
            <td><?php echo $fetchproduct['product_code']; ?></td>
            <td><?php echo "<img src='../assets/product_images/$proimage' style='width:80px; height:80px;'>"; ?></td>
            <td><?php echo $fetchproduct['product_title']; ?></td>
            <td><?php echo $fetchproduct['product_cat']; ?></td>
            <td><?php echo $fetchproduct['product_brand']; ?></td>
            <td><?php echo '$'. $fetchproduct['product_price']; ?></td>
            <td><?php echo $fetchproduct['product_quantity']; ?></td>

            <td><a style=" font-weight:bold; text-align:center; color:black; text-decoration:none; padding:10px;" href="promanagement.php?editproduct=<?php echo $fetchproduct['product_code'];  ?>" >Edit</a></td>
            <td><a style=" font-weight:bold; text-align:center; color:red; text-decoration:none; padding:10px;" href="promanagement.php?deleteproduct=<?php echo $fetchproduct['product_code'];  ?>" >Delete</a></td>
            
            </tr>
            <?php $value++; } ?>
    </tbody>
</table>
<br><br><br>
</div> 
</body>
</html>

