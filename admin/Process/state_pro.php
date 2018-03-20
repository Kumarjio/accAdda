<?php 
include_once("../config/config2.php");

$query = $con->query("INSERT INTO `state_code`(`name`, `code`) VALUES ('".$_POST['name']."','".$_POST['code']."')");

if($query)
{
	header('location:../state_code.php');
	$_SESSION['msg'] = "State And State Code Successfully Added";
	exit;
}
else
{
	header('location:../state_code.php');
	$_SESSION['emsg'] = "Somthing Went Wrong Please Try Again";
	exit;
}


 ?>