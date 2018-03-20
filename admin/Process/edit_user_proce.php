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
	$ext = pathinfo($_FILES['user_img']['name'], PATHINFO_EXTENSION);
	$file = md5(microtime(true)).".".$ext;
	$name = "images_pro/user/".$file;
	
	$add_new_user = $con->query("UPDATE `user_master` SET `full_name`= '".$con->real_escape_string($_POST['fullname'])."',
	`username`= '".$con->real_escape_string($_POST['username'])."',`page_authen`= '".rtrim($pa,',')."' , `company_authen`= '".rtrim($com,',')."', `year_authen`= '".rtrim($year,',')."' where user_master_id = '".$_POST['id_user']."' ");
	
	if(!empty($_FILES['user_img']['name']))
	{
		$ph = $con->query("UPDATE `user_master` SET `user_photo`='".$con->real_escape_string($name)."' where user_master_id = '".$_POST['id_user']."'");
		move_uploaded_file($_FILES['user_img']['tmp_name'],"../images_pro/user/".$file);
	}
	if( $_POST['userpass'] != '123456'  )
	{
			$pass_q = $con->query("UPDATE `user_master` SET `user_pass`= '".$con->real_escape_string(md5($_POST['userpass']))."' where user_master_id = '".$_POST['id_user']."' ");
	}
	
	
		if($add_new_user)
		{
			
			$_SESSION['msg'] = 'User Successfully Updated';
			header('location:../manage_user.php');
			exit;
		}
}
?>