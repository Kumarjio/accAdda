<?php 
include_once('admin/config/config.php');
if(!empty($_POST['company_name']))
{
	$hext = pathinfo($_FILES['com_head_image']['name'], PATHINFO_EXTENSION); $hfile = md5(microtime(true))."1.".$hext; $hname = "images_pro/company/head/".$hfile;
	$fext = pathinfo($_FILES['com_footer_image']['name'], PATHINFO_EXTENSION); $ffile = md5(microtime(true))."2.".$fext; $fname = "images_pro/company/foot/".$ffile;
	$sext = pathinfo($_FILES['com_stamp_image']['name'], PATHINFO_EXTENSION); $sfile = md5(microtime(true))."3.".$sext; $sname = "images_pro/company/stamp/".$sfile;
	
	$new_company = $con->query("INSERT INTO `company_mas`(`company_name`, `contact_no`, `comp_email`, `comp_vat_no`, `comp_cst_no`,`gst`, `state`, `comp_address`, `contact_person_name`, `contact_person_no`, `header_img`, `footer_img`, `stamp_img`, `comp_createdby`) VALUES ('".$con->real_escape_string($_POST['company_name'])."','".$con->real_escape_string($_POST['company_contact_no'])."','".$con->real_escape_string($_POST['company_email'])."','".$con->real_escape_string($_POST['vat_no'])."','".$con->real_escape_string($_POST['cst_no'])."','".$con->real_escape_string($_POST['gst_no'])."','".$con->real_escape_string($_POST['state_code'])."','".$con->real_escape_string($_POST['company_address'])."','".$con->real_escape_string($_POST['contact_person_name'])."','".$con->real_escape_string($_POST['contact_person_number'])."','".$con->real_escape_string($hname)."','".$con->real_escape_string($fname)."','".$con->real_escape_string($sname)."','".$con->real_escape_string($_SESSION['name'])."')");
	if($new_company)
	{
		move_uploaded_file($_FILES['com_head_image']['tmp_name'],"admin/images_pro/company/head/".$hfile);
		move_uploaded_file($_FILES['com_footer_image']['tmp_name'],"admin/images_pro/company/foot/".$ffile);
		move_uploaded_file($_FILES['com_stamp_image']['tmp_name'],"admin/images_pro/company/stamp/".$sfile);
		$_SESSION['msg'] = "Company Succssesfully Added";
		header('location:com_sel.php');
		exit;
	}
}



?>