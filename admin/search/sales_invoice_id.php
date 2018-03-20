<?php
include_once('../config/config2.php');
$id = $_POST['id'];
$unit_add = $conn->query('select * from sales_mst where act_no = "'.$id.'" and cut_amt != "0" ');
while($unit_addr = $unit_add->fetch_object())
{
	$option[] = "<option value='".$unit_addr->s_id."'>".$unit_addr->s_numner."</option>";	
}
echo json_encode($option);
?>