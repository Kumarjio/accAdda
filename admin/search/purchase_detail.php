<?php
include_once('../config/config.php');
if(isset($_GET['term']))
{
    $query = $con->query("select * from product_master where product_name LIKE '%".$con->real_escape_string($_GET['term'])."%' flag = '0'");
while ($row = $query->fetch_assoc()) {
        $json[]=array(
				'label'=> $row['product_name'],
				'value'=> $row['product_name'],
				'discription' => $row['product_desc'],
				'unit' => $row['product_unit'],
				'gst' => $row['rate']
				);
	}

echo json_encode($json);
}
?>
