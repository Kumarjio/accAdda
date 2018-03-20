<?php
include_once('../config/config2.php');
$total = 0;
$subtotal = 0;
$cgst = 0; $sgst = 0; $igst = 0;
if(!empty($_POST['freight'])){ $freight = floatval ($_POST['freight']); }else{ $freight = 0; }
$company = $con->query("select * from company_mas where company_id = '".$_SESSION['company_id']."'")->fetch_object();
$client_detail = $con->query("select * from client_master where client_id = '".$_POST['for_pre_client_id']."'")->fetch_object();
if( $company->state === $client_detail->state )
{
	foreach($_POST['product_name'] as $index => $val) {
		if(!empty($_POST["quntity"][$index]) || !empty($_POST["price"][$index]))
		{	$subtotal += $_POST["quntity"][$index] * $_POST["price"][$index];	}
		
		$id = $_POST["id"][$index];
		$prodct = $con->query("select * from product_master where product_id = '".$id."'")->fetch_object();
		$sub = floatval($_POST["quntity"][$index]) * floatval($_POST["price"][$index]) ;
		$subcgst = floatval($sub) * floatval( $prodct->rate ) / 100 ;
		$cgst += floatval($subcgst) / 2;
		$sgst += floatval($subcgst) / 2;
		$total += $sub + $subcgst;
	}
	$total += $freight;
}
else if($company->state != $client_detail->state)
{
	foreach($_POST['product_name'] as $index => $val) {
		if(!empty($_POST["quntity"][$index]) || !empty($_POST["price"][$index]))
		{	$subtotal += $_POST["quntity"][$index] * $_POST["price"][$index];	}
		
		$id = $_POST["id"][$index];
		$prodct = $con->query("select * from product_master where product_id = '".$id."'")->fetch_object();
		$sub = floatval($_POST["quntity"][$index]) * floatval($_POST["price"][$index]) ;
		$subcgst = floatval($sub) * floatval( $prodct->rate ) / 100 ;
		$igst += floatval($subcgst);
		$total += $sub + $subcgst;
	}
	$total += $freight;
}


$add_chalan = $conn->query("UPDATE `purchase_mst` SET 
`prj_id`='".$_POST['project_name']."',
`ch_no`='".$_POST['ch_no']."',
`ch_date`='".$_POST['ch_date']."',
`transport`='".$_POST['transport_name']."',
`due_date`='".$_POST['due_date']."',
`from`='".$_POST['good_dispatch_from']."',
`to`='".$_POST['good_dispatch_to']."',
`cgst`='".$cgst."',
`sgst`='".$sgst."',
`igst`='".$igst."',
`freight`='".$freight."',
`total_amt`='".$total."',
`remark`='".$_POST['remark']."',
`agnst`='".$_POST['Against_Form']."',
`u_id`='".$_SESSION['id']."',
`c_id`='".$_SESSION['company_id']."' WHERE s_id = '".$_POST['s_id_u']."'");


$jurnal = $conn->query("UPDATE `journal_mst` SET `d1`='2',`d2`='4',`d3`='5',`d4`='6',`d5`='7',`db1`='".$subtotal."',
`db2`='".$freight."',`db3`='".$cgst."',`db4`='".$sgst."',`db5`='".$igst."',`c1`= '".$_POST["for_pre_client_id"]."', `cr1` = '".$total."',
`u_id` = '".$_SESSION['id']."' , `c_id` = '".$_SESSION["company_id"]."' , `remark` = '".$_POST['remark']."' ,`prj_id` = '".$_POST['project_name']."' where `inv_id`= '".$_POST['qa_no']."' " );


$ac = $conn->query("UPDATE `".$client_detail->client_ac_type."` SET 
`credit_amt`='".$subtotal."',`u_id`='".$_SESSION['id']."',`c_id`='".$_SESSION['company_id']."' WHERE `inv_id`='".$_POST['qa_no']."' and `credit_name`='2'");


$acinv = $conn->query("UPDATE `23` SET `debit_amt`='".$subtotal."',
`u_id`='".$_SESSION['id']."',`c_id`='".$_SESSION['company_id']."' WHERE `inv_id`='".$_POST['qa_no']."'");

if($freight != '0')
{
		$fr = $conn->query("UPDATE `".$client_detail->client_ac_type."` SET 
		`credit_amt`='".$freight."',`u_id`='".$_SESSION['id']."',`c_id`='".$_SESSION['company_id']."' WHERE `inv_id`='".$_POST['qa_no']."' and `credit_name`='4' ");
		
		$frinv = $conn->query("UPDATE `9` SET `debit_amt`='".$freight."',
		`u_id`='".$_SESSION['id']."',`c_id`='".$_SESSION['company_id']."' WHERE `inv_id`='".$_POST['qa_no']."'");
}	

if($cgst != '0')
{
		$cgst_q = $conn->query("UPDATE `".$client_detail->client_ac_type."` SET 
		`credit_amt`='".$cgst."',`u_id`='".$_SESSION['id']."',`c_id`='".$_SESSION['company_id']."' WHERE `inv_id`='".$_POST['qa_no']."' and `credit_name`='5'");
		
		$cgst_qinv = $conn->query("UPDATE `11` SET `debit_amt`='".$cgst."',
		`u_id`='".$_SESSION['id']."',`c_id`='".$_SESSION['company_id']."' WHERE `inv_id`='".$_POST['qa_no']."' and `gl_code`='5'");
}

if($sgst != '0')
{
	$sgst_q = $conn->query("UPDATE `".$client_detail->client_ac_type."` SET 
		`credit_amt`='".$sgst."',`u_id`='".$_SESSION['id']."',`c_id`='".$_SESSION['company_id']."' WHERE `inv_id`='".$_POST['qa_no']."' and `credit_name`='6'");
		
		$sgst_qinv = $conn->query("UPDATE `11` SET `debit_amt`='".$sgst."',
		`u_id`='".$_SESSION['id']."',`c_id`='".$_SESSION['company_id']."' WHERE `inv_id`='".$_POST['qa_no']."' and `gl_code`='6'");
}

if($igst != '0')
{
	$igst_q = $conn->query("UPDATE `".$client_detail->client_ac_type."` SET 
		`credit_amt`='".$igst."',`u_id`='".$_SESSION['id']."',`c_id`='".$_SESSION['company_id']."' WHERE `inv_id`='".$_POST['qa_no']."' and `credit_name`='7'");
		
		$igst_qinv = $conn->query("UPDATE `11` SET `debit_amt`='".$igst."',
		`u_id`='".$_SESSION['id']."',`c_id`='".$_SESSION['company_id']."' WHERE `inv_id`='".$_POST['qa_no']."' and `gl_code`='7'");
}


$del = $conn->query("DELETE FROM `purchase_detail_mst` WHERE s_id = '".$_POST["s_id_u"]."' ");

foreach($_POST['product_name'] as $index => $val) {
	$sub = floatval($_POST["quntity"][$index]) * floatval($_POST["price"][$index]) ;
	$id = $_POST["id"][$index];
	$prodct = $con->query("select * from product_master where product_id = '".$id."'")->fetch_object();
	$insert_pi_detail_sales = $conn->query('INSERT INTO `purchase_detail_mst`(`p_name`, `pr_name`, `HSN`, `grate`, `p_desc`, `unit`, `qty`, `rate`, `amt`, `remark`, `s_id`) VALUES (
	"'.$conn->real_escape_string($_POST["id"][$index]).'",
	"'.$conn->real_escape_string($prodct->product_name).'",
	"'.$conn->real_escape_string($prodct->HSN).'",
	"'.$conn->real_escape_string($prodct->rate).'",
	"'.$conn->real_escape_string($_POST["discription"][$index]).'",
	"'.$conn->real_escape_string($_POST["product_unit"][$index]).'",
	"'.$conn->real_escape_string($_POST["quntity"][$index]).'",
	"'.$conn->real_escape_string($_POST["price"][$index]).'",
	"'.$conn->real_escape_string($sub).'",
	"'.$conn->real_escape_string($_POST["remarks_detail"][$index]).'",
	"'.$_POST["s_id_u"].'")');
}

	if($add_chalan && $insert_pi_detail_sales)
	{
		header('location:../pu_invoice.php?id='.$_POST["s_id_u"]);
		exit;
	}
?>