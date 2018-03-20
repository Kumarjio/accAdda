<?php  
  
 $con = mysqli_connect("localhost","root","root","form");
if(!$con){
	die('could not connect'.mysql_error());
}
echo 'Connected Succesfully<br/>';

  
$setSql = "SELECT `name`,`phoneno`,`address`,`email` FROM `data`";  
$setRec = mysqli_query($con, $setSql);  
  
$columnHeader = '';  
$columnHeader = "Name" . "\t" . "Phone no" . "\t" . "Address" . "\t" . "Email" ."\t";  
  
$setData = '';  
  
while ($rec = mysqli_fetch_row($setRec)) {  
    $rowData = '';  
    foreach ($rec as $value) {  
        $value = '"' . $value . '"' . "\t";  
        $rowData .= $value;  
    }  
    $setData .= trim($rowData) . "\n";  
}  
  
  
header("Content-type: application/octet-stream");  
header("Content-Disposition: attachment; filename=User_Detail_Reoprt.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  
  
echo ucwords($columnHeader) . "\n" . $setData . "\n";  
  
?>  