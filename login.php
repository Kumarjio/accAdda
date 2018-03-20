<?php 
include_once('admin/config/config.php');
$user = trim($_POST['user']);
$pass = trim($_POST['pass']);
if(!empty($user) && !empty($pass))
{
	$user = $con->real_escape_string($user);
	$pass = $con->real_escape_string($pass);
	$md5 = md5($pass);
	$query = $con->query("select * from user_master where username = '".$user."'");
	if($query)
	{
		$row = $query->num_rows;
		if($row == 1)
		{
			$res = $query->fetch_object();
			if($md5 === $res->user_pass)
			{
				$_SESSION['user'] = $res->username;
				$_SESSION['name'] = $res->full_name;
				$_SESSION['id'] = $res->user_master_id;
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
			echo "Username Not Exists... Try With Different";
			exit;
		}
	}
	else
	{
		echo "Somthing Went Wrong Please Try Again";
		exit;
	}
}
if(isset($_POST['year']) && isset($_POST['company']))
{
	$_SESSION['company_id'] = $_POST['company'];
	$_SESSION['year'] = $_POST['year'];
	echo "ok";
	exit;
}

if(isset($_POST['check']))
{
	if(!empty($_SESSION['user']) || !empty($_SESSION['id']))
	{
		echo "s_ok";
		exit;
	}else{
		echo "notok";
		exit;
	}
}
?>