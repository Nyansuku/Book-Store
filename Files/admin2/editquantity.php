<?php 
include("../function/function.php");
include("../function/database.php");
$productid= $_SESSION['editquantity'];
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
//select product using the product code
$select="select * from product where product_code='$productid'";
$run=mysqli_query($connection, $select);
$fetch=mysqli_fetch_array($run);
$product_name=$fetch['product_title'];
$product_quantity=$fetch['product_quantity'];
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
        productquantity=document.userform.qua.value;
        //product brandquantity validation
        if(isNaN(productquantity) || productquantity=="")
               { //empty other name field
                   alert("please input product quantity in Numbers"); //error message
                   document.getElementById("qua").focus();
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
      <h2>Edit Product Quantity</h2>
      </center>
      <hr>
<!--insert product form-->
<br>

<form action="" style="border:1px solid #ccc" class="forms" method="post" name="userform" onsubmit="return inputvalidation()">
    <h2>Edit Product Brands.</h2>
    <hr>
    <label  class="insertlabel"><b>Product Code</b></label><br>
    <input type="text" name="productbrand" value="<?php echo $productid;?>" readonly  style="margin-left:30px;" class="insertinput"> <br>
    <label  class="insertlabel"><b>Product Name</b></label><br>
    <input type="text" name="productbrand" value="<?php echo $product_name;?>" readonly  style="margin-left:30px;" class="insertinput"> <br>

    <label  class="insertlabel"><b>Update Product Quantity</b></label><br>
    <input type="text" name="qua"  id="qua" style="margin-left:30px;" class="insertinput" placeholder="product quantity"> <br>
    <input type="submit" class="submitbutton" value="edit Quantity" name="edit_qua">
</form>


<br><br><br>
</div> 
</body>
</html>

<!-- INSERT INTO DATABASE TABLE PRODUCT QUERY-->
<?php
//if the submit button is clicked
if(isset($_POST['edit_qua'])){
    //get the input name
    //value
    $quantity=$_POST['qua'];
    //edit query
    $new_quantity=$product_quantity +$quantity;
    $editbrand="UPDATE product SET product_quantity='$new_quantity' where product_code= '$productid'";
    //run edit
    $runeditbrand=mysqli_query($connection, $editbrand);
    if($runeditbrand){
        echo "<script>alert('product Successfully updated')</script>";
        echo "<script>window.open('index.php','_SELF')</script>";
    }
    else{
        echo "<script>alert('Failed to update product quantity')</script>";
        echo "<script>window.open('index.php','_SELF')</script>"; 
    }
}


?>