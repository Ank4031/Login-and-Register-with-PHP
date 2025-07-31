<?php
session_start();
session_start();
if(!(isset($_SESSION['login']))){
    header("Location: loginPage.php");
    exit();
}
session_unset(); // Clear all session variables
session_destroy(); // Destroy session on server
header("Location: loginPage.php");
exit();
