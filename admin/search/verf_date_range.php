<?php
include_once('../config/config2.php');
$date = $_POST['id'];
$dates = explode("-", $date);
$date1 = trim($dates[0]);
$date2 = trim($dates[1]);
$unit_add = $conn->query("select * from ver_mst WHERE c_date between '".$date1."' AND '".$date2."'");	
while($unit_addr = $unit_add->fetch_object())
{
	$option[] = "<option value='".$unit_addr->c_date."'>".$unit_addr->c_date."</option>";	
}
echo json_encode($option);
exit;
?>