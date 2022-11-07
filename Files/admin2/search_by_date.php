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
      margin-left:30px;
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
                 <li><a href="customermanagement.php">Users</a></li>
                 <li><a href="orders.php">Orders</a></li>
                 <li><a href="delivery.php">Delivery</a></li>
                 <li><a href="logout.php">Logout</a></li>
             </ul>
             <h3 style="margin-left:1100px; margin-top:-28px; color:black;">Welcome Admin:<br> <?php echo $adminname; ?></h3>
         </div>
    <!--Navigation bar ends here-->
<hr>
<center>
      <center><h2><a href="orders.php">Orders Management</a>  | <a href="order_filter.php">Filter Order List</a></h3></center>
      </center>
      <hr>
<!--insert product form-->
<br>
<div class="mainrow">
    <div class="rowdivision">
      <?php
      $select4="select * from orders";
      $run4=mysqli_query($connection, $select4);
      $count4=mysqli_num_rows($run4);
      ?>
      <h2 style="margin-top:10px; margin-left:20px;">All Orders</h2>
      <h1 style="margin-top:-35px; margin-left:280px;"><?php echo $count4; ?></h1>
      <p style="margin-top:15px; margin-left:100px;"><a href="orders.php" style="text-decoration:none; color:red; font-size:20px;">Click To View</a></p>
    </div>
    <div class="rowdivision">
      <?php
      $today_date=date('Y-m-d');
      $select3="select * from orders where week(ordered_date)=week(now());";
      $run3=mysqli_query($connection, $select3);
      $count3=mysqli_num_rows($run3);
      ?>
      <h2 style="margin-top:10px; margin-left:20px;">This Week</h2>
      <h1 style="margin-top:-35px; margin-left:300px;"><?php echo $count3; ?></h1>
      <p style="margin-top:15px; margin-left:100px;"><a href="thisweek.php" style="text-decoration:none; color:red; font-size:20px;"> Click To View</a></p>
    </div>
    
    <div class="rowdivision">
      <?php
      $this_month=date('m');
      $select2="select * from orders where MONTH(ordered_date)='$this_month'";
      $run2=mysqli_query($connection, $select2);
      $count2=mysqli_num_rows($run2);
      ?>
      <h2 style="margin-top:10px; margin-left:20px;">This Month</h2>
      <h1 style="margin-top:-35px; margin-left:280px;"><?php echo $count2; ?></h1>
      <p style="margin-top:15px; margin-left:100px;"><a href="thismonth.php" style=" text-decoration:none; color:red; font-size:20px;">Click To View</a></p>
    </div>
     
    </div>
    <br><br><br>

<!--DISPLAY THE PRODUCT BRANDS IN TABULAR FORMAT FOR EDITING-->
<br><br>
    <center><h2><i>Search By Date</i> </h2><br>
    <form method="post" >
    <table width="700px;">
      <tr>
        <td>
          <label for="" style="font-size:20px;">Day</label><br>
          <select name="day" style="width:200px;" id="day"> 
	            <option disabled> Select Day</option>
		            <?php 
                 for($i = 1 ;
                    $i <= 31; 
                     $i++){
                        echo "<option value='$i'>$i</option>";
                        }
                    ?>
	             </select>
        </td>
        <td>
        <label for="" style="font-size:20px;">Month</label><br>
        <select style="width:200px;" name="month" id="month">
                        <option disabled>Select MONTH</option>
                        <option value ='01'> JANUARY </option>
                        <option value ='02'> FEBRUARY </option>
                        <option value ='03'> MARCH </option>
                        <option value ='04'> APRIL </option>
                        <option value ='05'> MAY </option>
                        <option value ='06'> JUNE </option>
                        <option value ='07'> JULY </option>
                        <option value ='08'> AUGUST </option>
                        <option value ='09'> SEPTEMBER </option>
                        <option value ='10'> OCTOBER </option>
                        <option value ='11'> NOVEMBER </option>
                        <option value ='12'> DECEMBER </option>
                                </select>
        </td>
        <td>
        <label for="" style="font-size:20px;">Year</label><br>
        <select name="year" style="width:200px;" id="year"> 
	            <option disabled> Select Year</option>
		            <?php 
                 for($i = 2020;
                 $i <= date('Y');
                     $i++){
                        echo "<option value='$i'>$i</option>";
                        }
                    ?>
	             </select>
        </td>
      </tr>
      </table>
      <input type="submit" name="search" value="search orders" style="margin-top:20px; font-size:20px; width:200px;">
    <br><br>
</form>
</center>
<?php
if(isset($_POST['search'])){
$day=$_POST['day'];
$month=$_POST['month'];
$year=$_POST['year'];

//select
$selectorders="select * from orders where YEAR(ordered_date)='$year' AND MONTH(ordered_date)='$month' AND DAY(ordered_date)='$day'";
$run=mysqli_query($connection, $selectorders);
$countnum=mysqli_num_rows($run);
?>
<table class="displaytable" style="width:1000px;">
    <thead>
        <tr>
            <th>OrderID</th>
            <th>Order Date</th>
            <th>Total Price</th>
            <th>Order status</th>
            <th>Rider</th>
            <th>View Order</th>
            
        </tr>
    </thead>
<?php
    while($fetchorders=mysqli_fetch_array($run)){?>
    <tbody>
       <tr style="height:35px;">
            <td><?php echo $fetchorders['order_id']; ?></td>
            <td><?php echo $fetchorders['ordered_date']; ?></td>
            <td><?php echo $fetchorders['totalprice']; ;?></td>
            <td><?php echo $fetchorders['order_status']; ?></td>
            <td><a style=" font-weight:bold; text-align:center; padding:10px;" href="ordermanagement.php?allocaterider=<?php echo $fetchorders['order_id']; ?>" >Add Rider</a></td>
            <td><a style=" font-weight:bold; text-align:center; color:black; padding:10px;" href="ordermanagement.php?vieworder=<?php echo $fetchorders['order_id']; ?>" >View Order Information</a></td>
            
        </tr>
    </tbody>
    <?php
}
}
?>
</table>


<br><br><br>
</div> 
</body>
</html>
