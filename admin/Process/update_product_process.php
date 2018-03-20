<?php 
include_once('../config/config.php');
if(empty($_POST))
{
	$_SESSION['emsg'] = 'Please Add Information';
	header('location:../add_product.php');
	exit;
}
else
{
	$edit_product = $con->query("UPDATE `product_master` SET `product_name`='".$con->real_escape_string($_POST['product_name'])."',`HSN`='".$con->real_escape_string($_POST['hsn'])."' , `rate`= '".$con->real_escape_string($_POST['rate'])."', `product_unit`='".$con->real_escape_string($_POST['product_unit'])."',`product_size`='".$con->real_escape_string($_POST['product_size'])."',`product_catagory`='".$con->real_escape_string($_POST['product_catagory'])."',`product_desc`='".$con->real_escape_string($_POST['product_desc'])."' WHERE product_id='".$_POST['up_pr_id']."'");
		if($edit_product)
		{
			$_SESSION['msg'] = 'Product Successfully Updated';
			header('location:../manage_product.php');
			exit;
		}
}
?>