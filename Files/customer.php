<?php 
include("function/function.php");
include("function/database.php");
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    $loggedin= true;
    $userId = $_SESSION['userId'];
  }
  else{
    $loggedin = false;
    $userId = 0;
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
<!-- call the add to cart function -->
<?php addcart(); ?>
<div class="shopping_cart">
            
<form action="search_result.php" name="search" method="post" >
    <input type="text" style="width:350px; height:30px; margin-bottom:10px; margin-top:-10px; margin-left:130px; border-radius:30px;" placeholder="search here">
    <input type="submit" name="search" value="search product">
</form>
<span style="float:right; margin-top:-40px; font-size:20px; margin-right:50px;">Welcome <?php echo $_SESSION['fullname']; ?>: Cart <span style="font-weight:bold;"> <?php totalproduct_cart(); ?></span> products total cost Value: Go to Cart</span>

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
            <?php getproduct(); ?>
            <!--get product category wise-->
            <?php getproduct_category(); ?>
            <!--get product brand wise-->
            <?php getproduct_brand(); ?>
        </div>
    </div>
</div>
<div class="footer">
    <hr>
    Footer section</div>
</div> 
</body>
</html>