<?php
include_once('../config/config.php');
$unit_add = $con->query('select * from unit_master');
$id = $_POST['id']+1;
echo "<select id='sales_detail". $id ."_unit' name='product_unit[]'>";
echo "<option>Select Unit</option>";
while($unit_addr = $unit_add->fetch_object())
{
	echo "<option>".$unit_addr->unit_name."</option>";
}
echo "</select>";
?>