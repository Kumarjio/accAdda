<?php 
include_once('../config/config.php');
if(empty($_POST))
{
	$_SESSION['emsg'] = 'Please Add Information';
	header('location:../add_new_client.php');
	exit;
}
else
{
	$add_new_client = $con->query("INSERT INTO `client_master`(`client_name`, `client_contact_no`, `client_ac_type`, `client_email`, `client_tin`, `client_cst`,`gst`, `state`, `client_address`, `client_series`, `client_openingbal`, `client_opening_type`, `client_termday`, `client_created_by`) VALUES ('".$con->real_escape_string($_POST['client_name'])."','".$con->real_escape_string($_POST['client_no'])."','".$con->real_escape_string($_POST['client_ac_type'])."','".$con->real_escape_string($_POST['client_email'])."','".$con->real_escape_string($_POST['clint_tin_no'])."','".$con->real_escape_string($_POST['clint_cst_no'])."','".$con->real_escape_string($_POST['gst_no'])."','".$con->real_escape_string($_POST['state_code'])."','".$con->real_escape_string($_POST['client_address'])."','".$con->real_escape_string($_POST['client_series'])."','".$con->real_escape_string($_POST['client_opening_balance'])."','".$con->real_escape_string($_POST['client_opening_type'])."','".$con->real_escape_string($_POST['client_termday'])."','".$_SESSION['name']."')");
		if($add_new_client)
		{
			$_SESSION['msg'] = 'Client Successfully Added';
			header('location:../manage_client.php');
			exit;
		}
}
?>