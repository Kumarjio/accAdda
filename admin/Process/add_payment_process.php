<?php 
include_once('../config/config2.php');
	
	
	
	$total = $_POST['total'];
	
	
	while($total != 0)
	{
		$sales1_cut = $conn->query("select * from `purchase_mst` where `cut_amt` != '0.00'");
		while($sales1_cutr = $sales1_cut->fetch_object())
		{
			if($total <= $sales1_cutr->cut_amt )
			{
				$dif = $sales1_cutr->cut_amt - $total;
				$total = 0;
				$up = $conn->query("UPDATE `purchase_mst` SET `cut_amt`= '".$dif."' where s_id = '".$sales1_cutr->s_id."'");
			}
			else if($total > $sales1_cutr->cut_amt)
			{
				$total = $total - $sales1_cutr->cut_amt;
				$up = $conn->query("UPDATE `purchase_mst` SET `cut_amt`= '0.00' where s_id = '".$sales1_cutr->s_id."'");
			}
		}
	}
	
	
	
	$pay = $conn->query("INSERT INTO `payment_mst`(`p_number`, `p_date`, `act_id`, `act_name`, `amount`, `mode`, `bank_name`, `chk_no`, `prj_id`, `tds`, `rd`, `total`, `remark`, `left_amt`, `u_id`, `c_id`) VALUES('".$con->real_escape_string($_POST['payment_reciept_no'])."','".$con->real_escape_string($_POST['today_date'])."','".$con->real_escape_string($_POST['id_add_pay_hidden'])."','".$con->real_escape_string($_POST['account_name'])."','".$con->real_escape_string($_POST['amount'])."','".$con->real_escape_string($_POST['payment_act_mode'])."','".$con->real_escape_string($_POST['bank_name_payment'])."','".$con->real_escape_string($_POST['cheque_no_payment'])."','".$con->real_escape_string($_POST['client_ac_type'])."','".$con->real_escape_string($_POST['tds'])."','".$con->real_escape_string($_POST['round_off'])."','".$con->real_escape_string($_POST['total'])."','".$con->real_escape_string($_POST['remark'])."','','".$_SESSION['id']."','".$_SESSION['company_id']."')");
	$account_type = $con->query('select * from client_master where client_id = "'.$_POST["id_add_pay_hidden"].'"')->fetch_object();
	if($_POST['payment_act_mode'] == 'cash')
	{
		$in_case = $conn->query('INSERT INTO `5`(`gl_code`,  `credit_name`, `credit_amt`, `inv_id`, `u_id`, `c_id`, `l_date`) VALUES ("1","'.$_POST['id_add_pay_hidden'].'","'.$con->real_escape_string($_POST['total']).'","'.$_POST['payment_reciept_no'].'","'.$_SESSION['id'].'","'.$_SESSION['company_id'].'","'.$con->real_escape_string($_POST['today_date']).'")');
		$ac_type = $conn->query('INSERT INTO `'.$account_type->client_ac_type.'`(`gl_code`,  `debit_name`, `debit_amt`, `inv_id`, `u_id`, `c_id`, `l_date`) VALUES ("'.$_POST['id_add_pay_hidden'].'","1","'.$con->real_escape_string($_POST['total']).'","'.$_POST['payment_reciept_no'].'","'.$_SESSION['id'].'","'.$_SESSION['company_id'].'","'.$con->real_escape_string($_POST['today_date']).'")');
		$pay_journal_mst = $conn->query("INSERT INTO `journal_mst`(`j_date`, `d1`, `db1`, `c1`, `cr1`, `inv_id`,`u_id`,`c_id`,`remark`, `prj_id`) VALUES ('".$con->real_escape_string($_POST['today_date'])."','".$con->real_escape_string($_POST['id_add_pay_hidden'])."','".$con->real_escape_string($_POST['total'])."','1','".$con->real_escape_string($_POST['total'])."','".$_POST['payment_reciept_no']."','".$_SESSION['id']."','".$_SESSION['company_id']."','".$_POST['client_address']."','".$_POST['client_ac_type']."') ");
	}else if($_POST['payment_act_mode'] == 'bank')
	{
		$pay_journal_mst = $conn->query("INSERT INTO `journal_mst`(`j_date`, `d1`, `db1`, `c1`, `cr1`, `inv_id`,`u_id`,`c_id`,`remark`, `prj_id`) VALUES ('".$con->real_escape_string($_POST['today_date'])."','".$con->real_escape_string($_POST['id_add_pay_hidden'])."','".$con->real_escape_string($_POST['total'])."','".$_POST['pay_bank_id']."','".$con->real_escape_string($_POST['total'])."','".$_POST['payment_reciept_no']."','".$_SESSION['id']."','".$_SESSION['company_id']."','".$_POST['client_address']."','".$_POST['client_ac_type']."') ");
		$in_case = $conn->query('INSERT INTO `1`(`gl_code`,  `credit_name`, `credit_amt`, `inv_id`, `u_id`, `c_id`, `l_date`) VALUES ("'.$_POST['pay_bank_id'].'","'.$_POST['id_add_pay_hidden'].'","'.$con->real_escape_string($_POST['total']).'","'.$_POST['payment_reciept_no'].'","'.$_SESSION['id'].'","'.$_SESSION['company_id'].'","'.$con->real_escape_string($_POST['today_date']).'")');
		$ac_type = $conn->query('INSERT INTO `'.$account_type->client_ac_type.'`(`gl_code`,  `debit_name`, `debit_amt`, `inv_id`, `u_id`, `c_id`, `l_date`) VALUES ("'.$_POST['id_add_pay_hidden'].'","'.$_POST['pay_bank_id'].'","'.$con->real_escape_string($_POST['total']).'","'.$_POST['payment_reciept_no'].'","'.$_SESSION['id'].'","'.$_SESSION['company_id'].'","'.$con->real_escape_string($_POST['today_date']).'")');
	}
	
	if($pay && $pay_journal_mst)
		{
			$_SESSION['msg'] = 'Payment Successfully';
			header('location:../ManagePayment.php');
			exit;
		}
?>