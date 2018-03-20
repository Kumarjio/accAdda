<?php
include_once('../config/config2.php');

$id = $conn->query("SELECT * FROM ver_mst ORDER BY id DESC LIMIT 1")->fetch_object();

$email = $_POST["ver_email"];
$var_mas = $conn->query('INSERT INTO `ver_mst`(`email`, `project_name`, `c_date`, `u_id`, `c_id`,`toa`) VALUES ("'.$conn->real_escape_string(implode(",",$email)).'","'.$conn->real_escape_string($_POST["hidden_pro_name"]).'","'.$_POST['t_date'].'","'.$_SESSION["id"].'","'.$_SESSION["company_id"].'","'.$_POST["to_add"].'")');

foreach($_POST['ver_date'] as $index => $val)
{
	$detail = $conn->query('INSERT INTO `ver_detail_mst`(`vdate`, `remark`, `product`, `desc`, `side`, `chanage`, `qty`, `ver_id`) VALUES ("'.$conn->real_escape_string($val).'","'.$conn->real_escape_string($_POST["remarks_detail"][$index]).'","'.$conn->real_escape_string($_POST["ver_product_name"][$index]).'","'.$conn->real_escape_string($_POST["ver_discription"][$index]).'","'.$conn->real_escape_string($_POST["ver_side"][$index]).'","'.$conn->real_escape_string($_POST["ver_change"][$index]).'","'.$conn->real_escape_string($_POST["ver_remark"][$index]).'","'.$conn->real_escape_string($id->id+1).'")');
}

$rid = $id->id + 1;

if($var_mas && $detail)
{
		$_SESSION['msg'] = 'Varification Successfully created';
		header('location:../fpdf/vmail.php?id='.$rid ); 
		exit;
}

?>