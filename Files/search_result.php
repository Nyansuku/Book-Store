<?php 
include("function/function.php");
include("function/database.php");
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
<div class="shopping_cart">
            
<form action="search_result.php" method="POST">
    <input type="text" name="searchkeyword" style="width:350px; height:30px; margin-bottom:10px; margin-top:-10px; margin-left:130px; border-radius:30px;" placeholder="search here">
    <input type="submit" name="search" value="search product">
</form>
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
           <?php
           //if th search button is clicked
           if(isset($_POST['search'])){
               //get the input field name
               $keyword=$_POST['searchkeyword'];
               //search from table column based on the keyword search value
               //concat function is used to combine all the columns as parameters
        $getproduct="SELECT * FROM product WHERE CONCAT(product_title, product_brand, product_cat, product_price) LIKE '%$keyword%'";//select 6 random products for display
        $rungetproduct=mysqli_query($connection, $getproduct);
            //count products based on category
    $countsearch=mysqli_num_rows($rungetproduct);
    if($countsearch==0){
        echo "<h2 style='margin-top:100px; margin-bottom:100px; font-style:italic;'>Sorry,No record Found.</h2>";
 //terminate and continue with execution
    } 
        //use while loop to get the record in a array like format
        while($fetch_product=mysqli_fetch_array($rungetproduct)){
        $pro_id=$fetch_product['product_id'];
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
        <p style='font-size:20px;'> <b> Price: $$pro_price</b></p>
        <a href='index.php?add_cart=$pro_id'><button style='float:left; border-radius: none; padding:6px;'>Add to Cart</button></a>
        </div>
        ";
}   
           } 
           ?>
        </div>
    </div>
</div>
<div class="footer">
    <hr>
    Footer section</div>
</div> 
</body>
</html>