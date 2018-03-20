<?php
include_once('../config/config2.php');
$total = 0;
$subtotal = 0;
$cgst = 0; $sgst = 0; $igst = 0;
if(!empty($_POST['freight'])){ $freight = floatval($_POST['freight']); }else{ $freight = 0; }
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


$add_chalan = $conn->query("INSERT INTO `purchase_mst`(`s_numner`, `act_no`, `prj_id`, `s_date`, `ch_no`, `ch_date`,`transport`, 
`due_date`, `from`, `to`, `cgst`, `sgst`, `igst`, `freight`, `total_amt`, `remark`, `agnst`,`cut_amt`, `u_id`, `c_id`) VALUES (
'".$_POST['qa_no']."',
'".$_POST['for_pre_client_id']."',
'".$_POST['project_name']."',
'".$_POST['date']."',
'".$_POST['ch_no']."',
'".$_POST['ch_date']."',
'".$_POST['transport_name']."',
'".$_POST['due_date']."',
'".$_POST['good_dispatch_from']."',
'".$_POST['good_dispatch_to']."',
'".$cgst."',
'".$sgst."',
'".$igst."',
'".$freight."',
'".$total."',
'".$_POST['remark']."',
'".$_POST['Against_Form']."',
'".$total."',
'".$_SESSION["id"]."',
'".$_SESSION["company_id"]."'
)");

$insert_jurnal = $conn->query('INSERT INTO `journal_mst`(`j_date`, `d1`, `d2`, `d3`, `d4`, `d5`, `db1`, `db2`, `db3`, `db4`,
 `db5`, `c1`, `cr1`, `inv_id`, `u_id`, `c_id`, `remark`, `prj_id`) VALUES (
 "'.$conn->real_escape_string($_POST["date"]).'",
 "2","4","5","6","7",
 "'.$subtotal.'",
 "'.$freight.'",
 "'.$cgst.'",
 "'.$sgst.'",
 "'.$igst.'",
 "'.$_POST["for_pre_client_id"].'",
 "'.$total.'",
 "'.$_POST["qa_no"].'",
 "'.$_SESSION["id"].'",
 "'.$_SESSION["company_id"].'",
 "'.$_POST["remark"].'",
 "'.$_POST["project_name"].'")');
 
 $ac_type = $conn->query('INSERT INTO `'.$client_detail->client_ac_type.'` (`gl_code`,`credit_name`,`credit_amt`, `inv_id`, `u_id`, `c_id`, `l_date`) VALUES (
 "'.$_POST["for_pre_client_id"].'","2",
 "'.$subtotal.'",
 "'.$_POST["qa_no"].'",
 "'.$_SESSION["id"].'",
 "'.$_SESSION["company_id"].'",
 "'.$_POST["date"].'")');
 
 $insert_asd = $conn->query('INSERT INTO `23`(`gl_code`, `debit_name`, `debit_amt`, `inv_id`, `u_id`, `c_id`, `l_date`) VALUES (
 "2","'.$_POST["for_pre_client_id"].'",
 "'.$subtotal.'",
 "'.$conn->real_escape_string($_POST["qa_no"]).'",
 "'.$conn->real_escape_string($_SESSION["id"]).'",
 "'.$conn->real_escape_string($_SESSION["company_id"]).'","'.$conn->real_escape_string($_POST["date"]).'")');

if($freight != '0')
	{
		$fri_in = $conn->query('INSERT INTO `'.$client_detail->client_ac_type.'` (`gl_code`,`credit_name`,`credit_amt`, `inv_id`, `u_id`, `c_id`, `l_date`) VALUES (
		"'.$_POST["for_pre_client_id"].'","4",
		"'.$freight.'",
		"'.$_POST["qa_no"].'",
		"'.$_SESSION["id"].'",
		"'.$_SESSION["company_id"].'",
		"'.$_POST["date"].'")');
		$fri_out = $conn->query('INSERT INTO `9`(`gl_code`, `debit_name`, `debit_amt`, `inv_id`, `u_id`, `c_id`, `l_date`) VALUES (
		"4","'.$conn->real_escape_string($_POST["for_pre_client_id"]).'",
		"'.$freight.'",
		"'.$conn->real_escape_string($_POST["qa_no"]).'",
		"'.$conn->real_escape_string($_SESSION["id"]).'",
		"'.$conn->real_escape_string($_SESSION["company_id"]).'",
		"'.$conn->real_escape_string($_POST["date"]).'")');
	} 
 
 if($cgst != '0')
	{
		$cgst_in = $conn->query('INSERT INTO `'.$client_detail->client_ac_type.'` (`gl_code`,`credit_name`,`credit_amt`, `inv_id`, `u_id`, `c_id`, `l_date`) VALUES (
		"'.$_POST["for_pre_client_id"].'","5",
		"'.$cgst.'",
		"'.$conn->real_escape_string($_POST["qa_no"]).'",
		"'.$conn->real_escape_string($_SESSION["id"]).'",
		"'.$conn->real_escape_string($_SESSION["company_id"]).'",
		"'.$conn->real_escape_string($_POST["date"]).'")');
		$cgst_out = $conn->query('INSERT INTO `11`(`gl_code`, `debit_name`,  `debit_amt`,  `inv_id`, `u_id`, `c_id`, `l_date`) VALUES (
		"5","'.$conn->real_escape_string($_POST["for_pre_client_id"]).'",
		"'.$cgst.'",
		"'.$conn->real_escape_string($_POST["qa_no"]).'",
		"'.$conn->real_escape_string($_SESSION["id"]).'",
		"'.$conn->real_escape_string($_SESSION["company_id"]).'",
		"'.$conn->real_escape_string($_POST["date"]).'")');
	}
	
	if($sgst != '0')
	{
		$sgst_in = $conn->query('INSERT INTO `'.$client_detail->client_ac_type.'` (`gl_code`,`credit_name`,`credit_amt`, `inv_id`, `u_id`, `c_id`, `l_date`) VALUES (
		"'.$_POST["for_pre_client_id"].'","6",
		"'.$sgst.'",
		"'.$conn->real_escape_string($_POST["qa_no"]).'",
		"'.$conn->real_escape_string($_SESSION["id"]).'",
		"'.$conn->real_escape_string($_SESSION["company_id"]).'",
		"'.$conn->real_escape_string($_POST["date"]).'")');
		$sgst_out = $conn->query('INSERT INTO `11`(`gl_code`, `debit_name`,  `debit_amt`,  `inv_id`, `u_id`, `c_id`, `l_date`) VALUES (
		"6","'.$conn->real_escape_string($_POST["for_pre_client_id"]).'",
		"'.$sgst.'",
		"'.$conn->real_escape_string($_POST["qa_no"]).'",
		"'.$conn->real_escape_string($_SESSION["id"]).'",
		"'.$conn->real_escape_string($_SESSION["company_id"]).'",
		"'.$conn->real_escape_string($_POST["date"]).'")');
	}
	
	if($igst != '0')
	{
		$igst_in = $conn->query('INSERT INTO `'.$client_detail->client_ac_type.'` (`gl_code`,`credit_name`,`credit_amt`, `inv_id`, `u_id`, `c_id`, `l_date`) VALUES (
		"'.$_POST["for_pre_client_id"].'","7",
		"'.$igst.'",
		"'.$conn->real_escape_string($_POST["qa_no"]).'",
		"'.$conn->real_escape_string($_SESSION["id"]).'",
		"'.$conn->real_escape_string($_SESSION["company_id"]).'",
		"'.$conn->real_escape_string($_POST["date"]).'")');
		$igst_out = $conn->query('INSERT INTO `11`(`gl_code`, `debit_name`,  `debit_amt`,  `inv_id`, `u_id`, `c_id`, `l_date`) VALUES (
		"7","'.$conn->real_escape_string($_POST["for_pre_client_id"]).'",
		"'.$igst.'",
		"'.$conn->real_escape_string($_POST["qa_no"]).'",
		"'.$conn->real_escape_string($_SESSION["id"]).'",
		"'.$conn->real_escape_string($_SESSION["company_id"]).'",
		"'.$conn->real_escape_string($_POST["date"]).'")');
	}
 
 

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
	"'.$_POST["id_purchase_invoice"].'")');
}

	if($add_chalan && $insert_pi_detail_sales)
	{
		header('location:../pu_invoice.php?id='.$_POST["id_purchase_invoice"]);
		exit;
	}
?>