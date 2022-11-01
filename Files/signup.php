<?php 
include("function/function.php");
include("function/database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>Online Bookshop Store</title>
  <link rel="stylesheet" href="styles/style.css">
  <!--validation code-->
  <script>
      function inputvalidation(){
        firstname=document.userform.firstname.value;
        email=document.userform.email.value;
        phone=document.userform.phone.value;
        pass=document.userform.pass.value;
        confirmpass=document.userform.confirmpass.value;
         //password
         if(firstname==""){ //first name empty field
        alert("Full name is required"); //error message
        document.getElementById("firstname").focus();
        return false;
        }
         //password
         if(email=="" || email.indexOf("@")==-1 || email.indexOf(".")==-1){ 
        alert("email is required in the correct format"); //error message
        document.getElementById("email").focus();
        return false;
        }
         //password
         if(phone=="" || phone.length!=10){ //first name empty field
        alert("Phone is required and must be 10 characters"); //error message
        document.getElementById("phone").focus();
        return false;
        }
        
         //password
         if(pass=="" || pass.length<5){ //first name empty field
        alert(" Password is required and not less than 5 characters"); //error message
        document.getElementById("pass").focus();
        return false;
        }
        //password
        if(confirmpass=="" ||confirmpass.length<5){ //first name empty field
        alert(" Confirm Password is required and not less than 5 characters"); //error message
        document.getElementById("confirmpass").focus();
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
             <?php if($loggedin){?>
             <h3 style="margin-left:1000px;  margin-top:-15px; color:black;">Welcome Customer: <?php echo $fullname; ?></h3>
             <?php }?>
         </div>
    <!--Navigation bar ends here-->
<hr>
<!--login page here-->
<form action="" method="post" name="userform" onsubmit="return inputvalidation()" class="loginform">
    <div class="logintext">
        <h3>Signup Here</h3>
    </div><br><br>

    <label for="" >Full Name</label><br><br>
    <input type="text" name="firstname" id="firstname" placeholder="Fullname"><br><br>

    <label for="">Email Address</label><br><br>
    <input type="text" name="email" placeholder="email address" id="email"><br><br>

    <label for="">Phone Number</label><br><br>
    <input type="text" name="phone" placeholder="phone number" id="phone"><br><br>
    
    <label for="">Password</label><br><br>
    <input type="password" name="pass" id="pass"><br><br>

    <label for="">Confirm Password</label><br><br>
    <input type="password" name="confirmpass" id="confirmpass"><br><br><br>
    
    <input type="submit"  name="signup" value="CREATE NEW ACCOUNT"><br><br>

    <p style="font-size:20px; margin-left:10px;">Already Have An Account?<a href="login.php" style="text-decoration:none;"> Login Here</a> </p>
</form>
</div>
    <br><br></br>
</body>
</html>

<!-- PHP SIGNUP CODE-->
<?php
//if the signup button is clicked
if(isset($_POST['signup'])){
  $first = $_POST["firstname"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $password = $_POST["pass"];
  $cpassword = $_POST["confirmpass"];
    // Check whether this username exists
    $checkcustomer = "SELECT * FROM customer WHERE  email_address='$email'";
    $runcheckcustomer = mysqli_query($connection, $checkcustomer);
    $countcustomer = mysqli_num_rows($runcheckcustomer);
    if($countcustomer > 0){
        echo "<script>alert('User With The Same Credential already Exist')</script>";
        echo "<script>window.open('signup.php','_SELF')</script>";
    }
    else{
        //check the password and confirm password if the same
      if(($password == $cpassword)){
          //password encryption
          $hash = md5($password);
          //insert into table
          $insertcustomer = "INSERT INTO customer (fullname,email_address,user_password,phone_number) 
          VALUES ('$first', '$email','$hash', '$phone')";     
          $runinsert = mysqli_query($connection, $insertcustomer);
          if ($runinsert){
            echo "<script>alert('Account Created Successfully')</script>";
            echo "<script>window.open('login.php','_SELF')</script>";
          }
      }
      //if password do not match
      else{
        echo "<script>alert('Password Dont Match')</script>";
        echo "<script>window.open('signup.php','_SELF')</script>";
      }
    }
}
?>