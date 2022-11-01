<?php 
include("function/function.php");
include("function/database.php");
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
         </div>
    <!--Navigation bar ends here-->
<hr>
<!--login page here-->
<form action="" method="post" class="loginform">
    <div class="logintext">
        <h3>Create New Password</h3>
    </div><br><br>
    <label for="" >Username</label><br><br>
    <input type="text" value="<?php echo $_SESSION['forgotusername']; ?>" name="username" placeholder="username"><br><br>
    <label for="">Password</label><br><br>
    <input type="password" name="pass" id="pass"><br><br>

    <label for="">Confirm Password</label><br><br>
    <input type="password" name="confirmpass" id="confirmpass"><br><br><br>

    <input type="submit"  name="newpass" value="Create New Password"><br><br>
</form>


</div>
    
</body>
</html>


<!--LOGIN PHP SCRIPT-->
<?php 
if(isset($_POST['newpass'])){
    //fetch the form input values
    $username = $_POST["username"];
    $password = $_POST["pass"];
    $cpassword = $_POST["confirmpass"];

    if($password == $cpassword){
        //hash password
        $hashed=md5($password);
        $updatepass="UPDATE customer set user_password='$hashed' where username='$username'";
        $runupdate=mysqli_query($connection, $updatepass);
        if($runupdate){
            //display alert
            echo "<script>alert('new password set successfully')</script>";
            echo "<script>window.open('login.php','_SELF')</script>"; 
        }
    }
    else{
         //display alert
         echo "<script>alert('failed to update')</script>";
         echo "<script>window.open('index.php','_SELF')</script>";
    }

   
    }  
?>