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
	$add_new_unit = $con->query("UPDATE `unit_master` SET `unit_name`='".$con->real_escape_string($_POST['unit_name'])."' WHERE `unit_id` = '".$_POST['unit_id']."'");
		if($add_new_unit)
		{
			$_SESSION['msg'] = 'Unit Successfully Updated';
			header('location:../add_unit.php');
			exit;
		}
}
?>