<?php 
include_once('../config/config.php');
if(empty($_POST))
{
	$_SESSION['emsg'] = 'Please Add Information';
	header('location:../manage_tax.php');
	exit;
}
else
{
	$add_new_tax = $con->query("INSERT INTO `tax_master`(`tax_name`, `st`) VALUES ('".$con->real_escape_string($_POST['tax_name'])."','".$con->real_escape_string($_POST['st_no'])."')");
		if($add_new_tax)
		{
			$_SESSION['msg'] = 'Tax Successfully Added';
			header('location:../manage_tax.php');
			exit;
		}
}
?>