<?php 
include("function/function.php");
include("function/database.php");
$orderid=$_SESSION['order'];
//select using the id
$select_order="SELECT * from orders where order_id='$orderid'";
$run=mysqli_query($connection, $select_order);
$fetch1=mysqli_fetch_array($run);
$date=$fetch1['ordered_date'];
$cust_name=$fetch1['customer_name'];
$mode=$fetch1['payment_mode'];
$phone=$fetch1['phone'];
$total=$fetch1['totalprice'];
$status=$fetch1['order_status'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div style="margin-top:70px;"></div>
    <center> 
        <div style=" margin:auto; width:800px; border:4px solid #7395AE; border-radius:20px;">
        <div > <h2 style="margin-left:-550px;">Stationery Chapchap</h2>
        <h2>Hello  <?php echo $cust_name; ?></h2>
        <p> <b style="font-size:20px;"><?php echo $status; ?></b> successfully</p>
    </div>
    <hr>
 <p style="margin-left:-30px;">Order Date  <span style="margin-left:100px;">Order Number</span>    <span style="margin-left:100px;">Payment Method </span>      <span style="margin-left:100px;">Reciever Phone Number </span></p>
<b><p style="margin-left:-80px;"><?php echo $date; ?>  <span style="margin-left:100px;"><?php echo $orderid; ?></span>    <span style="margin-left:100px !important;"><?php echo $mode; ?></span>      <span style="margin-left:150px;"><?php echo $phone; ?> </span></p></b> 
    <hr>
    <div>
        <p style="margin-left:-500px;">
        <?php 
$select_item="SELECT * from orderitem where order_id='$orderid'";
$runitem=mysqli_query($connection, $select_item);
while ($fetch2=mysqli_fetch_array($runitem)){
$productcode=$fetch2['product_code'];
$productquantity=$fetch2['quantity'];
$pprice=$fetch2['totalprice'];
//select from product
$select_product="SELECT * from product where product_code='$productcode'";
$runproduct=mysqli_query($connection, $select_product);
$fetch3=mysqli_fetch_array($runproduct);
$title=$fetch3['product_title'];
$image=$fetch3['product_image'];
        ?>
        <?php echo "<img src='assets/product_images/$image' style='width:80px; margin-right:10px; height:80px;'>"; ?>
       <span style="margin-top:-100px;">Product Name: <?php echo $title; ?></span> <br>
        Qty: <?php echo $productquantity; ?><br> 
        Price: <?php echo $pprice; ?>
        <br><br>
        <?php  } ?>
</p>
    </div>

    <h3 style="margin-left:500px;">Total Price: <?php echo $total; ?> </h3>

    <hr>

        <h3><a href="myorders.php" style="color:black; text-decoration:none;">GO BACK TO MY ORDERS PAGE</a></h3>
        </div>
</center>
   
</body>
</html>