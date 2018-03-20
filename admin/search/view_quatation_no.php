<?php
include_once('../config/config2.php');
if(isset($_GET['term']))
{
    $query = $conn->query("select * from n_quat_mst where s_numner LIKE '%".$con->real_escape_string($_GET['term'])."%' and usage_flag = '0'");
while ($row = $query->fetch_assoc()) {
        $json[]=array(
				'label'=> $row['s_numner'],
				'value'=> $row['s_numner']
				
				);
	}

echo json_encode($json);
}
?>
