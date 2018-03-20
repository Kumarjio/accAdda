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
	$add_new_tax = $con->query("UPDATE `tax_master` SET `tax_name`='".$con->real_escape_string($_POST['tax_name'])."',`st`='".$con->real_escape_string($_POST['st_no'])."' WHERE `tax_id` = '".$_POST['tax_id']."'");
		if($add_new_tax)
		{
			$_SESSION['msg'] = 'Tax Successfully Updated';
			header('location:../manage_tax.php');
			exit;
		}
}
?>