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
  <style>
      .mainrow{
      width:100%;
    }
    .rowdivision{
      width:24%;
      margin-left:50px;
      float:left;
      height:80px;
      background-color:#e4ddf4;
    }
  </style>
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
      <center><h2><a href="orders.php">Orders Management</a></h3></center>
      </center>
      <hr>

<!--DISPLAY THE PRODUCT BRANDS IN TABULAR FORMAT FOR EDITING-->
    <center><h2><i>Orders List</i> </h2><br>
</center>
<table class="displaytable" style="width:1000px;">
    <thead>
        <tr>
            <th>OrderID</th>
            <th>Order Date</th>
            <th>Customer  Email</th>
            <th>Total Price</th>
            <th>Order status</th>
            <th>View Order</th>
            
        </tr>
    </thead>
    <!--SELECT FROM BRAND TABLE-->
    <?php
    $today_date=date('Y-m-d');
    $value=1;
    $selectorder="select * from orders";
    $runselectorder=mysqli_query($connection, $selectorder);
        ?>
    <tbody>
        <?php
    //fetch values from the database table
        while($fetchorder=mysqli_fetch_array($runselectorder)){
          $rider= $fetchorder['rider_email'];
          $customer=$fetchorder['customer_email'];
          $selectrider="select * from distributor where email_address='$rider'";
          $run5=mysqli_query($connection, $selectrider);
          $fetchrider=mysqli_fetch_array($run5);
          //fetch custmomer
          $selectcust="select * from customer where email_address='$customer'";
          $run6=mysqli_query($connection, $selectcust);
          $fetchcust=mysqli_fetch_array($run6);

        ?>
       <tr style="height:35px;">
            <td><?php echo $fetchorder['order_id']; ?></td>
            <td><?php echo $fetchorder['ordered_date']; ?></td>
            <td><?php echo $fetchcust['email_address']; ?></td>
            <td><?php echo $fetchorder['totalprice']; ;?></td>
            <td><?php echo $fetchorder['order_status']; ?></td>
            <td><a style=" font-weight:bold; text-align:center; color:black; padding:10px;" href="ordermanagement.php?vieworder=<?php echo $fetchorder['order_id']; ?>" >View Order Information</a></td>
            
        </tr>
            <?php } ?>
    </tbody>
</table>
<br><br><br>
</div> 
</body>
</html>
