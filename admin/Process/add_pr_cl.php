<?php
include_once('../config/config2.php');
if(isset($_POST["submit"]))
{
	 $file = $_FILES['file']['tmp_name'];
	 $handle = fopen($file, "r");
		 while(($data = fgetcsv($handle, 1000, ",")) !== false)
		 {	
	 
	 if( $data[1] != '' && $data[3] != '' && $data[8] != '' && $data[10] != '' )
	 {		
			//echo $data[11];exit;
			
			if( $data[10] != '' )
			{
				$series = $con->query("SELECT * FROM `prefix_master` WHERE serial_name LIKE '%".$data[10]."%'")->fetch_object();
				$pre = $series->prefix_id;
			}
			else
			{
				$pre = 0;
			}
			
			
			if( $data[3] != '' )
			{
				$ac = $con->query("SELECT * FROM `account_type` WHERE ac_name LIKE '%".$data[3]."%'")->fetch_object();
			}
			
			if($data[8] != '')
			{
				$state = $con->query("SELECT * FROM `state_code` WHERE `name` LIKE '%".$data[8]."%'")->fetch_object();
			}
			
				 $insert = $con->query("INSERT INTO `client_master`(`client_name`, `client_contact_no`, `client_ac_type`, `client_email`, `client_tin`, `client_cst`,
				 `gst`, `state`, `client_address`, `client_series`, `client_openingbal`, `client_opening_type`, `client_termday`) VALUES (
					'".$data[1]."',
					'".$data[2]."',
					'".$ac->ac_id."',
					'".$data[4]."',
					'".$data[5]."',
					'".$data[6]."',
					'".$data[7]."',
					'".$state->code."',
					'".$data[9]."',
					'".$pre."',
					'".$data[11]."',
					'".$data[12]."',
					'".$data[13]."'
					)");
			 
		 }
		 if($insert)
		 {
			 $_SESSION['msg'] = 'Products Successfully Added';
			 header('location:../');
			 exit;
		 }
		 
	} 
}
else
{
	$_SESSION['emsg'] = 'Please Select .Csv File';
	header('location:../add_exl_product.php');
	exit;
}

?>