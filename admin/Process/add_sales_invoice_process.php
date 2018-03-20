<?php
include_once('../config/config2.php');
/*echo "<pre>";
print_r($_POST); exit;*/
$total = 0;
$prefix = substr_replace(ltrim($_SESSION['year'],'20'),'',3,2);
$sel_pur_no = $conn->query("SELECT * FROM sales_mst ORDER BY s_id DESC LIMIT 1")->fetch_object();
$client_data = $con->query("select * from client_master where client_id = '".$_POST['for_pre_client_id']."'")->fetch_object();
if($client_data->client_series == '0'){
		$prefix_det = $con->query("select * from prefix_master where prefix_id = '".$_POST['client_series']."' ")->fetch_object();
		$s_de = $conn->query("select * from sales_mst where s_numner LIKE '".$prefix_det->prefix_code."%' ORDER BY s_id DESC LIMIT 1")->fetch_object();
		if(empty($s_de->s_id)){
			$code = 1;
			$billbookno = 1;
		}
		else 
		{
			$lcode = ltrim($s_de->s_numner,$prefix_det->prefix_code."_"); $code = rtrim($lcode,"_".$prefix);
			if(empty($code))
			{
				$_s = substr($lcode, strpos($lcode, "_") - 1); 
				$code = substr($_s , 0 ,1);
			}
			$code = intval($code) + 1;
			if($s_de->billbookno == '0')
			{
				$s_de->billbookno = 1;
			}
			if( $code - 1  == intval($prefix_det->total_page) * intval($s_de->billbookno))
			{
				$billbookno = intval($s_de->billbookno) + 1;
			}else
			{
				$billbookno = $s_de->billbookno;
			}
		}
		$invoice = $prefix_det->prefix_code."_".$code."_".$prefix;
		$billbookno;
}else
{
	$invoice = $_POST['invoice'] ;
	 $billbookno = $_POST['billbook'];
}
$total = $_POST["price_without_tax_sales"] + $_POST["cgst"] + $_POST["sgst"] +$_POST["igst"] + $_POST["freight"];

	$insert_pi_sales = $conn->query('INSERT INTO `sales_mst`(`s_numner`, `act_no`, `prj_id`, `s_date`,`ch_no`, `po_no`, 
	`po_date`, `transport`, `lr_no`, `lr_date`, `due_date`, `from`, `to`, `cgst`, 
	`sgst`, `igst`, `freight`, `total_amt`, `remark`, `agnst`,`cut_amt` ,`billbookno`, `u_id`, `c_id`) VALUES (
												"'.$invoice.'",
												"'.$_POST['for_pre_client_id'].'",
												"'.$conn->real_escape_string($_POST["project_name"]).'",
												"'.$conn->real_escape_string($_POST["date"]).'",
												"'.$conn->real_escape_string($_POST["chalan_no_max"]).'",
												"'.$conn->real_escape_string($_POST["po_no"]).'",
												"'.$conn->real_escape_string($_POST["po_date"]).'",
												"'.$conn->real_escape_string($_POST["transport_name"]).'",
												"'.$conn->real_escape_string($_POST["lr_no"]).'",
												"'.$conn->real_escape_string($_POST["lr_date"]).'",
												"'.$conn->real_escape_string($_POST["due_date"]).'",
												"'.$conn->real_escape_string($_POST["good_dispatch_from"]).'",
												"'.$conn->real_escape_string($_POST["good_dispatch_to"]).'",
												"'.$conn->real_escape_string($_POST["cgst"]).'",
												"'.$conn->real_escape_string($_POST["sgst"]).'",
												"'.$conn->real_escape_string($_POST["igst"]).'",
												"'.$conn->real_escape_string($_POST["freight"]).'",
												"'.$total.'",
												"'.$conn->real_escape_string($_POST["remark"]).'",
												"'.$conn->real_escape_string($_POST["Against_Form"]).'",
												"'.$total.'",
												"'.$billbookno.'",
												"'.$conn->real_escape_string($_SESSION["id"]).'",
												"'.$conn->real_escape_string($_SESSION["company_id"]).'")');
												
		$insert_jurnal = $conn->query('INSERT INTO `journal_mst`(`j_date`,`d1`,`db1`,`c1`,`c2`,`c3`,`c4`,`c5`
																	,`cr1`,`cr2`,`cr3`,`cr4`,`cr5`,`inv_id`,`u_id`,`c_id`,`remark`,`prj_id`) VALUES (
		"'.$conn->real_escape_string($_POST["date"]).'",
		"'.$conn->real_escape_string($_POST["for_pre_client_id"]).'",
		"'.$total.'","3","4","5","6","7",
		"'.$conn->real_escape_string($_POST["price_without_tax_sales"]).'",
		"'.$conn->real_escape_string($_POST["freight"]).'",
		"'.$conn->real_escape_string($_POST["cgst"]).'",
		"'.$conn->real_escape_string($_POST["sgst"]).'",
		"'.$conn->real_escape_string($_POST["igst"]).'",
		"'.$invoice.'","'.$_SESSION["id"].'",
		"'.$_SESSION["company_id"].'",
		"'.$_POST["remark"].'",
		"'.$_POST["project_name"].'")');
		
	$account_type = $con->query('select * from client_master where client_id = "'.$_POST["for_pre_client_id"].'"')->fetch_object();
	
	$ac_type = $conn->query('INSERT INTO `'.$account_type->client_ac_type.'` (`gl_code`,`debit_name`,`debit_amt`, `inv_id`, `u_id`, `c_id`, `l_date`) VALUES ("'.$_POST["for_pre_client_id"].'","3","'.$conn->real_escape_string($_POST["price_without_tax_sales"]).'","'.$invoice.'","'.$conn->real_escape_string($_SESSION["id"]).'","'.$conn->real_escape_string($_SESSION["company_id"]).'","'.$conn->real_escape_string($_POST["date"]).'")');
	
	$insert_asd = $conn->query('INSERT INTO `25`(`gl_code`, `credit_name`, `credit_amt`, `inv_id`, `u_id`, `c_id`, `l_date`) VALUES ("3","'.$_POST["for_pre_client_id"].'","'.$conn->real_escape_string($_POST["price_without_tax_sales"]).'","'.$invoice.'","'.$conn->real_escape_string($_SESSION["id"]).'","'.$conn->real_escape_string($_SESSION["company_id"]).'","'.$conn->real_escape_string($_POST["date"]).'")');
	
	if(!empty($_POST['freight']))
	{
		$ac_typef = $conn->query('INSERT INTO `'.$account_type->client_ac_type.'` (`gl_code`,`debit_name`,`debit_amt`, `inv_id`, `u_id`, `c_id`, `l_date`) VALUES ("'.$_POST["for_pre_client_id"].'","4","'.$conn->real_escape_string($_POST["freight"]).'","'.$invoice.'","'.$conn->real_escape_string($_SESSION["id"]).'","'.$conn->real_escape_string($_SESSION["company_id"]).'","'.$conn->real_escape_string($_POST["date"]).'")');
		$freight_insert = $conn->query('INSERT INTO `9`(`gl_code`, `credit_name`, `credit_amt`, `inv_id`, `u_id`, `c_id`, `l_date`) VALUES ("4","'.$_POST["for_pre_client_id"].'","'.$conn->real_escape_string($_POST["freight"]).'","'.$invoice.'","'.$conn->real_escape_string($_SESSION["id"]).'","'.$conn->real_escape_string($_SESSION["company_id"]).'","'.$conn->real_escape_string($_POST["date"]).'")');
	}
	
	if(!empty($_POST['cgst']))
	{
		$ac_typest = $conn->query('INSERT INTO `'.$account_type->client_ac_type.'` (`gl_code`,`debit_name`,`debit_amt`, `inv_id`, `u_id`, `c_id`, `l_date`) VALUES ("'.$_POST["for_pre_client_id"].'","5","'.$conn->real_escape_string($_POST["cgst"]).'","'.$invoice.'","'.$conn->real_escape_string($_SESSION["id"]).'","'.$conn->real_escape_string($_SESSION["company_id"]).'","'.$conn->real_escape_string($_POST["date"]).'")');
		$st_insert = $conn->query('INSERT INTO `11`(`gl_code`, `credit_name`,  `credit_amt`,  `inv_id`, `u_id`, `c_id`, `l_date`) VALUES ("5","'.$conn->real_escape_string($_POST["for_pre_client_id"]).'","'.$conn->real_escape_string($_POST["cgst"]).'","'.$invoice.'","'.$conn->real_escape_string($_SESSION["id"]).'","'.$conn->real_escape_string($_SESSION["company_id"]).'","'.$conn->real_escape_string($_POST["date"]).'")');
	}
	
	if(!empty($_POST['sgst']))
	{
		$ac_typevat = $conn->query('INSERT INTO `'.$account_type->client_ac_type.'` (`gl_code`,`debit_name`,`debit_amt`, `inv_id`, `u_id`, `c_id`, `l_date`) VALUES ("'.$_POST["for_pre_client_id"].'","6","'.$conn->real_escape_string($_POST["sgst"]).'","'.$invoice.'","'.$conn->real_escape_string($_SESSION["id"]).'","'.$conn->real_escape_string($_SESSION["company_id"]).'","'.$conn->real_escape_string($_POST["date"]).'")');
		$vat_insert = $conn->query('INSERT INTO `11`(`gl_code`, `credit_name`,  `credit_amt`,  `inv_id`, `u_id`, `c_id`, `l_date`) VALUES ("6","'.$conn->real_escape_string($_POST["for_pre_client_id"]).'","'.$conn->real_escape_string($_POST["sgst"]).'","'.$invoice.'","'.$conn->real_escape_string($_SESSION["id"]).'","'.$conn->real_escape_string($_SESSION["company_id"]).'","'.$conn->real_escape_string($_POST["date"]).'")');
	}
	
	if(!empty($_POST['igst']))
	{
		$ac_typecst = $conn->query('INSERT INTO `'.$account_type->client_ac_type.'` (`gl_code`,`debit_name`,`debit_amt`, `inv_id`, `u_id`, `c_id`, `l_date`) VALUES ("'.$_POST["for_pre_client_id"].'","7","'.$conn->real_escape_string($_POST["igst"]).'","'.$invoice.'","'.$conn->real_escape_string($_SESSION["id"]).'","'.$conn->real_escape_string($_SESSION["company_id"]).'","'.$conn->real_escape_string($_POST["date"]).'")');
		$cst_insert = $conn->query('INSERT INTO `11`(`gl_code`, `credit_name`,  `credit_amt`,  `inv_id`, `u_id`, `c_id`, `l_date`) VALUES ("7","'.$conn->real_escape_string($_POST["for_pre_client_id"]).'","'.$conn->real_escape_string($_POST["igst"]).'","'.$invoice.'","'.$conn->real_escape_string($_SESSION["id"]).'","'.$conn->real_escape_string($_SESSION["company_id"]).'","'.$conn->real_escape_string($_POST["date"]).'")');
	}
	
	$_sid = $sel_pur_no->s_id + 1 ;
foreach($_POST['product_name'] as $index => $val) {
	$sub = intval($_POST["quntity"][$index]) * intval($_POST["price"][$index]) ;
	$id = $_POST["id_pro"][$index];
	$prodct = $con->query("select * from product_master where product_id = '".$id."'")->fetch_object();
	$insert_pi_detail_sales = $conn->query('INSERT INTO `sales_detail_mst`(`p_name`, `pr_name`, `HSN`, `grate`, `p_desc`, `unit`, `qty`, `rate`, `amt`, `remark`, `s_id`) VALUES (
	"'.$conn->real_escape_string($_POST["id_pro"][$index]).'",
	"'.$conn->real_escape_string($prodct->product_name).'",
	"'.$conn->real_escape_string($prodct->HSN).'",
	"'.$conn->real_escape_string($prodct->rate).'",
	"'.$conn->real_escape_string($_POST["discription"][$index]).'",
	"'.$conn->real_escape_string($_POST["product_unit"][$index]).'",
	"'.$conn->real_escape_string($_POST["quntity"][$index]).'",
	"'.$conn->real_escape_string($_POST["price"][$index]).'",
	"'.$conn->real_escape_string($sub).'",
	"'.$conn->real_escape_string($_POST["remarks_detail"][$index]).'",
	"'.$_sid.'")');
}
	
	if($insert_pi_detail_sales && $insert_pi_sales)
	{	
		foreach($_POST['flag'] as $index => $val)
		{
			$qua_chalan = $conn->query("UPDATE `quatation_mst` SET `usage_flag`= '1' where `s_id`= '".$val."' ");
		}
		$_SESSION['msg'] = 'Sales Invoice Created';
		header( 'location:../fpdf/smail.php?id='.$_sid );
		exit;
	} 
	

?>