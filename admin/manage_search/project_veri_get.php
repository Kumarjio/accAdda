<?php 
include_once('../config/config2.php');

$key = $_POST['keywords'];
$prj = $_POST['project'];

$tpur = $conn->query("SELECT * from purchase_mst WHERE act_no = '".$key."' and prj_id = '".$prj."' and c_id = '".$_SESSION['company_id']."'");
$tjur = $conn->query("SELECT * FROM journal_mst WHERE prj_id='".$prj."' and c_id = '".$_SESSION['company_id']."'");
$tsal = $conn->query("SELECT * FROM sales_mst WHERE act_no = '".$key."' and prj_id = '".$prj."' and c_id = '".$_SESSION['company_id']."' ");
$tjus = $conn->query("SELECT * FROM journal_mst WHERE prj_id='".$prj."' and c_id = '".$_SESSION['company_id']."'"); 
$debit_p = 0; $credits = 0;
while($tpurr = $tpur->fetch_object()){
	$tpurrr = $conn->query("SELECT SUM(total)as tt from purchase_return_mst WHERE purchase_inv_no='".$tpurr->s_numner."'")->fetch_object();
	$pu_amtr = $tpurr->total_amt;
	if(!empty($tpurrr->tt))
	{
		$pu_amtr -= $tpurrr->tt;
	}
	$debit_p += $pu_amtr;
}
while($tjurr = $tjur->fetch_object()){
	if(actype($tjurr->d1,$con) == 'TD' || actype($tjurr->d1,$con) == 'PD' || actype($tjurr->d1,$con) == 'BD')
		{
			$tjd_amt = $tjurr->db1 + $tjurr->db2 + $tjurr->db3 + $tjurr->db4 + $tjurr->db5 + $tjurr->db6 + $tjurr->db7 + $tjurr->db8 + $tjurr->db9 + $tjurr->db10; 	
		}else
		{
			$tjd_amt = 0;
		}
		$debit_p += $tjd_amt;
}


while($tsalr = $tsal->fetch_object()){
	$ts_amt = $tsalr->total_amt;
	$ts_re = $conn->query("SELECT SUM(total)as st from sales_return_mst WHERE purchase_inv_no = '".$tsalr->s_numner."' ")->fetch_object();
	if( !empty($ts_re->st) )
	{
		$ts_amt -= $ts_re->st;
	}
	$credits += $ts_amt;
}
while($tjusr = $tjus->fetch_object())
{
	if( actype($tjusr->d1,$con) == 'TC' || actype($tjusr->d1,$con) == 'PC' || actype($tjusr->d1,$con) == 'BC' )
	{
		$tjdc = $tjusr->db1 + $tjusr->db2 + $tjusr->db3 + $tjusr->db4 + + $tjusr->db5 + $tjusr->db6 + $tjusr->db7 + $tjusr->db8 + $tjusr->db9 + $tjusr->db10; 	
	}
	else
	{
		$tjdc = 0;
	}
	$credits += $tjdc;
}



function client($id,$con)
{
	$client = $con->query("select * from client_master where client_id = '".$id."'")->fetch_object();
	return $client->client_name;
}

function actype($id,$con)
{
	$client = $con->query("select * from client_master where client_id = '".$id."'")->fetch_object();
	$pre = $con->query("SELECT prifix FROM account_type WHERE ac_id='".$client->client_ac_type."'")->fetch_object();
	return $pre->prifix;
}

$pur = $conn->query("SELECT * from purchase_mst WHERE act_no = '".$key."' and prj_id = '".$prj."'");
$cr = 0;
?>


<div class="col-md-6">
	<div class="box" id="result_purchase" style="overflow-x:scroll;">
		<table id="" class="table table-bordered table-hover" style="margin-bottom:0px;">
            <thead style="background-color:#3c8dbc;">
				<tr>
					<th>Invoice</th>
					<th>Date</th>
					<th>Ledger Name</th>
					<th>Particulars</th>
					<th>Debit</th>
				</tr>
            </thead>
			<tbody>
			<?php while($purr = $pur->fetch_object()){
					$pu_id = 'P_'.$purr->s_id;
					$pu_amt = $purr->total_amt;
					$pu_re_t = $conn->query("SELECT SUM(total)as tt from purchase_return_mst WHERE purchase_inv_no='".$purr->s_numner."'")->fetch_object();
					if(!empty($pu_re_t->tt))
					{
						$pu_amt -= $pu_re_t->tt;
					}
					

			?>
				<tr>
					<th><?php echo $pu_id; ?></th>
					<td><?php echo $purr->s_date; ?></td>
					<td>Purchase</td>
					<td>By - <?php echo client($purr->act_no,$con); ?></td>
					<td><?php echo $pu_amt; ?></td>
				</tr>
			<?php } ?>
			<?php  $jur_pr = $conn->query("SELECT * FROM journal_mst WHERE prj_id='".$prj."'");  ?>
			<?php while($jur_prr = $jur_pr->fetch_object()){ 
					$j_id = 'E_'.$jur_prr->id;
					if(actype($jur_prr->d1,$con) == 'TD' || actype($jur_prr->d1,$con) == 'PD' || actype($jur_prr->d1,$con) == 'BD')
					{
						$jd_amt = $jur_prr->db1 + $jur_prr->db2 + $jur_prr->db3 + $jur_prr->db4 + $jur_prr->db5 + $jur_prr->db6 + $jur_prr->db7 + $jur_prr->db8 + $jur_prr->db9 + $jur_prr->db10; 	
					?>
					
					<tr>
						<th><?php echo $j_id; ?></th>
						<td><?php echo $jur_prr->j_date; ?></td>
						<td>Expences</td>
						<td>By - <?php echo client($jur_prr->d1,$con); ?></td>
						<td><?php echo $jd_amt; ?></td>
					</tr>
					
				<?php	}	
					
					} ?>
			</tbody>
			<tfoot>
			<?php if($credits < $debit_p){ ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<th style="font-size:16px;">Credit : -</th>
					<td style="font-size:16px;"><?php echo $debit_p - $credits; ?></td>
				</tr>
			<?php } ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td style="font-size:16px;">Total : -</td>
					<td style="font-size:16px;"><?php if($credits > $debit_p){ echo $credits; }else{ echo $debit_p; } ?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>

<?php  $sl_in = $conn->query("SELECT * FROM sales_mst WHERE act_no = '".$key."' and prj_id = '".$prj."' "); ?>
		
<div class="col-md-6">
	<div class="box" id="result_purchase" style="overflow-x:scroll;">
		<table id="" class="table table-bordered table-hover" style="margin-bottom:0px;">
            <thead style="background-color:#3c8dbc;">
				<tr>
					<th>Invoice</th>
					<th>Date</th>
					<th>Ledger Name</th>
					<th>Particulars</th>
					<th>Credit</th>
				</tr>
            </thead>
			<tbody>
				<?php while($sl_inr = $sl_in->fetch_object()){ ?>
						<?php 
							$s_id = 'S_'.$sl_inr->s_id;
							$s_amt = $sl_inr->total_amt;
							$s_re = $conn->query("SELECT SUM(total)as st from sales_return_mst WHERE purchase_inv_no = '".$sl_inr->s_numner."' ")->fetch_object();
							if( !empty($s_re->st) )
							{
								$s_amt -= $s_re->st;
							}
						?>
						<tr>
						<th><?php echo $s_id; ?></th>
						<td><?php echo $sl_inr->s_date; ?></td>
						<td>Sales</td>
						<td>By - <?php echo client($sl_inr->act_no,$con); ?></td>
						<td><?php echo $s_amt; $cr += $s_amt; ?></td>
					</tr>
				<?php } ?>
				
				<?php $jr_sl = $conn->query("SELECT * FROM journal_mst WHERE prj_id='".$prj."'"); 
						while($jr_slr = $jr_sl->fetch_object())
						{
							$jrc_id = 'E_'.$jr_slr->id;
							if( actype($jr_slr->d1,$con) == 'TC' || actype($jr_slr->d1,$con) == 'PC' || actype($jr_slr->d1,$con) == 'BC' )
							{
								$jdc = $jr_slr->db1 + $jr_slr->db2 + $jr_slr->db3 + $jr_slr->db4 + + $jr_slr->db5 + $jr_slr->db6 + $jr_slr->db7 + $jr_slr->db8 + $jr_slr->db9 + $jr_slr->db10; 
	?>

					<tr>
						<th><?php echo $jrc_id; ?></th>
						<td><?php echo $jr_slr->j_date; ?></td>
						<td>Income</td>
						<td>By - <?php echo client($jr_slr->d1,$con); ?></td>
						<td><?php echo $jdc; $cr += $jdc; ?></td>
					</tr>
						
					<?php		} 
						}
				?>
			</tbody>
			<tfoot>
			<?php if($credits > $debit_p){ ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<th style="font-size:16px;">Debit : -</th>
					<td style="font-size:16px;"><?php echo $credits - $debit_p; ?></td>
				</tr>
			<?php } ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td style="font-size:16px;">Total : -</td>
					<td style="font-size:16px;"><?php if($credits > $debit_p){ echo $credits; }else{ echo $debit_p; } ?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>