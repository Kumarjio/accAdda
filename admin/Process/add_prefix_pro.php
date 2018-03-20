<?php 
include_once('../config/config.php');
if(empty($_POST))
{
	$_SESSION['emsg'] = 'Please Add Information';
	header('location:../manage_prefix.php');
	exit;
}
else
{
	$add_new_prefix = $con->query("INSERT INTO `prefix_master`(`serial_name`, `prefix_code`, `total_page`) VALUES ('".$con->real_escape_string($_POST['serial_name'])."','".$con->real_escape_string($_POST['prefix_code'])."','".$con->real_escape_string($_POST['t_p_invoice'])."')");
		if($add_new_prefix)
		{
			$_SESSION['msg'] = 'Prefix Successfully Added';
			header('location:../manage_prefix.php');
			exit;
		}
}
?>