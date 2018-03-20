<?php 
include_once('../config/config.php');
if(empty($_POST))
{
	$_SESSION['emsg'] = 'Please Add Information';
	header('location:../add_unit.php');
	exit;
}
else
{
	$add_new_unit = $con->query("INSERT INTO `unit_master`(`unit_name`) VALUES ('".$con->real_escape_string($_POST['unit_name'])."')");
		if($add_new_unit)
		{
			$_SESSION['msg'] = 'Unit Successfully Added';
			header('location:../add_unit.php');
			exit;
		}
}
?>