<?php 
include_once('../config/config.php');
if(isset($_POST['page']))
{
	$query = $con->query("UPDATE `page` SET `name`= '".trim($_POST['page'])."',`val`= '".trim($_POST['no'])."' where id = '".$_POST['id']."'");
	if($query)
	{
		$_SESSION['msg'] = 'Successfully Updated';
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