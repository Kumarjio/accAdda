<?php
include_once('admin/config/config.php');
$pass = trim($_POST['Lpass']);
if(!empty($pass))
{
	$pass = $con->real_escape_string($pass);
	$md5 = md5($pass);
	$query = $con->query("select * from user_master where username = '".$_SESSION['user']."'");
	if($query)
	{
		$res = $query->fetch_object();
		if($md5 === $res->user_pass)
		{
			$_SESSION['pass'] = $md5;
			$_SESSION['timestamp'] = time();
			echo "true";
			exit;
		}
		else
		{
			echo "Username And Password Not Match.";
			exit;
		}
	}
	else
	{
		echo "Somthing Went Wrong Please Try Again";
		exit;
	}
}
?>