<?php 
include_once('../config/config.php');
if(empty($_POST))
{
	$_SESSION['emsg'] = 'Please Add Information';
	header('location:../manage_category.php');
	exit;
}
else
{

	$add_new_cat = $con->query("INSERT INTO `catagory_master`(`name`) VALUES ('".$con->real_escape_string($_POST['catagory_name'])."')");
		if($add_new_cat)
		{
			$_SESSION['msg'] = 'Category Successfully Added';
			header('location:../manage_category.php');
			exit;
		}
}
?>