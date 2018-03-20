<?php 
include_once("../config/config2.php");

$query = $con->query("UPDATE `state_code` SET  `name` = '".$_POST['name']."', `code` = '".$_POST['code']."' where id = '".$_POST['id']."' ");

if($query)
{
	header('location:../state_code.php');
	$_SESSION['msg'] = "State And State Code Successfully Updated";
	exit;
}
else
{
	header('location:../state_code.php');
	$_SESSION['emsg'] = "Somthing Went Wrong Please Try Again";
	exit;
}


 ?>