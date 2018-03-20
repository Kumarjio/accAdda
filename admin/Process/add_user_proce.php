<?php 
include_once('../config/config.php');
if(empty($_POST))
{
	$_SESSION['emsg'] = 'Please Add Information';
	header('location:../add_new_client.php');
	exit;
}
else
{
	$pa = ''; foreach($_POST['page'] as $page){ $pa .= $page.","; }
	$year = ''; foreach($_POST['year'] as $y){ $year .= $y.","; }
	$com = ''; foreach($_POST['company'] as $c){ $com .= $c.","; }
	if( $_FILES['user_img']['name'] != '')
	{
	$ext = pathinfo($_FILES['user_img']['name'], PATHINFO_EXTENSION);
	$file = md5(microtime(true)).".".$ext;
	$name = "images_pro/user/".$file;
	}else
	{
		$name = "images_pro/user/f3.png";
	}
	$add_new_user = $con->query("INSERT INTO `user_master`(`full_name`, `user_pass`, `username`, `user_photo`, `page_authen`, `company_authen`, `year_authen`) VALUES ('".$con->real_escape_string($_POST['fullname'])."','".$con->real_escape_string(md5($_POST['userpass']))."','".$con->real_escape_string($_POST['username'])."','".$con->real_escape_string($name)."','".$con->real_escape_string(rtrim($pa,','))."','".$con->real_escape_string(rtrim($com,','))."','".$con->real_escape_string(rtrim($year,','))."')");
		if($add_new_user)
		{
			if( $_FILES['user_img']['name'] != '')
			{
				move_uploaded_file($_FILES['user_img']['tmp_name'],"../images_pro/user/".$file);
			}
			$_SESSION['msg'] = 'User Successfully Added';
			header('location:../manage_user.php');
			exit;
		}
}
?>