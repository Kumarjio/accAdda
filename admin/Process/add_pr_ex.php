<?php
include_once('../config/config2.php');
if(isset($_POST["submit"]))
{
	 $file = $_FILES['file']['tmp_name'];
	 $handle = fopen($file, "r");
		 while(($data = fgetcsv($handle, 1000, ",")) !== false)
		 {
			 if($data[1] != '' && $data[2] != '' && $data[3] != '' && $data[4] != '' && $data[7] != '')
			 {
				 $insert = $con->query("INSERT INTO `product_master` (`product_name`, `HSN`,
					`rate`, `product_unit`, `product_size`, `product_catagory`, `product_desc`) VALUES (
					'".$data[1]."',
					'".$data[2]."',
					'".$data[3]."',
					'".$data[4]."',
					'".$data[5]."',
					'".$data[6]."',
					'".$data[7]."'
					)");
			 }
		 }
		 if($insert)
		 {
			 $_SESSION['msg'] = 'Products Successfully Added';
			 header('location:../');
			 exit;
		 }
		 
		 
}
else
{
	$_SESSION['emsg'] = 'Please Select .Csv File';
	header('location:../add_exl_product.php');
	exit;
}

?>