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


$add_chalan = $conn->query("INSERT INTO `n_quat_mst`(`s_numner`, `act_no`, `prj_id`, `s_date`, `po_no`, `po_date`, `transport`, `lr_no`, `lr_date`, `vat_no`, `cst_no`, 
`due_date`, `from`, `to`, `cgst`, `sgst`, `igst`, `freight`, `total_amt`, `remark`, `agnst`, `serial_id`, `u_id`, `c_id`) VALUES (
'".$_POST['qa_no']."',
'".$_POST['for_pre_client_id']."',
'".$_POST['project_name']."',
'".$_POST['date']."',
'".$_POST['po_no']."',
'".$_POST['po_date']."',
'".$_POST['transport_name']."',
'".$_POST['lr_no']."',
'".$_POST['lr_date']."',
'".$_POST['client_tin']."',
'".$_POST['client_cst']."',
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
'',
'".$_SESSION["id"]."',
'".$_SESSION["company_id"]."'
)");

foreach($_POST['product_name'] as $index => $val) {
	$sub = floatval($_POST["quntity"][$index]) * floatval($_POST["price"][$index]) ;
	$id = $_POST["id"][$index];
	$prodct = $con->query("select * from product_master where product_id = '".$id."'")->fetch_object();
	$insert_pi_detail_sales = $conn->query('INSERT INTO `n_quat_detail_mst`(`p_name`, `pr_name`, `HSN`, `grate`, `p_desc`, `unit`, `qty`, `rate`, `amt`, `remark`, `s_id`) VALUES (
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
		$_SESSION['msg'] = 'Quatation Created';
		header( 'location:../fpdf/qmail.php?id='.$_POST["id_purchase_invoice"] );
		exit;
	}
?>