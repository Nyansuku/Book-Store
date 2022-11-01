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
  <script>
     function inputvalidation(){
        cphone=document.userform.phone.value;
        caddress=document.userform.address.value;
        czip=document.userform.zipcode.value;
        //first name validation
        if(isNaN(cphone) || cphone==""){ //first name empty field
        alert("phone is a required field and must a number"); //error message
        document.getElementById("phone").focus();
        return false;
        }
        if(cphone.length!=10){ //empty other name field
        alert("Phone number must be 10 character long"); //error message
        document.getElementById("phone").focus();
        return false;
        }
        //other name validation
        if(caddress==""){ //empty other name field
        alert("address is a required field"); //error message
        document.getElementById("address").focus();
        return false;
        }
        //other name validation
        if(czip==""){ //empty other name field
        alert("zipcode is a required field"); //error message
        document.getElementById("zipcode").focus();
        return false;
        }
     }
 </script>
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
<div style="background-color:white; height:50px; width:500px; margin:auto;">
    <h1 style="line-height:50px;">
        <center>
            Order Summary
        </center>
    </h1>
</div>
<br><br>
<form  class="checkout" method="POST" action="function/cartmanagement.php" style="width:500px; margin:auto" name="userform" onsubmit="return inputvalidation()">
    <label style="font-size:18px; margin-left:50px;"> Grand Total Price</label><br><br>
    <input name="total" id="total" style="margin-left:50px; height:25px; width:385px;padding:5px;  border-bottom:2px solid black;" type="text" readonly value="<?php echo $_SESSION['grandtotal']; ?>"><br><br>
    <input style="margin-left:50px; height:25px; width:385px;padding:5px;  border-bottom:2px solid black;"  value="<?php echo $emailadd; ?>" type="hidden" readonly name="emailaddress" id="emailaddress">
    <label style="font-size:18px; margin-left:50px;"> Payment Method</label><br><br>
    <input style="margin-left:150px;" type="radio" name="paymentmode" id="paymentmode" value="Cash on Delivery" checked>
    <label for="">Cash On Delivery</label><br><br>
    <input style="margin-left:150px;"type="radio" value="Online Payment" name="paymentmode" id="paymentmode" disabled>
    <label for="">Online Payment</label><br><br>
    <label style="font-size:18px; margin-left:50px;">Please Enter Your Phone Number</label><br><br>
    <input style="margin-left:50px; height:25px; width:385px;padding:5px;  border-bottom:2px solid black;" type="text" placeholder="Phone Number" name="phone" id="phone"><br><br>
    <label style="font-size:18px; margin-left:50px;">Please Enter Your Delivery Address</label><br><br>
    <input style="margin-left:50px; height:25px; width:385px;padding:5px;  border-bottom:2px solid black;"  placeholder=" enter the delivery address" type="text" name="address" id="address"><br><br>
    <label style="font-size:18px; margin-left:50px;">Please Enter Your Address Zipcode</label><br><br>
    <input style="margin-left:50px; height:25px; width:385px;padding:5px;  border-bottom:2px solid black;" placeholder="Enter the Zipcode" type="text" name="zipcode" id="zipcode"><br><br>
    <input type="submit" name="checkout" id="checkout" value="Place Order" style="padding:10px; width:150px; font-size:18px; background-color:red; color:white; margin-left:300px;">

    <a href="viewCart.php" style="margin-left:400px; text-decoration:none;">
        <h2>Go Back</h2>
    </a>
</form>
<br><br>
<div style="margin-bottom:50px;">

</div>
                </div>
</body>
</html>