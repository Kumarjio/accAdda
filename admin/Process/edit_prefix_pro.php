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
	$add_new_prefix = $con->query("UPDATE `prefix_master` SET `serial_name`='".$con->real_escape_string($_POST['serial_name'])."',`prefix_code`='".$con->real_escape_string($_POST['prefix_code'])."',`total_page`='".$con->real_escape_string($_POST['t_p_invoice'])."' WHERE `prefix_id`='".$_POST['pre_up_id']."'");
		if($add_new_prefix)
		{
			$_SESSION['msg'] = 'Prefix Successfully Updated';
			header('location:../manage_prefix.php');
			exit;
		}
}
?>