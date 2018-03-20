<?php

include_once('../config/config2.php');

$zipname = 'file.zip';
$zip = new ZipArchive;
$zip->open($zipname, ZipArchive::CREATE);

foreach( $_POST['c'] as $val )
{
	$data = $conn->query("SELECT * FROM `sales_mst` WHERE s_id = '".$val."'")->fetch_object();
	fu($val);
	$zip->addFile("../save/Sales-".$data->s_numner.md5(time()).".pdf");
}


header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$zipname);
header('Content-Length: ' . filesize($zipname));
readfile($zipname);



function fu($val)
{
	
	header('location:../fpdf/vs.php?id='$val);
	
}
?>