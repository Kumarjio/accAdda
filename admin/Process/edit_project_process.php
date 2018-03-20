<?php 
include_once('../config/config.php');
if(empty($_POST))
{
	$_SESSION['emsg'] = 'Please Add Information';
	header('location:../new_project.php');
	exit;
}
else
{
	$add_new_project = $con->query("UPDATE `project_master` SET `project_name`='".$con->real_escape_string($_POST['project_name'])."',`contact_person_name`='".$con->real_escape_string($_POST['contact_person_name'])."',`contact_no`='".$con->real_escape_string($_POST['project_no'])."',`email`='".$con->real_escape_string($_POST['project_email'])."',`address`='".$con->real_escape_string($_POST['project_address'])."'  WHERE project_id='".$_POST['p_u_id']."'");
		if($add_new_project)
		{
			$_SESSION['msg'] = 'Project  Successfully Updated';
			header('location:../manage_project.php');
			exit;
		}
}
?>