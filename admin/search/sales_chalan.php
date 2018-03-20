<?php
include_once('../config/config2.php');
$id = $_POST['id'];
$unit_add = $conn->query('SELECT * FROM `quatation_mst` WHERE act_no = "'.$id.'" and usage_flag = "0" ');
if($unit_add->num_rows > 0)
{
while($unit_addr = $unit_add->fetch_object())
{
	$tax = $con->query("select * from tax_master where tax_id = '".$unit_addr->tax_type."'")->fetch_object();
	$option[] = "<div class='checkbox'><label for=".$unit_addr->s_id."><input name='chalan[]' type='checkbox' id='".$unit_addr->s_id."' value='".$unit_addr->s_id."'>".$unit_addr->s_numner."&nbsp;&nbsp;-&nbsp;&nbsp;".$unit_addr->s_date."</label></div>";	
}

}else
{
	$option[] = "<label>No Data</label>";
}
echo json_encode($option);
?>