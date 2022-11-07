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
  <script>
      function inputvalidation(){
        productbrands=document.userform.productbrand.value;
        //product brand validation
        if(productbrands==""){ //empty other name field
        alert("product brand is a required field"); //error message
        document.getElementById("productbrand").focus();
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
      <h2>Product Brand Management</h2>
      </center>
      <hr>
<!--insert product form-->
<br>

<form action="" style="border:1px solid #ccc" class="forms" method="post" name="userform" onsubmit="return inputvalidation()">
    <h2>Insert New Product Brand.</h2>
    <hr>
    <label  class="insertlabel"><b>Product Brand</b></label><br>
    <input type="text" name="productbrand" id="productbrand" style="margin-left:30px;" class="insertinput" placeholder="product title"> <br>

    <input type="submit" class="submitbutton" value="Add New brand" name="add_brand">
</form>


<!--DISPLAY THE PRODUCT BRANDS IN TABULAR FORMAT FOR EDITING-->
<table class="displaytable" style="width:800px;">
    <center><h1><i>Brand Management</i> </h1></center>
    <thead>
        <tr>
            <th>Brand ID</th>
            <th>Brand Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <!--SELECT FROM BRAND TABLE-->
    <?php
    $selectbrand="select * from brand";
    $runselectbrand=mysqli_query($connection, $selectbrand);
    $countbrand=mysqli_num_rows($runselectbrand);
        ?>
    <tbody>
        <?php
    //fetch values from the database table
        while($fetchbrand=mysqli_fetch_array($runselectbrand)){
        ?>
        <tr style="height:35px;">
            <td><?php echo $fetchbrand['brand_id']; ?></td>
            <td><?php echo $fetchbrand['brand_title']; ?></td>
            <td><a style=" font-weight:bold; text-align:center; color:black; text-decoration:none; padding:10px;" href="brandmanagement.php?editbrand=<?php echo $fetchbrand['brand_title'];  ?>" >Edit</a></td>
            <td><a style=" font-weight:bold; text-align:center; color:red; text-decoration:none; padding:10px;" href="brandmanagement.php?deletebrand=<?php echo $fetchbrand['brand_title'];  ?>" >Delete</a></td>
            
            </tr>
            <?php  } ?>
    </tbody>
</table>
<br><br><br>
</div> 
</body>
</html>

<!-- INSERT INTO DATABASE TABLE PRODUCT QUERY-->
<?php
//if the submit button is clicked
if(isset($_POST['add_brand'])){
    //get the input name
    $brandname=$_POST['productbrand'];
    //check if the brand exists
    $checkbrand="select * from brand where brand_title='$brandname'";
    $runcheckbrand=mysqli_query($connection, $checkbrand);
    //run the records in the database in relation to the title
    $countbrand=mysqli_num_rows($runcheckbrand);
    //if the product exist
    if($countbrand>0){
        echo "<script>alert('Sorry the product product; $brandname Exist in the database.')</script>";
        echo "<script>window.open('insertbrand.php','_self')</script>";
    }
    //if the product does not exist
    else{
        //insert product
        $insertbrand="INSERT INTO brand(brand_title) VALUES('$brandname')";
        //run insert query
        $runinsertbrand=mysqli_query($connection, $insertbrand);
        if($runinsertbrand){
            echo "<script>alert('brand $brandname, added successfully.')</script>";
            echo "<script>window.open('insertbrand.php','_self')</script>";
        }
    }
}


?>