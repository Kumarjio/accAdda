<?php
include_once('../config/config2.php');
if($_POST['id'])
{
$id = $_POST['id'];
$unit_add = $conn->query('select * from ver_mst where project_name = "'.$id.'" ');
while($unit_addr = $unit_add->fetch_object())
{
	$option[] = "<option value='".$unit_addr->c_date."'>".$unit_addr->c_date."</option>";	
}
echo json_encode($option);
exit;
}
exit;
?>