<?php include_once('../config/config2.php'); 
$sel_pur_no = $conn->query("SELECT * FROM journal_mst ORDER BY id DESC LIMIT 1")->fetch_object();
$jur_id = $sel_pur_no->id + 1;
$debit = array();
$credit = array();
$debit_id = array();
$credit_id = array();
foreach($_POST['type'] as $index => $val) 
{
	if($val == 'By')
	{
		array_push($debit_id,$_POST['hiddenId'][$index]);
		array_push($debit,$_POST['debit'][$index]);
	}

	if($val == 'Cr')
	{
		array_push($credit_id,$_POST['hiddenId'][$index]);
		array_push($credit,$_POST['credit'][$index]);
	}
}

$did = '';
$dval = '';
$debit_val = '';
$debit_Id_val = '';
for ($i = 1; $i <= count($debit); $i++) {
    $did .= '`d'.$i.'`,';
    $dval .= '`db'.$i.'`,';
	$debit_val .= "'".$debit[$i-1]."',";
	$debit_Id_val .= "'".$debit_id[$i-1]."',";
}

$cid = '';
$cval = '';
$credit_val = '';
$credit_Id_val = '';
for($j = 1; $j <= count($credit); $j++)
{
	$cid .= '`c'.$j.'`,';
	$cval .= '`cr'.$j.'`,';
	$credit_val .= "'".$credit[$j-1]."',";	
	$credit_Id_val .= "'".$credit_id[$j-1]."',";	  
}

$jurnal = $conn->query("INSERT INTO `journal_mst`(`j_date` ,".$did.$dval.$cid.$cval."`inv_id`, `u_id`, `c_id`, `remark`, `prj_id`) VALUES ('".$conn->real_escape_string($_POST['today_date'])."',".$debit_Id_val.$debit_val.$credit_Id_val.$credit_val."'J_".$jur_id."','".$conn->real_escape_string($_SESSION['id'])."','".$conn->real_escape_string($_SESSION['company_id'])."','".$_POST['remark']."','".$_POST['client_ac_type']."')");
$d1 = $conn->query("SELECT d1,d2,d3,d4,d5,d6,d7,d8,d9,d10 FROM `journal_mst` WHERE inv_id = 'J_".$jur_id."'")->fetch_row();
$c1 = $conn->query("SELECT c1,c2,c3,c4,c5,c6,c7,c8,c9,c10 FROM `journal_mst` WHERE inv_id = 'J_".$jur_id."'")->fetch_row();
$db1 = $conn->query("SELECT db1,db2,db3,db4,db5,db6,db7,db8,db9,db10 FROM `journal_mst` WHERE inv_id = 'J_".$jur_id."'")->fetch_row();
$cr1 = $conn->query("SELECT cr1,cr2,cr3,cr4,cr5,cr6,cr7,cr8,cr9,cr10 FROM `journal_mst` WHERE inv_id = 'J_".$jur_id."'")->fetch_row();

//condition for custom ledger account
	$j = 0;
    for ($i = 0; $i < 10; $i++)
    {
		
		while( $db1[$i] != 0 )
		{
			if($db1[$i] <= $cr1[$j])
			{
				$cr1[$j] = $cr1[$j] - $db1[$i];
				$debitq = $conn->query("INSERT into `" .account($d1[$i],$con). "` (`gl_code`, `debit_name`,  `debit_amt`,  `inv_id`,`u_id`,`c_id`,`l_date`) VALUES('".$d1[$i]."','".$c1[$j]."','".$db1[$i]."','J_".$jur_id."','".$_SESSION['id']."','".$_SESSION["company_id"]."','".$conn->real_escape_string($_POST['today_date'])."')");
				$creditq = $conn->query("INSERT into `" .account($c1[$j],$con)."` (`gl_code`, `credit_name`,  `credit_amt`,  `inv_id`,`u_id`,`c_id`,`l_date`) VALUES('".$c1[$j]."','".$d1[$i]."','".$db1[$i]."','J_".$jur_id."','".$_SESSION['id']."','".$_SESSION["company_id"]."','".$conn->real_escape_string($_POST['today_date'])."')");
				$db1[$i] = 0;
			}
			else if( $db1[$i] > $cr1[$j] )
			{
				$db1[$i] = $db1[$i] - $cr1[$j];
				$debitq = $conn->query("INSERT into `" .account($d1[$i],$con). "` (`gl_code`, `debit_name`,  `debit_amt`,  `inv_id`,`u_id`,`c_id`,`l_date`) VALUES('".$d1[$i]."','".$c1[$j]."','".$cr1[$j]."','J_".$jur_id."','".$_SESSION['id']."','".$_SESSION["company_id"]."','".$conn->real_escape_string($_POST['today_date'])."')");
				$creditq = $conn->query("INSERT into `" .account($c1[$j],$con)."` (`gl_code`, `credit_name`,  `credit_amt`,  `inv_id`,`u_id`,`c_id`,`l_date`) VALUES('".$c1[$j]."','".$d1[$i]."','".$cr1[$j]."','J_".$jur_id."','".$_SESSION['id']."','".$_SESSION["company_id"]."','".$conn->real_escape_string($_POST['today_date'])."')"); 
				$cr1[$j] = 0;
				$j++;
			}
			
		}
		
	}
//condition for custom ledger account


if($jurnal)
{
	$_SESSION['msg'] = 'Journal Entry Successfully Addeed';
	header('location:../AddJournalEntry.php');
}



function account($id,$con)
{
	$q = $con->query("select * from client_master where client_id = '".$id."'")->fetch_object();
	return $q->client_ac_type;
}

/*

exit;
print_r($debit);echo "<br>";
print_r($debit_id);echo "<br>";
print_r($credit_id);echo "<br>";
print_r($credit);

*/

?>

