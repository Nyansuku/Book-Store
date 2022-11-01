<?php 
include("function/function.php");
include("function/database.php");
//if the logging session are created
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    $loggedin= true;
    $emailadd=$_SESSION['email'];
    $fullname=$_SESSION['fullname'];
  }
  else{
    $loggedin = false;
    $emailadd= 0;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Bookshop Store</title>
  <link rel="stylesheet" href="styles/style.css">
</head>
<body>
  
<!--wrapper starts here-->
<div class="main_wrapper">
    <!--header starts here-->
    <div class="header_wrapper" style="margin-bottom:100px;">
    <img src="assets/logo.png"  style="width:200px; height:150px;">
         <h1 id="logo" style="margin-top:-100px; margin-left:-650px;">Stationery Chapchap</h1> 
    </div>
    <!--header ends here-->

    <!--naviagtion bar start here-->
    <div class="menubar">
             <ul id ="menu">
                 <li><a href="index.php">Home</a></li>
                 <li><a href="all_product.php">All products</a></li>
                 <?php if($loggedin){
                    echo "
                 <li><a href='viewCart.php'>View Cart</a></li>
                 <li><a href='myorders.php'>My Orders</a></li>
                 <li><a href='logout.php'>Logout</a></li>
                    ";
                 } 
                 else{
                    echo "
                    <li><a href='login.php'>Login</a></li>
                    ";
                 }
                 
                 ?>
             </ul>
             <?php if($loggedin){?>
             <h3 style="margin-left:1000px;  margin-top:-15px; color:black;">Welcome Customer: <?php echo $fullname; ?></h3>
             <?php }?>
         </div>
    <!--Navigation bar ends here-->
<hr>
<div style="background-color:white; height:50px; width:1200px; margin:auto;">
    <h1 style="line-height:50px;">
        <center>
            MY ORDERS
        </center>
    </h1>
    
</div>
<br>

<table style="width:800px; margin:auto;" class="displaytable">
    <thead style="line-height:40px;">
        <tr>
        <th>Order Id</th>					
        <th>Order Date</th>
        <th>Status</th>						
        <th>Items</th>
            <!-- <th>Update</th> -->
        </tr>
    </thead>
    <tr>
    <tbody>
        
                    <?php
                        $orders = "SELECT * FROM orders WHERE customer_email= '$emailadd'";
                        $result = mysqli_query($connection, $orders);
                        $counter = 0;
                        while($row = mysqli_fetch_array($result)){
                            $orderId = $row['order_id'];
                            $email= $row['customer_email'];
                            $name = $row['customer_name'];
                            $phone = $row['phone'];
                            $amount = $row['totalprice'];
                            $address=$row['address'];
                            $orderDate = $row['ordered_date'];
                            $paymentMode = $row['payment_mode'];
                            $orderStatus = $row['order_status'];
                        ?>
                            <tr style="height:40px;">
                                    <td> <?php echo $orderId; ?></td>
                                    <td><?php echo $orderDate; ?></td>
                                    <td>
                                         
            <form action="" method="POST">
                <br>
                    <select name="statuss" id="statuss" style=" margin-left:30px; height:30px; width:100px;">
                        <option value="<?php echo $orderStatus; ?>"><?php echo $orderStatus; ?></option>
                        <option value="Received">Received</option>
                        </select><br><br>
                <input type="hidden"  name="updatecode" value="<?php echo $orderId;?>">
                <input type="submit"  name="updatestatus"  value="update Status" style="margin-left:30px; font-weight:bold; color: rgb(4, 99, 99); padding:5px;" >
                <br><br>
    </form>
                                    </td>
                                    <td>
                                    <button><a style=" font-weight:bold; color: rgb(4, 99, 99); text-decoration:none; padding:10px;" href="function/cartmanagement.php?vieworders=<?php echo $orderId?>" >View Orders</a></button>
                                    </td>
                                    
                            </tr>
                                <?php } ?>
                </tbody>
</table>
<br><br>
                </div>
</body>
</html>
<?php
if(isset($_POST['updatestatus'])){
    $value=$_POST['statuss'];
    $codes=$_POST['updatecode'];
    //select from orders
    $select="SELECT * from orders where order_id='$codes'";
    $run=mysqli_query($connection, $select);
    $fetch=mysqli_fetch_array($run);
    $stats=$fetch['order_status'];
    //if the status is received dont update
    if($stats == "Received"){
        echo "<script>alert('Failed; Order already activated')</script>";
        echo "<script>window.open('myorders.php','_self')</script>";
    }
    //else change status to received
    else{
    //update table
    $update="update orders set order_status='$value' where order_id='$codes' and  customer_email='$emailadd'";
    $runupdate=mysqli_query($connection, $update);
    if($runupdate){
        echo "<script>alert('Status Updated Successfully')</script>";
        echo "<script>window.open('myorders.php','_self')</script>";
    }
}   
}
?>