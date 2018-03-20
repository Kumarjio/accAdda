<?php include_once('admin/config/config2.php'); 
session_unset();
session_destroy();
header('location:index.php');
?>