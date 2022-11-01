<?php

session_start();
echo "Logging you out. Please wait...";
unset($_SESSION["loggedin"]);
unset($_SESSION["email"]);
unset($_SESSION["UserId"]);

// session_unset();
// session_destroy();

header("location:index.php");
?>