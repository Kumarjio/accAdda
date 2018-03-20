<?php
include_once('../config/config2.php');
if(isset($_GET['term']))
{
    $query = $conn->query("select * from purchase_return_mst where purchase_inv_no LIKE '%".$con->real_escape_string($_GET['term'])."%' and flag = '0'");
while ($row = $query->fetch_assoc()) {
        $json[]=array(
				'label'=> $row['purchase_inv_no'],
				'value'=> $row['purchase_inv_no']
				);
	}

echo json_encode($json);
}
?>
