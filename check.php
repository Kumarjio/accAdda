<?php include_once('admin/config/config.php');
if(isset($_POST['financial_year']))
{
$financial_year = $con->query("select * from financial_year_master where year = '".$_POST['financial_year']."'");
	if($financial_year->num_rows > 0)
	{
		echo "not";
	}
	else
	{
		$add_year = $con->query("insert into `financial_year_master` (`year`) values ('".$_POST['financial_year']."')");
			if($add_year)
			{
				$_SESSION['msg'] = "Database ".$_POST['financial_year']." Succssesfully Added";
			}
	}
}


?>