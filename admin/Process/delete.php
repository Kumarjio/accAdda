<?php
include_once('../config/config2.php');
//  for delete client
if(isset($_GET['client_d_id']))
{
	$del_client = $con->query("UPDATE `client_master` set dflag = '1' WHERE `client_id` = '".$_GET['client_d_id']."'");
	if($del_client)
	{
		$_SESSION['msg'] = 'Client Successfully Deleted';
		header('location:../manage_client.php');
		exit;
	}
}
//  for delete client

//  for delete product
if(isset($_GET['project_d_id']))
{
	$del_product = $con->query("UPDATE `product_master` SET `flag`= '1' WHERE `product_id` = '".$_GET['project_d_id']."'");
	if($del_product)
	{
		header("location:../manage_product.php");
		$_SESSION['msg'] = 'Product Successfully Deleted';
		exit;
	}
} 
//  for delete product
 
//  for delete project
 if(isset($_GET['pro_del_id']))
{
	$del_project = $con->query("UPDATE `project_master` SET `flag`= '1' WHERE `project_id` = '".$_GET['pro_del_id']."'");
	if($del_project)
	{
		$_SESSION['msg'] = 'Project Successfully Deleted';
		header('location:../manage_project.php');
		exit;
	}
} 
//  for delete project 

//  for delete category
  if(isset($_GET['del_cat_id']))
{
	$del_category = $con->query("DELETE FROM `catagory_master` WHERE `catagory_id` = '".$_GET['del_cat_id']."'");
	if($del_category)
	{
		$_SESSION['msg'] = 'Category Successfully Deleted';
		header('location:../manage_category.php');
		exit;
	}
} 
//  for delete category 

//  for delete prefix
if(isset($_GET['del_prefix_id']))
{
	$del_pre = $con->query("DELETE FROM `prefix_master` WHERE `prefix_id` = '".$_GET['del_prefix_id']."'");
	if($del_pre)
	{
		$_SESSION['msg'] = 'Prefix Successfully Deleted';
		header('location:../manage_prefix.php');
		exit;
	}
} 
//  for delete prefix 

//  for delete tax 
if(isset($_GET['del_tax_id']))
{
	$del_tax = $con->query("DELETE FROM `tax_master` WHERE `tax_id` = '".$_GET['del_tax_id']."'");
	if($del_tax)
	{
		$_SESSION['msg'] = 'Tax Successfully Deleted';
		header('location:../manage_tax.php');
		exit;
	}
} 
//  for delete tax 

//  for delete company
 if(isset($_GET['del_com_id']))
{
	$del_com = $con->query("UPDATE `company_mas` SET `flag`= '1' WHERE `company_id` = '".$_GET['del_com_id']."'");
	if($del_com)
	{
		$_SESSION['msg'] = 'Company Successfully Deleted';
		header('location:../manage_company.php');
		exit;
	}
} 
//  for delete company 
//  for delete unit
  if(isset($_GET['del_unit_id']))
{
	$del_com = $con->query("DELETE FROM `unit_master` WHERE `unit_id` = '".$_GET['del_unit_id']."'");
	if($del_com)
	{
		$_SESSION['msg'] = 'Unit Successfully Deleted';
		header('location:../add_unit.php');
		exit;
	}
} 
//  for delete unit 
//  for delete user
   if(isset($_GET['user_d_id']))
{
	$del_user = $con->query("UPDATE `user_master` SET `df` = '1' WHERE `user_master_id` = '".$_GET['user_d_id']."'");
	if($del_user)
	{
		$_SESSION['msg'] = 'User Successfully Deleted';
		header('location:../manage_user.php');
		exit;
	}
} 
//  for delete user 


if(isset($_GET['year_d_id']))
{
	$del_year = $con->query("DELETE FROM `financial_year_master` WHERE `financial_id` = '".$_GET['year_d_id']."'");
	if($del_year)
	{
		$_SESSION['msg'] = 'Year Successfully Deleted';
		header('location:../add_database.php');
		exit;
	}
}


if(isset($_GET['purchase_invoice_del']))
{	
	$del_invoice = $conn->query("UPDATE `purchase_mst` SET `usage_flag`='1' WHERE `s_id` = '".$_GET['purchase_invoice_del']."'");
	if($del_invoice)
	{
		$_SESSION['msg'] = 'Invoice Successfully Deleted';
		header('location:../manage_purchase_invoice.php');
		exit;
	}
}

if(isset($_GET['del_chalan_id']))
{	
	$del_chalan = $conn->query("UPDATE `quatation_mst` SET `billbookno` = '1' WHERE `s_id` = '".$_GET['del_chalan_id']."'");
	if($del_chalan)
	{
		$_SESSION['msg'] = 'Chalan Successfully Deleted';
		header('location:../ViewChallan.php');
		exit;
	}
}

if(isset($_GET['del_qu_id']))
{	
	$del_qu = $conn->query("UPDATE `n_quat_mst` SET `usage_flag`= '1' WHERE s_id = '".$_GET['del_qu_id']."' ");
	if($del_qu)
	{
		$_SESSION['msg'] = 'Quatation Successfully Deleted';
		header('location:../ViewQuatation.php');
		exit;
	}
}

if(isset($_GET['sales_invoice_del']))
{
	$del_sal = $conn->query("UPDATE `sales_mst` SET `df`= '1' WHERE s_id = '".$_GET['sales_invoice_del']."' ");
	if($del_sal)
	{
		$_SESSION['msg'] = 'Sales Invoice Successfully Deleted';
		header('location:../manage_sales_invoice.php');
		exit;
	}
}


if( isset($_GET['sal_re_invoice_del']) )
{
	$sel_re_as = $conn->query("UPDATE `sales_return_mst` SET `df`= '1' WHERE id = '".$_GET['sal_re_invoice_del']."'");
	if($sel_re_as)
	{
		$_SESSION['msg'] = 'Sales Return Invoice Successfully Deleted';
		header('location:../view_salesreturn_invoice.php');
		exit;
	}
}

if( isset($_GET['del_pu_re_id']) )
{
	$selaa_re_as = $conn->query("UPDATE `purchase_return_mst` SET `flag`= '1' WHERE id = '".$_GET['del_pu_re_id']."'");
	if($selaa_re_as)
	{
		$_SESSION['msg'] = 'Purchase Return Invoice Successfully Deleted';
		header('location:../view_return_invoice.php');
		exit;
	}
}

if( isset($_GET['del_payment_id']) )
{
	$selaa_pay_as = $conn->query("UPDATE `payment_mst` SET `df`= '1' WHERE id = '".$_GET['del_payment_id']."'");
	if($selaa_pay_as)
	{
		$_SESSION['msg'] = 'Payment Detail Successfully Deleted';
		header('location:../ManagePayment.php');
		exit;
	}
}

if( isset($_GET['del_receipt_id']) )
{
	$selaa_pay_as = $conn->query("UPDATE `reciept_mst` SET `df`= '1' WHERE id = '".$_GET['del_receipt_id']."'");
	if($selaa_pay_as)
	{
		$_SESSION['msg'] = 'Receipt Detail Successfully Deleted';
		header('location:../ManageReciept.php');
		exit;
	}
}

?>