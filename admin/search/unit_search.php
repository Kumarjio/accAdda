<?php
include_once('../config/config.php');
$unit_add = $con->query('select * from unit_master');
$id = $_POST['id']+1;
echo "<select name='product_unit[]' id='purchase_detail". $id ."_unit'>";
echo "<option>Select Unit</option>";
while($unit_addr = $unit_add->fetch_object())
{
	echo "<option>".$unit_addr->unit_name."</option>";
}
echo "</select>";
?>