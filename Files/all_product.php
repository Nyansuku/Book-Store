<?php 
include("function/function.php");
include("function/database.php");
//if the logging session are created
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;
  $emailadd =$_SESSION['email'];
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
                 <li><a href='viewcart.php'>View Cart</a></li>
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
<!-- call the add to cart function -->
<?php //addcart(); ?>
<div class="shopping_cart">
            
<form action="search_result.php" name="search" method="post" >
    <input type="text" name="searchkeyword" style="width:350px; height:30px; margin-bottom:10px; margin-top:-10px; margin-left:130px; border-radius:30px;" placeholder="search here">
    <input type="submit" name="search" value="search product">
</form>
<!--SELECT FROM CART TABLE -->
<?php
 $countcart = "SELECT * FROM cart WHERE customer_email='$emailadd'"; 
 $countresult = mysqli_query($connection, $countcart);
 $count= mysqli_num_rows($countresult);      
 if(!$count) {
   $count = 0;
 }
if($loggedin){
    ?>
    <span style="float:right; margin-top:-40px; font-size:20px; margin-right:50px;">Welcome <?php echo $fullname; ?>:  Cart <span style="font-weight:bold;"> <?php echo $count; ?></span> products <a href="viewcart.php">Go to Cart</a> </span>
<?php
}
?>
            </div>
    <!--content wrapper starts-->
<div class="content_wrapper">
    <div class="sidebar">
        <div class="sidebartitle">
            <h3>Product Category</h3>
        </div>
        <ul class="cats">
        <?php get_category(); ?>
        </ul>
        <div class="sidebartitle">
            <h3>Product Brands</h3>
        </div>
        <ul class="cats">
        <?php get_brand(); ?>
      
        </ul>
    </div>
    
    <!--end of sidebar-->
    <div class="content_area" >
        
        <br>
        <div id="product_box">
            <!--get all products-->
            <?php 
    if(!isset($_GET['cats'])){
        if(!isset($_GET['brands'])){
    global $connection;
    $getproduct="SELECT * FROM product";//select 6 random products for display
    $rungetproduct=mysqli_query($connection, $getproduct);
    //use while loop to get the record in a array like format
    while($fetch_product=mysqli_fetch_array($rungetproduct)){
            $pro_id=$fetch_product['product_id'];
            $pro_code=$fetch_product['product_code'];
            $pro_title=$fetch_product['product_title'];
            $pro_cat=$fetch_product['product_cat'];
            $pro_brand=$fetch_product['product_brand'];
            $pro_price=$fetch_product['product_price'];
            $pro_image=$fetch_product['product_image'];

            //display the data to the frontend
            echo "
            <div id='single_product'>
            <h3 style='font-size:20px; font-style:italic;'> $pro_title</h3><br>
            <img src='assets/product_images/$pro_image' width='200px' height='180px' />
            <br>
            <p style='font-size:20px;'> <b> Price: $$pro_price</b></p><br>";
            if($loggedin){
                $quaSql = "SELECT * FROM cart WHERE product_code='$pro_code' AND customer_email='$emailadd'";
                $quaresult = mysqli_query($connection, $quaSql);
                $quaExistRows = mysqli_num_rows($quaresult);
                if($quaExistRows == 0) {
                    echo "<form action='function/cartmanagement.php' method='POST'>
                          <input type='hidden' name='addcode' value='".$pro_code. "'>
                          <button type='submit' name='addToCart' style='float:left; border-radius: none; padding:6px;'>Add to Cart</button>
                          </form>";
                }
                //if item in cart
                else {
                    echo "<a href='viewCart.php'><button style='float:left; border-radius: none; padding:6px;'>Go to Cart</button>'</a>";
                }
            }
            //if not logged in
            else{
                echo "<a href='login.php'><button style='float:left; border-radius: none; padding:6px;'>Add To Cart</button>'</a>";
            }
            echo "</div>";
    }    
}
}
            ?>
            <!--end of get all products-->
            <!--GET PRODUCT BASED ON CATEGORY-->
            <?php
             //IF THE CATEGORY IS CLICKED
    if(isset($_GET['cats'])){
        $cats_id=$_GET['cats'];
    global $connection;
    $getcategory="SELECT * FROM product where product_cat='$cats_id'";//select 6 from product table based on the category clicked
    $rungetcategory=mysqli_query($connection, $getcategory);
    //count products based on category
    $countproduct_category=mysqli_num_rows($rungetcategory);
    if($countproduct_category==0){
        echo "<h2 style='margin-top:100px; margin-bottom:100px; font-style:italic;'>Sorry, there is no record of product associated with the category.</h2>";
 //terminate and continue with execution
    } 
    //use while loop to get the record in a array like format
    while($fetch_category=mysqli_fetch_array($rungetcategory)){
            $pro_id=$fetch_category['product_id'];
            $pro_code=$fetch_category['product_code'];
            $pro_title=$fetch_category['product_title'];
            $pro_cat=$fetch_category['product_cat'];
            $pro_brand=$fetch_category['product_brand'];
            $pro_price=$fetch_category['product_price'];
            $pro_image=$fetch_category['product_image'];

            //display the data to the frontend
            echo "
            <div id='single_product'>
            <h3 style='font-size:20px; font-style:italic;'> $pro_title</h3><br>
            <img src='assets/product_images/$pro_image' width='200px' height='180px' />
            <br>
            <p style='font-size:20px;'> <b>Price: $$pro_price</b></p><br>";
            if($loggedin){
                $quaSql = "SELECT * FROM cart WHERE product_code='$pro_code' AND customer_email='$emailadd'";
                $quaresult = mysqli_query($connection, $quaSql);
                $quaExistRows = mysqli_num_rows($quaresult);
                if($quaExistRows == 0) {
                    echo "<form action='function/cartmanagement.php' method='POST'>
                          <input type='hidden' name='addcode' value='".$pro_code. "'>
                          <button type='submit' name='addToCart' style='float:left; border-radius: none; padding:6px;'>Add to Cart</button>
                          </form>";
                }
                //if item in cart
                else {
                    echo "<a href='viewCart.php'><button style='float:left; border-radius: none; padding:6px;'>Go to Cart</button>'</a>";
                }
            }
            //if not logged in
            else{
                echo "<a href='login.php'><button style='float:left; border-radius: none; padding:6px;'>Add To Cart</button>'</a>";
            }
            echo "</div>";
    }    
}
            ?>
            <!--end of get product by category-->
            <!--get PRODUCT BASED ON BRAND-->
            <?php 
            
                //if category section is not clicked
    if(isset($_GET['brands'])){
        $brands_id=$_GET['brands'];
    global $connection;
    $getbrand="SELECT * FROM product where product_brand='$brands_id'";//select  from product table based on the brand clicked
    $rungetbrand=mysqli_query($connection, $getbrand);
    //count products based on brands
    $countproduct_brand=mysqli_num_rows($rungetbrand);
    if($countproduct_brand==0){
        echo "<h2 style='margin-top:100px; margin-bottom:100px; font-style:italic;'>Sorry, there is no record of product associated with the brand.</h2>";
 //terminate and continue with execution
    }  
    //use while loop to get the record in a array like format
    while($fetch_brand=mysqli_fetch_array($rungetbrand)){
            $pro_id=$fetch_brand['product_id'];
            $pro_code=$fetch_brand['product_code'];
            $pro_title=$fetch_brand['product_title'];
            $pro_cat=$fetch_brand['product_cat'];
            $pro_brand=$fetch_brand['product_brand'];
            $pro_price=$fetch_brand['product_price'];
            $pro_image=$fetch_brand['product_image'];

            //display the data to the frontend
            echo "
            <div id='single_product'>
            <h3 style='font-size:20px; font-style:italic;'> $pro_title</h3><br>
            <img src='assets/product_images/$pro_image' width='200px' height='180px' />
            <br>
            <p style='font-size:20px;'> <b>Price: $ $pro_price</b></p><br>";
            if($loggedin){
                $quaSql = "SELECT * FROM cart WHERE product_code='$pro_code' AND customer_email='$emailadd'";
                $quaresult = mysqli_query($connection, $quaSql);
                $quaExistRows = mysqli_num_rows($quaresult);
                if($quaExistRows == 0) {
                    echo "<form action='function/cartmanagement.php' method='POST'>
                          <input type='hidden' name='addcode' value='".$pro_code. "'>
                          <button type='submit' name='addToCart' style='float:left; border-radius: none; padding:6px;'>Add to Cart</button>
                          </form>";
                }
                //if item in cart
                else {
                    echo "<a href='viewCart.php'><button style='float:left; border-radius: none; padding:6px;'>Go to Cart</button>'</a>";
                }
            }
            //if not logged in
            else{
                echo "<a href='login.php'><button style='float:left; border-radius: none; padding:6px;'>Add To Cart</button>'</a>";
            }
            echo "</div>";
    }     
}
            ?>
            <!--END OF GET PRODUCTS BASED ON THE BRAND-->
        </div>
    </div>
</div>
<div class="footer" style="color:white; text-align:center; margin-bottom:20px; font-size:20px;">
    <hr>
<p style="line-height:40px;" >Copyright © 2022 || <a href="adminlogin.php" style="color:white;">Admin Login</a></p>
</div> 
</div> 
</body>
</html>