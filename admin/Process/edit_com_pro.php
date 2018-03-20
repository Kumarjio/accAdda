<?php 
include_once('../config/config.php');
if(!empty($_POST['company_name']))
{
	$hext = pathinfo($_FILES['com_head_image']['name'], PATHINFO_EXTENSION); $hfile = md5(microtime(true))."1.".$hext; $hname = "images_pro/company/head/".$hfile;
	$fext = pathinfo($_FILES['com_footer_image']['name'], PATHINFO_EXTENSION); $ffile = md5(microtime(true))."2.".$fext; $fname = "images_pro/company/foot/".$ffile;
	$sext = pathinfo($_FILES['com_stamp_image']['name'], PATHINFO_EXTENSION); $sfile = md5(microtime(true))."3.".$sext; $sname = "images_pro/company/stamp/".$sfile;
	$new_company = $con->query("UPDATE `company_mas` SET `company_name`='".$con->real_escape_string($_POST['company_name'])."',`contact_no`='".$con->real_escape_string($_POST['company_contact_no'])."',`comp_email`='".$con->real_escape_string($_POST['company_email'])."',`comp_vat_no`='".$con->real_escape_string($_POST['vat_no'])."',`comp_cst_no`='".$con->real_escape_string($_POST['cst_no'])."',`gst`='".$_POST['gst_no']."',`state`='".$_POST['state_code']."',`comp_address`='".$con->real_escape_string($_POST['company_address'])."',`contact_person_name`='".$con->real_escape_string($_POST['contact_person_name'])."',`contact_person_no`='".$con->real_escape_string($_POST['contact_person_number'])."',`comp_createdby`='".$_SESSION['id']."' WHERE `company_id`='".$_POST['company_id']."'");
								
	if(!empty($_FILES['com_head_image']['name']))
	{
		$query1 = $con->query("update `company_mas` SET `header_img`='".$con->real_escape_string($hname)."' WHERE company_id='".$_POST['company_id']."'");
		move_uploaded_file($_FILES['com_head_image']['tmp_name'],"../images_pro/company/head/".$hfile);
	}
	if(!empty($_FILES['com_footer_image']['name']))
	{
		$query2 = $con->query("update `company_mas` SET `footer_img`='".$con->real_escape_string($fname)."' WHERE company_id='".$_POST['company_id']."'");
		move_uploaded_file($_FILES['com_footer_image']['tmp_name'],"../images_pro/company/foot/".$ffile);
	}
	if(!empty($_FILES['com_stamp_image']['name']))
	{
		$query3 = $con->query("update `company_mas` SET `stamp_img`='".$con->real_escape_string($sname)."' WHERE company_id='".$_POST['company_id']."'");
		move_uploaded_file($_FILES['com_stamp_image']['tmp_name'],"../images_pro/company/stamp/".$sfile);
	}
	
	if($new_company)
	{
		$_SESSION['msg'] = "Company Succssesfully Updated";
		header('location:../manage_company.php');
		exit;
	}
}
else
{
	
	$_SESSION['emsg'] = "Please Fill Company Detail To Insert Data";
	header('location:../new_company.php');
	exit;
}



?>