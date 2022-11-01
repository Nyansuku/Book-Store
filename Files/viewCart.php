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
<div style="background-color:white; height:50px; width:1000px; margin:auto;">
    <h1 style="line-height:50px;">
        <center>
            MY CART
        </center>
    </h1>
</div>
<br><br>
<table style="width:1000px; margin:auto;" class="displaytable">
    <thead style="line-height:40px;">
        <tr>
            <th>Ref</th>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Total Cost</th>
            <!-- <th>Update</th> -->
            <th>
                <!--remove all from cart based on the email address-->
             <button><a style=" font-weight:bold; color: rgb(4, 99, 99); text-decoration:none; padding:10px;" href="function/cartmanagement.php?removecart_all=<?php echo $emailadd?>" >Remove All</a></button>
            </th>
        </tr>
    </thead>
    <?php
    $sql = "SELECT * FROM cart WHERE customer_email= '$emailadd'";
    $result = mysqli_query($connection, $sql);
    $countc=mysqli_num_rows($result);
    $value = 0; //numbering
    $totalPrice = 0; //total price value
    $subtotal=0;//total grand price
    ?>
    <td colspan="12">
           <h2><center>
               Cart Items <?php echo $countc; ?>
           </center></h2>
       </td>
       <?php
    //fetch from the product table in relation to the cart table
    while($fetchcart = mysqli_fetch_assoc($result)){
        //fetch the product code
        $pcode = $fetchcart['product_code'];
        $Qty = $fetchcart['quantity'];
        //make the quantity value a session
        $_SESSION['quantity']=$Qty;
        //use the product code to fetch the product price from the product table
        $selectpro = "SELECT * FROM product WHERE product_code= '$pcode'";
        $runselectpro = mysqli_query($connection, $selectpro);
        $fetchpro = mysqli_fetch_assoc($runselectpro); //fetch from product tabel in relation to the code
        $productname = $fetchpro['product_title']; //product name
        $productprice = $fetchpro['product_price']; //product price
        $productimage=$fetchpro['product_image'];
        $total=$productprice*$Qty;
        $value++;
        $subtotal=$subtotal+$total;
        //session the total price
        $_SESSION['grandtotal']=$subtotal;
    ?>
<tr>
       
   </tr>
    <tbody style="line-height:40px;" >
         <tr>
            <td><?php echo $value; ?> </td>
            <td><img src="assets/product_images/<?php echo $productimage;?>" style="width:100px; height:80px;" alt=""></td>
            <td><?php echo $productname ;?></td>
            <td><?php  echo $productprice; ?></td>
            <td>
           
            <form action="" method="GET">
                <input type="text" style="width:35px; margin-left:30px;" name="quantity" value="<?php echo $Qty; ?>" ><br>
                <input type="hidden"  name="updatecode" value="<?php echo $pcode;?>">
                <input type="submit"  name="update_cart"  value="update quantity" style="font-weight:bold; color: rgb(4, 99, 99); padding:5px;" >
    </form>

            </td>
            <td> <?php echo  $total; ?></td>
            <!-- <td>
                <button style=" border:none; text-decoration:none; background-color:#7395AE; padding:5px; color:white;" name="update_cart" type="submit">Update </button>
            </td> -->
            <td> <button><a style=" font-weight:bold; color: rgb(4, 99, 99); text-decoration:none; padding:10px;" href="function/cartmanagement.php?removecart=<?php echo $pcode?>" >Remove</a></button> </td>
            </tr>
        <?php }?>
       <tr>
           <td colspan="12">
               <h2 style="text-align:center; color:red;">Grand Total Price KSH: <?php echo $subtotal; ?></h2>
           </td>
       </tr>
                        </tbody>
</table>
    </form>
<br><br>
<div style="margin-bottom:50px;">
<a href="index.php" style="float:left; margin-left:230px; text-decoration:none;">
        <h2>Continue shopping</h2>
    </a>
    <a href="checkout.php" style="float:right; margin-right:230px; margin-top:-10px; text-decoration:none;">
        <h2>Proceed to Checkout</h2>
    </a>
</div>
                </div>
</body>
</html>
<?php

if(isset($_GET['update_cart'])){
    $code=$_GET['updatecode'];
    $cartq=$_GET['quantity'];
    // // //select the product code
    // $selectcode="select * from product where the product_code='$code'";
    // $run=mysqli_query($connection, $selectcode);
    // $fetch=mysqli_fetch_array($run);
    // $fetchqua=$fetch['product_quantity'];
    // if($fetchqua<$cartq){
    //     echo "<script>alert('The ordered Quantity')</script>";
    //     echo "<script>window.open('viewCart.php','_SELF')</script>";

    // }
    //update
    $updateq="update cart set quantity='$cartq' where customer_email='$emailadd' and product_code='$code';";
    $runupdatecart=mysqli_query($connection,$updateq);
    if($runupdatecart){
        echo "<script>window.open('viewCart.php','_SELF')</script>";
    }
}
?>
