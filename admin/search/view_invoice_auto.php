<?php
include_once('../config/config.php');
if(isset($_GET['term']))
{
    $query = $con->query("select * from client_master where client_name LIKE '%".$con->real_escape_string($_GET['term'])."%' and flag = '0' and dflag = '0'");
while ($row = $query->fetch_assoc()) {
        $json[]=array(
				'label'=> $row['client_name'],
				'value'=> $row['client_name'],
				'client_id' => $row['client_id'],
				);
	}

echo json_encode($json);
}
?>
