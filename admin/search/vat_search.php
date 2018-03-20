<?php
include_once('../config/config.php');
if(isset($_GET['term']))
{
    $query = $con->query("select * from tax_master where tax_name LIKE '%".$con->real_escape_string($_GET['term'])."%'");
while ($row = $query->fetch_assoc()) {
        $json[]=array(
				'label'=> $row['tax_name'],
				'value'=> $row['tax_name'],
				'id'=> $row['tax_id'],
				'gst_persent' => $row['gst'],
				'cst_persent' => $row['cst'],
				'vat_persent' => $row['vat'],
				'st_persent' =>$row['st'],
				'add_tax_persent' =>$row['add_tax']
				);
	}

echo json_encode($json);
}
?>
