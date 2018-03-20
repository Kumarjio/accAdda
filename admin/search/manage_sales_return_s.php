<?php
include_once('../config/config2.php');
if(isset($_GET['term']))
{
    $query = $conn->query("select * from sales_return_mst where pr_no LIKE '%".$con->real_escape_string($_GET['term'])."%' ");
while ($row = $query->fetch_assoc()) {
        $json[]=array(
				'label'=> $row['pr_no'],
				'value'=> $row['pr_no'],
		
				);
	}

echo json_encode($json);
}
?>
