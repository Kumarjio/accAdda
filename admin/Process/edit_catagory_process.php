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

	$add_new_cat = $con->query("update `catagory_master` set `name`='".$con->real_escape_string($_POST['catagory_name'])."' where catagory_id = '".$_POST['cat_id']."'");
		if($add_new_cat)
		{
			$_SESSION['msg'] = 'Category Successfully Updated';
			header('location:../manage_category.php');
			exit;
		}
}
?>