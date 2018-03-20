<?php
include_once('../config/config.php');
if(isset($_GET['term']))
{
    $query = $con->query("select * from user_master where full_name LIKE '%".$con->real_escape_string($_GET['term'])."%'");
while ($row = $query->fetch_assoc()) {
        $json[]=array(
				'label'=> $row['full_name'],
				'value'=> $row['full_name'],
				'user_master_id' => $row['user_master_id']
				);
	}

echo json_encode($json);
}
?>
