<?php 
include_once('../config/config2.php');

$subtotal = 0; $total = 0;  if( $_POST['freight'] != '0' || !empty($_POST['freight']) ){ $freight = $_POST['freight']; }else { $freight = 0; }

foreach($_POST['product_name'] as $index => $val) {
	$subtotal += floatval($_POST["quntity"][$index]) * floatval($_POST["price"][$index]);
}
$total += $subtotal +  $freight;

$insert = $conn->query("INSERT INTO `purchase_return_mst`(`act_no`, `pr_no`, `purchase_inv_no`, `pr_date`, `ch_no`, `ch_date`, `transport`,
 `prj_id`, `agnst`, `from`, `to`, `remark`, `freight`, `total`, `due_date`, `c_id`, `u_id`) VALUES (
 '".$conn->real_escape_string($_POST['for_pre_client_id'])."',
 '".$conn->real_escape_string($_POST['s_number'])."',
 '".$conn->real_escape_string($_POST['sl_no'])."',
 '".$conn->real_escape_string($_POST['today_date'])."',
 '".$conn->real_escape_string($_POST['chalan_no'])."',
 '".$conn->real_escape_string($_POST['chalan_date'])."',
 '".$conn->real_escape_string($_POST['transport_name'])."',
 '".$conn->real_escape_string($_POST['project_name'])."',
 '".$conn->real_escape_string($_POST['Against_Form'])."',
 '".$conn->real_escape_string($_POST['good_dispatch_from'])."',
 '".$conn->real_escape_string($_POST['good_dispatch_to'])."',
 '".$conn->real_escape_string($_POST['remarks'])."',
 '".$freight."',
 '".$total."',
 '".$conn->real_escape_string($_POST['due_date'])."','".$_SESSION['company_id']."','".$_SESSION['id']."')");
 
$jurnal = $conn->query("INSERT into journal_mst(j_date,d1,db1,c1,c2,cr1,cr2,inv_id,`u_id`,`c_id`,`prj_id`) values 
('".$conn->real_escape_string($_POST['today_date'])."','".$conn->real_escape_string($_POST['for_pre_client_id'])."','".$total."','2','4','".$subtotal."','".$freight."','".$conn->real_escape_string($_POST['s_number'])."','".$_SESSION['id']."','".$_SESSION['company_id']."','".$_POST['project_name']."')");
$account_type = $con->query('select * from client_master where client_id = "'.$_POST["for_pre_client_id"].'"')->fetch_object();

$ac_type = $conn->query('INSERT INTO `'.$account_type->client_ac_type.'` ( `gl_code`, `debit_name`, `debit_amt`, `inv_id`, `u_id`, `c_id`, `l_date`) VALUES 
("'.$_POST['for_pre_client_id'].'","2","'.$subtotal.'","'.$conn->real_escape_string($_POST["s_number"]).'","'.$conn->real_escape_string($_SESSION["id"]).'","'.$conn->real_escape_string($_SESSION["company_id"]).'","'.$conn->real_escape_string($_POST["today_date"]).'")');

$tax = $conn->query('INSERT INTO `23`( `gl_code`, `credit_name`, `credit_amt`, `inv_id`, `u_id`,`c_id`,`l_date`) VALUES 
("2","'.$_POST['for_pre_client_id'].'","'.$subtotal.'","'.$conn->real_escape_string($_POST["s_number"]).'","'.$conn->real_escape_string($_SESSION["id"]).'","'.$conn->real_escape_string($_SESSION["company_id"]).'","'.$conn->real_escape_string($_POST["today_date"]).'")');

if($freight != '0' )
	{
		$ac_type = $conn->query('INSERT INTO `'.$account_type->client_ac_type.'` ( `gl_code`, `debit_name`, `debit_amt`, `inv_id`, `u_id`, `c_id`, `l_date`) VALUES 
		("'.$_POST['for_pre_client_id'].'","4","'.$freight.'","'.$conn->real_escape_string($_POST["s_number"]).'","'.$conn->real_escape_string($_SESSION["id"]).'","'.$conn->real_escape_string($_SESSION["company_id"]).'","'.$conn->real_escape_string($_POST["today_date"]).'")');
		$freight_insert = $conn->query('INSERT INTO `9`(`gl_code`, `credit_name`, `credit_amt`, `inv_id`, `u_id`, `c_id`, `l_date`) VALUES 
		("4","'.$_POST['for_pre_client_id'].'","'.$freight.'","'.$conn->real_escape_string($_POST["s_number"]).'","'.$conn->real_escape_string($_SESSION["id"]).'","'.$conn->real_escape_string($_SESSION["company_id"]).'","'.$conn->real_escape_string($_POST["today_date"]).'")');
	}
	
	

foreach($_POST['product_name'] as $index => $val) {

	$insert_detail = $conn->query('INSERT INTO `purchase_return_detail_mst`(`p_name`, `p_desc`, `unit`, `qty`, `rate`, `amt`, `remark`, `s_id`) VALUES ("'.$conn->real_escape_string($val).'","'.$conn->real_escape_string($_POST["discription"][$index]).'","'.$conn->real_escape_string($_POST["unit"][$index]).'","'.$conn->real_escape_string($_POST["quntity"][$index]).'","'.$conn->real_escape_string($_POST["price"][$index]).'","'.floatval($_POST["quntity"][$index]) * floatval($_POST["price"][$index]).'","'.$conn->real_escape_string($_POST["remarks_detail"][$index]).'","'.$conn->real_escape_string($_POST["id_s"]).'")');

}


if($insert_detail && $insert && $jurnal)
	{
		
		
		header('location:../vi_pu_re.php?id='.$_POST["id_s"]);
		exit;
	}
 ?>