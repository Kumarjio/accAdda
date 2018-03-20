<?php
include_once('../config/config.php');
if(isset($_GET['term']))
{
    $query = $con->query("select * from project_master where project_name LIKE '%".$con->real_escape_string($_GET['term'])."%' and flag = '0'");
while ($row = $query->fetch_assoc()) {
        $json[]=array(
				'label'=> $row['project_name'],
				'value'=> $row['project_name'],
				'product_id' => $row['project_id']
				);
	}

echo json_encode($json);
}
?>
