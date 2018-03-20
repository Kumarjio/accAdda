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
	$add_new_project = $con->query("INSERT INTO `project_master`( `project_name`, `contact_person_name`,`contact_no`, `email`, `address`) VALUES ('".$con->real_escape_string($_POST['project_name'])."','".$con->real_escape_string($_POST['contact_person_name'])."','".$con->real_escape_string($_POST['project_no'])."','".$con->real_escape_string($_POST['project_email'])."','".$con->real_escape_string($_POST['project_address'])."')");
		if($add_new_project)
		{
			$_SESSION['msg'] = 'Project  Successfully Added';
			header('location:../manage_project.php');
			exit;
		}
}
?>