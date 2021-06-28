<?php
session_start();
include('includes/adminDbConnect.php');
if($con)
{
     //echo '<script>alert("DB connected.")</script>';
    // echo "Database Connected";
}
else
{
     //echo '<script>alert("db not done.")</script>';
      //echo "Database not Connected";
    //header("Location: includes/adminDbConnect.php");
}

if(!isset($_SESSION['username']) && session_status() == PHP_SESSION_ACTIVE)
{
    session_destroy();
    header('Location: login.php');
    exit;
}
?>