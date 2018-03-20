<?php
include_once('../config/config.php');
if(isset($_GET['term']))
{
    $query = $con->query("select * from company_mas where company_name LIKE '%".$con->real_escape_string($_GET['term'])."%' and flag = '0'");
while ($row = $query->fetch_assoc()) {
        $json[]=array(
				'label'=> $row['company_name'],
				'value'=> $row['company_name'],
				'company_id' => $row['company_id']
				);
	}

echo json_encode($json);
}
?>
