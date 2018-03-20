<?php 
include_once('../config/config2.php');

$hext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION); $hfile = md5(microtime(true))."1.".$hext; $hname = "images_pro/user/".$hfile;
$query = $con->query("UPDATE `user_master` SET `full_name`='".$con->real_escape_string(trim($_POST['name']))."',`username`='".$con->real_escape_string(trim($_POST['user']))."' where user_master_id = '".$_POST['id']."'");
if(!empty($_FILES['img']['name']))
{
	$Iquery = $con->query("UPDATE `user_master` SET `user_photo`= '".$con->real_escape_string($hname)."' where user_master_id = '".$_POST['id']."' ");
	$a = move_uploaded_file($_FILES['img']['tmp_name'],"../images_pro/user/".$hfile);
	if($query && $a && $Iquery)
	{
			$_SESSION['msg'] = "Profile Succssesfully Updated";
		header('location:../profile.php');
		exit;
	}
}

if($query)
{
	$_SESSION['msg'] = "Profile Succssesfully Updated";
		header('location:../profile.php');
		exit;
}

?>