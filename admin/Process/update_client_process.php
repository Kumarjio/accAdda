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
	$update_new_client = $con->query("UPDATE `client_master` SET `client_name`='".$con->real_escape_string($_POST['client_name'])."',`client_contact_no`='".$con->real_escape_string($_POST['client_no'])."',`client_ac_type`='".$con->real_escape_string($_POST['client_ac_type'])."',`client_email`='".$con->real_escape_string($_POST['client_email'])."',`client_tin`='".$con->real_escape_string($_POST['clint_tin_no'])."',`client_cst`='".$con->real_escape_string($_POST['clint_cst_no'])."',`gst`= '".$con->real_escape_string($_POST['gst_no'])."',`state`= '".$con->real_escape_string($_POST['state_code'])."' ,`client_address`='".$con->real_escape_string($_POST['client_address'])."',`client_series`='".$con->real_escape_string($_POST['client_series'])."',`client_openingbal`='".$con->real_escape_string($_POST['client_opening_balance'])."',`client_opening_type`='".$con->real_escape_string($_POST['client_opening_type'])."',`client_termday`='".$con->real_escape_string($_POST['client_termday'])."' WHERE `client_id` = '".$_POST['id']."'");
		if($update_new_client)
		{
			$_SESSION['msg'] = 'Client Detail Successfully Updated';
			header('location:../manage_client.php');
			exit;
		}
}
?>