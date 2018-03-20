<?php 
include_once('../config/config2.php');

	
	$id_ex = $_POST['isd'];
	$account_type = $con->query('select * from client_master where client_id = "'.$_POST["acc_name_hidd_exp"].'"')->fetch_object();
	
	$add_exp = $conn->query("UPDATE `expn_mst` SET `amt`='".$_POST['amount_exp']."',`remark`='".$_POST['remars_exp']."',
	`prj_id`='".$_POST['client_ac_type']."',`u_id`='".$_SESSION['id']."',`c_id`='".$_SESSION['company_id']."' WHERE `id` = '".$id_ex."'");
	
		if($_POST['payment_act_mode'] == 'cash')
		{
			$add1_exp = $conn->query("UPDATE `journal_mst` SET `db1`= '".$_POST['amount_exp']."',`c1` = '1' ,`cr1` = '".$_POST['amount_exp']."' ,`u_id` = '".$_SESSION['id']."', `c_id` = '".$_SESSION['company_id']."',`remark` = '".$_POST['remars_exp']."' ,`prj_id` = '".$_POST['client_ac_type']."' where `inv_id` = 'E_".$id_ex."' ");
			
			$in_case = $conn->query('UPDATE `5` SET `gl_code` = "1",  `credit_name` = "'.$_POST['acc_name_hidd_exp'].'", `credit_amt` = "'.$_POST['amount_exp'].'", `u_id` = "'.$_SESSION['id'].'", `c_id` = "'.$_SESSION['company_id'].'"  where `inv_id` = "E_'.$id_ex.'" ');
			$ac_type = $conn->query('UPDATE `'.$account_type->client_ac_type.'` SET `gl_code` = "'.$_POST['acc_name_hidd_exp'].'",  `debit_name` = "1", `debit_amt` = "'.$_POST['amount_exp'].'" ,`u_id` = "'.$_SESSION['id'].'", `c_id` = "'.$_SESSION['company_id'].'"  where `inv_id` = "E_'.$id_ex.'" ');
		}else if($_POST['payment_act_mode'] == 'bank')
		{
			$add1_exp = $conn->query("UPDATE `journal_mst` SET `db1`= '".$_POST['amount_exp']."',`c1` = '".$_POST['pay_bank_id']."' ,`cr1` = '".$_POST['amount_exp']."' ,`u_id` = '".$_SESSION['id']."', `c_id` = '".$_SESSION['company_id']."',`remark` = '".$_POST['remars_exp']."' ,`prj_id` = '".$_POST['client_ac_type']."' where `inv_id` = 'E_".$id_ex."' ");
			
			$in_case = $conn->query('UPDATE `1` SET `gl_code` = "'.$_POST['pay_bank_id'].'",  `credit_name` = "'.$_POST['acc_name_hidd_exp'].'", `credit_amt` = "'.$_POST['amount_exp'].'", `u_id` = "'.$_SESSION['id'].'", `c_id` = "'.$_SESSION['company_id'].'"  where `inv_id` = "E_'.$id_ex.'" ');
			$ac_type = $conn->query('UPDATE `'.$account_type->client_ac_type.'` SET `gl_code` = "'.$_POST['acc_name_hidd_exp'].'",  `debit_name` = "'.$_POST['pay_bank_id'].'", `debit_amt` = "'.$_POST['amount_exp'].'" ,`u_id` = "'.$_SESSION['id'].'", `c_id` = "'.$_SESSION['company_id'].'"  where `inv_id` = "E_'.$id_ex.'" ');
			
		}
		
		
		if($add_exp)
		{
			$_SESSION['msg'] = 'Expencess Successfully Added';
			header('location:../view_invoice.php');
			exit;
		}

?>

