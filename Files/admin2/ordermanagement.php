<?php
include("../function/function.php");
include("../function/database.php");
//Allocate  rider
if(isset($_GET['allocaterider'])){
    ///get the name
    $rider=$_GET['allocaterider'];
    $_SESSION['loggedin'] = $rider;
    //check if the order has a rider
    $selectrider="select * from orders where order_id='$rider'";
    $run=mysqli_query($connection, $selectrider);
    $fetch=mysqli_fetch_array($run);
    $riderinfo=$fetch['rider_email'];
    if(empty($riderinfo)){
        echo "<script>window.open('addrider.php','_SELF')</script>";
    }
    else{
        echo "<script>alert('Order already allocated a rider $riderinfo.')</script>";
        echo "<script>window.open('orders.php','_self')</script>";
    }
        
}

//View order information
if(isset($_GET['vieworder'])){
    ///get the order id
    $orders=$_GET['vieworder'];
    $_SESSION['vieworder'] = $orders;
        echo "<script>window.open('vieworder.php','_SELF')</script>";
}
?>