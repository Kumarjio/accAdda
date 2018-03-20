<?php 
include_once('admin/config/config.php');
unset($_SESSION['pass']);
header('location:lock.php');
exit;
 ?>