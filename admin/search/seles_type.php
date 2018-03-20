<?php
include_once('../config/config.php');
if(isset($_POST['sel']))
{ 
	$company = $con->query("select * from company_mas where company_id = '".$_SESSION['company_id']."'")->fetch_object();
	if( $_POST['sel'] ==  $company->state)
	{
		if($_POST['gst'] == '')
		{
			echo "2";
		}
			
		if($_POST['gst'] != '')
		{
			echo "1";
		}
	}
	else if($_POST['sel'] !=  $company->state)
	{
		if($_POST['gst'] == '')
		{
			echo "4";
		}
			
		if($_POST['gst'] != '')
		{
			echo "3";
		}
	}
}


?>
