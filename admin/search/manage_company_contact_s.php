<?php
include_once('../config/config.php');
if(isset($_GET['term']))
{
    $query = $con->query("select * from company_mas where contact_person_name LIKE '%".$con->real_escape_string($_GET['term'])."%' and flag = '0' ");
while ($row = $query->fetch_assoc()) {
        $json[]=array(
				'label'=> $row['contact_person_name'],
				'value'=> $row['contact_person_name']
				);
	}

echo json_encode($json);
}
?>
