<?php
include_once('../config/config.php');
if(isset($_GET['term']))
{
    $query = $con->query("select * from project_master where email LIKE '%".$con->real_escape_string($_GET['term'])."%' and flag = '0'");
while ($row = $query->fetch_assoc()) {
        $json[]=array(
				'label'=> $row['email'],
				'value'=> $row['email'],
				'project_id' => $row['project_id'],
				
				);
	}

echo json_encode($json);
}
?>
