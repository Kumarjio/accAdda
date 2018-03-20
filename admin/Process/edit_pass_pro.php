<?php 
include_once('../config/config2.php');

$op = md5(trim($_POST['old']));
$np = md5(trim($_POST['np']));
$ncp = md5(trim($_POST['ncp']));


if($op == $_SESSION['pass'])
{
	if($np == $ncp)
	{
		$q = $con->query("UPDATE `user_master` SET `user_pass`= '".$np."' where user_master_id = '".$_POST['id']."'");
		if($q)
		{
			session_unset();
			session_destroy();
			header('location:../index.php');
		}
		else
		{
			$_SESSION['emsg'] = "Somthing Went Wrong Please Try Again";
			header('location:../edit_pass.php');
			exit;
		}
	}
	else
	{
		$_SESSION['emsg'] = "Password And Confirm Password Not Match Please Try Again";
		header('location:../edit_pass.php');
		exit;
	}
}
else
{
		$_SESSION['emsg'] = "Opps Old Password Not Match Please Try Again";
		header('location:../edit_pass.php');
		exit;
}

?>