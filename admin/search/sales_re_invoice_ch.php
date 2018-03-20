<?php
include_once('../config/config2.php');
$id = $_POST['id'];
$sel_row = $conn->query("select * from sales_mst where s_numner = '".$id."'")->fetch_object();
echo json_encode($sel_row);
?>