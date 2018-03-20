<?php
include_once('../config/config.php');
if(isset($_GET['term']))
{
    $query = $con->query("select * from user_master where username LIKE '%".$con->real_escape_string($_GET['term'])."%'");
while ($row = $query->fetch_assoc()) {
        $json[]=array(
				'label'=> $row['username'],
				'value'=> $row['username']
				);
	}

echo json_encode($json);
}
?>
