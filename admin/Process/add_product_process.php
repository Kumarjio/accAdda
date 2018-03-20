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
	$add_new_product = $con->query("INSERT INTO `product_master` (`product_name`,  `HSN`, `rate`,`product_unit`, `product_size`, `product_catagory`, `product_desc`) VALUES ('".$con->real_escape_string($_POST['product_name'])."','".$con->real_escape_string($_POST['hsn'])."','".$con->real_escape_string($_POST['rate'])."','".$con->real_escape_string($_POST['product_unit'])."','".$con->real_escape_string($_POST['product_size'])."','".$con->real_escape_string($_POST['product_catagory'])."','".$con->real_escape_string($_POST['product_desc'])."')");
		if($add_new_product)
		{
			$_SESSION['msg'] = 'Product Successfully Added';
			header('location:../manage_product.php');
			exit;
		}
}
?>