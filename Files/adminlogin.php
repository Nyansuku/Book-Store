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
  <script>
      function inputvalidation(){
        loginuser=document.userform.username.value;
        loginpassword=document.userform.loginpass.value;
        //first name validation
        if(loginuser=="" || loginuser.indexOf("@")==-1 || loginuser.indexOf(".")==-1){ //first name empty field
        alert("User email address is required in the correct format"); //error message
        document.getElementById("username").focus();
        return false;
        }
        //other name validation
        if(loginpassword==""){ //empty other name field
        alert("Password is a required field"); //error message
        document.getElementById("loginpass").focus();
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
<form action="" method="post" class="loginform" name="userform" onsubmit="return inputvalidation()">
    <div class="logintext">
        <h3>Admin Login</h3>
    </div><br><br>
    <label for="" >Email Address</label><br><br>
    <input type="text" name="username" id="username" placeholder="username"><br><br>
    <label for="">Password</label><br><br>
    <input type="password" name="loginpass" id="loginpass"><br><br><br>
    <input type="submit"  name="login" value="LOGIN"><br><br>
</form>


</div>
    
</body>
</html>


<!--LOGIN PHP SCRIPT-->
<?php 
if(isset($_POST['login'])){
    //fetch the form input values
    $user_email= $_POST["username"];
    $password = $_POST["loginpass"]; 

    $selectcust = "SELECT * FROM users where email_address='$user_email' AND user_password='$password'"; 
    $runselectcust = mysqli_query($connection, $selectcust);
    //count the customer
    $countcust = mysqli_num_rows($runselectcust);
    //fetch the table values
    $row=mysqli_fetch_array($runselectcust);
    //if the user exists
    $fullname=$row['fullname'];
    $emailadd=$row['email_address'];
    if ($countcust == 1){
            $_SESSION['adminlogin'] = true;
            $_SESSION['email'] = $row['email_address'];
            $_SESSION['fullname']=$row['fullname'];
            //display alert
            echo "<script>alert('$emailadd logged in Successfully')</script>";
            echo "<script>window.open('admin/index.php','_SELF')</script>";
    }
        else{
            echo "<script>alert('Failed to login')</script>";
        echo "<script>window.open('adminlogin.php','_SELF')</script>";
        }
    }  
?>