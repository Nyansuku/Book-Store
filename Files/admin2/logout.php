<?php

session_start();
echo "Logging you out. Please wait...";
unset($_SESSION['adminlogin']);
unset($_SESSION["email"]);
// session_unset();
// session_destroy();
header("location:../index.php");
?>