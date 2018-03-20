<?php 
include_once('../config/config.php');
if(isset($_POST['page']))
{
	$query = $con->query("INSERT INTO `page`(`name`, `val`) VALUES ('".trim($_POST['page'])."','".trim($_POST['no'])."')");
	if($query)
	{
		$_SESSION['msg'] = 'Successfully Added';
		header('location:index.php');
		exit;
	}
}
else
{
	header('location:index.php');
	exit;
}
?>