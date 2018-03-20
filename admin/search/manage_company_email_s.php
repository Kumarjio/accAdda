<?php
include_once('../config/config.php');
if(isset($_GET['term']))
{
    $query = $con->query("select * from company_mas where comp_email LIKE '%".$con->real_escape_string($_GET['term'])."%' and flag = '0' ");
while ($row = $query->fetch_assoc()) {
        $json[]=array(
				'label'=> $row['comp_email'],
				'value'=> $row['comp_email']
				);
	}

echo json_encode($json);
}
?>
