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
$editproduct=$_SESSION['editproduct'];
//select * from product based on the session
$selectproduct="select * from product where product_code='$editproduct'";
//run
$runselectproduct=mysqli_query($connection, $selectproduct);
//fetch
$fetchproduct=mysqli_fetch_array($runselectproduct);
//fetch the product items
$product_name=$fetchproduct['product_title'];
$product_price=$fetchproduct['product_price'];
$product_cat=$fetchproduct['product_cat'];
$product_brand=$fetchproduct['product_brand'];
$product_quantity=$fetchproduct['product_quantity'];
$product_description=$fetchproduct['product_descrption'];
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
        pcode=document.userform.code.value;
        ptitle=document.userform.title.value;
        pcategory=document.getElementById("category").options.selectedIndex;
        pbrand=document.getElementById("brand").options.selectedIndex;
        pquantity=document.userform.quantity.value;
        pprice=document.userform.price.value;
        pdesc=document.userform.description.value;
        pimage=document.userform.image.value;
        //product brand validation
        if(pcode==""){ //empty other name field
        alert("product code is a required field"); //error message
        document.getElementById("code").focus();
        return false;
        } 
        //product brand validation
        if(ptitle==""){ //empty other name field
        alert("product Title is a required field"); //error message
        document.getElementById("title").focus();
        return false;
        }
          //gender selection validation
        if(pcategory==0){//check if the gender is selected
        alert("The product category field must be selected"); //error message
        document.getElementById("category").focus();
        return false;
        }
        //marital status selection validation
        if(pbrand==0){//check if marital status is selected
        alert("The product brand field must be selected");//error message
        document.getElementById("brand").focus();
        return false;
        }
         //idnumber number validation
        if(isNaN(pquantity) || pquantity==""){ //check if the idnumber field is empty or interger
        alert("quantity field is a required field and must be integer"); //error message
        document.getElementById("quantity").focus();
        return false;
        }
         //idnumber number validation
         if(isNaN(pprice) || pprice==""){ //check if the idnumber field is empty or interger
        alert("price field is required and must be a number"); //error message
        document.getElementById("price").focus();
        return false;
        }
         //product brand validation
         if(pdesc==""){ //empty other name field
        alert("product description is a required field"); //error message
        document.getElementById("description").focus();
        return false;
        } 
        //product brand validation
        if(pimage==""){ //empty other name field
        alert("product Image is a required field"); //error message
        document.getElementById("image").focus();
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
      <h2>Product Management</h2>
      </center>
      <hr>
<!--insert product form-->
<br>

<form action="" style="border:1px solid #ccc" class="forms" method="post" name="userform" onsubmit="return inputvalidation()" enctype="multipart/form-data">
    <h2>Edit Product.</h2>
    <hr>
    <label  class="insertlabel"><b>Product Code</b></label><br>
    <input type="text" name="code" value="<?php echo $editproduct; ?>"  id="code" style="margin-left:30px;" class="insertinput" placeholder="product code"> <br>

    <label  class="insertlabel"><b>Product Name</b></label><br>
    <input type="text" name="title" id="title" value="<?php echo $product_name; ?>" style="margin-left:30px;" class="insertinput" placeholder="product title"> <br>

    <label class="insertlabel"><b>Product_Category</b></label><br>
    <select name="category" id="category" style="margin-left:30px; width:453px;"  readonly class="insertinput">
        <option value=""><?php echo $product_cat; ?></option>
        <!--fetch the category from database-->
            <?php
            $select_cat="select * from category"; //select from category table
            //run the select query
            $run_selectcat=mysqli_query($connection, $select_cat);
            //fetch field from category table
            while($fetch_cat=mysqli_fetch_array($run_selectcat)){
                    $category_id=$fetch_cat['cat_id'];//id
                    $category_title=$fetch_cat['cat_title'];
                    //display category name option
                    //note the id of the category is passed to the select query
                    //the category id is inserted into the database 
            echo "<option value='$category_title'>$category_title</option>"; 
            } //end of while loop
            ?>
    </select><br>

    <label class="insertlabel"><b>Product Brand</b></label><br>
    <select name="brand" id="brand" style="margin-left:30px; width:453px;" readonly class="insertinput">
        <option value=""><?php echo $product_brand; ?></option>
          <!--fetch the brand from database-->
                <?php
                $select_brand="select * from brand"; //select from category table
                //run the select query
                $run_selectbrand=mysqli_query($connection, $select_brand);
                //fetch field from category table
                while($fetch_brand=mysqli_fetch_array($run_selectbrand)){
                        $brand_id=$fetch_brand['brand_id'];//id
                        $brand_title=$fetch_brand['brand_title'];//
                        //display category name as option
                        //note the id of the brand is passed to the select query
                        //the brand id is inserted into the database 
                echo "<option value='$brand_title'>$brand_title</option>" ;  
                }

                ?>
    </select><br>

    <label class="insertlabel"><b>Quantity</b></label><br>
    <input type="text" name="quantity" value="<?php echo $product_quantity; ?>" id="quantity" placeholder="enter the product quantity" style="margin-left:30px;" class="insertinput"><br>

    <label  class="insertlabel"><b>Product unit price</b></label><br>
    <input type="text" name="price" id="price" value="<?php echo $product_price; ?>" placeholder="product unit price"  style="margin-left:30px;" class="insertinput"><br>

    <label class="insertlabel"><b>Product Description</b></label><br>
    <textarea name="description" id="description"  value="<?php echo $product_description; ?>" style="margin-left:30px;"  cols="400" rows="1" class="insertinput" placeholder="description goes here.."></textarea><br>

    <label class="insertlabel"><b>Product Image</b></label><br>
    <input type="file" name="image" id="image"  style="margin-left:30px;" class="insertinput"><br>

    <input type="submit" class="submitbutton" value="Edit Product" name="edit_product">
</form>
</div> 
</body>
</html>

<!-- INSERT INTO DATABASE TABLE PRODUCT QUERY-->
<?php
//if the submit button is clicked
if(isset($_POST['edit_product'])){
    //get the input name
    $code=$_POST['code'];
    $title=$_POST['title'];
    $category=$_POST['category'];
    $brands=$_POST['brand'];
    $price=$_POST['price'];
    $description=$_POST['description'];
    $quantity=$_POST['quantity'];
        // the image field name
    $productimage=$_FILES['image']['name'];
    $productimage_tmp=$_FILES['image']['tmp_name']; //temporary name for the image
    $folder="../assets/product_images/"; //folder to store the images
    move_uploaded_file($productimage_tmp, $folder.$productimage); //move the image to the created folder
        $insertproduct="UPDATE product SET 
        product_price='$price', product_quantity='$quantity', product_image='$productimage',
         product_descrption='$description' WHERE product_code='$editproduct'";
        //run insert query
        $runinsertproduct=mysqli_query($connection, $insertproduct);
        if($runinsertproduct){
            echo "<script>alert('product $title, Updated successfully.')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
    }


?>