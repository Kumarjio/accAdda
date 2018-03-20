<?php
    include_once('../config/config2.php');
	$purchase = $conn->query("SELECT sum(debit_amt) as pur_sum_d from `23` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='2'")->fetch_object();
	$puc_ret = $conn->query("SELECT sum(credit_amt) as pur_sum_c from `23` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='2'")->fetch_object(); 
	$sales_ret = $conn->query("SELECT sum(credit_amt) as sal_sum_c from `25` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='3'")->fetch_object(); 
	$sales = $conn->query("SELECT sum(debit_amt) as sal_sum_d from `25` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='3'")->fetch_object(); 
	$direct_ex = $conn->query("SELECT DISTINCT(gl_code) FROM `9` WHERE c_id='".$_SESSION['company_id']."' ");
	$direct_in = $conn->query("SELECT DISTINCT(gl_code) FROM `10` WHERE c_id='".$_SESSION['company_id']."' ");
	
	$_direct_in = $conn->query("SELECT DISTINCT(gl_code) FROM `10` WHERE c_id='".$_SESSION['company_id']."' ");
	$_sales_ret = $conn->query("SELECT sum(credit_amt) as sal_sum_c from `25` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='3'")->fetch_object(); 
	$_sales = $conn->query("SELECT sum(debit_amt) as sal_sum_d from `25` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='3'")->fetch_object(); 
	if( $_sales_ret->sal_sum_c > $_sales->sal_sum_d ){ $_sal_sum = $_sales_ret->sal_sum_c - $_sales->sal_sum_d; }else { $_sal_sum = $_sales->sal_sum_d - $_sales_ret->sal_sum_c; }
$_tot_in = 0;		while($_direct_inr = $_direct_in->fetch_object()){
			$_sales_inc = $conn->query("SELECT sum(credit_amt) as sales_inc from `10` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$_direct_inr->gl_code."'")->fetch_object(); 
			$_sales_incd = $conn->query("SELECT sum(debit_amt) as sales_incd from `10` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$_direct_inr->gl_code."'")->fetch_object(); 
			if($_sales_incd->sales_incd > $_sales_inc->sales_inc) { $_dif_inc = $_sales_incd->sales_incd - $_sales_inc->sales_inc; }else{ $_dif_inc = $_sales_inc->sales_inc - $_sales_incd->sales_incd; }
			$_tot_in += $_dif_inc;
		}
		$_tot_in += $_sal_sum;
	?>
	
	
	<div class="col-md-6">
		<div class="box" style="overflow-x:scroll;">
			<table id="" class="table table-bordered table-hover" style="margin-bottom:0px;">
                <thead style="background-color:#3c8dbc;">
					<tr>
						<th colspan="2">Particulars</th>
						<th>Debit</th>
					</tr>
                </thead>
				<tbody>
					<tr>
						<td>Purchase</td>
						<td><?php echo $purchase->pur_sum_d; ?></td>
						<td></td>
					</tr>
					<tr>
						<td> - Purchase Returns</td>
						<td><?php echo $puc_ret->pur_sum_c; ?></td>
						<td style="text-align:right; font-size:16px;"><?php if( $purchase->pur_sum_d > $puc_ret->pur_sum_c ){ echo $pur_dif = $purchase->pur_sum_d - $puc_ret->pur_sum_c; } else { echo $pur_dif = $puc_ret->pur_sum_c - $purchase->pur_sum_d; } ?></td>
					</tr>
					<tr>
						<th colspan="3">Direct Expenses</th>
					</tr>
					<?php $num_dir = $direct_ex->num_rows; $co_ex = 0; $total_ex = 0;
						while($direct_exr = $direct_ex->fetch_object())
						{ $co_ex++;
							$acount = $con->query("SELECT client_name FROM `client_master` WHERE client_id = '".$direct_exr->gl_code."'")->fetch_object();
							$tc_debit = $conn->query("SELECT sum(debit_amt) as tc_de from `9` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$direct_exr->gl_code."'")->fetch_object();
							$tc_credit = $conn->query("SELECT sum(credit_amt) as tc_cr from `9` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$direct_exr->gl_code."'")->fetch_object(); 
					?>
					<tr>
						<td><?php echo $acount->client_name; ?></td>
						<td><?php if($tc_debit->tc_de > $tc_credit->tc_cr) { echo $dif_td = $tc_debit->tc_de - $tc_credit->tc_cr; }else{ echo $dif_td = $tc_credit->tc_cr - $tc_debit->tc_de; } ?></td>
						<td style="text-align:right; font-size:16px;"><?php $total_ex += $dif_td; if($co_ex === $num_dir) { echo $total_ex; }  ?></td>
					</tr>					
				<?php	} $total_ex += $pur_dif; 
						if( $total_ex < $_tot_in ) { ?>
					<tr>
						<th style="font-size:16px;" colspan="2">Gross Profit</th>
						<th style="text-align:right; font-size:16px;"><?php echo $_tot_in - $total_ex; ?></th>
					</tr>
						<?php } ?> 	
					<tr>
						<td colspan="2" style="text-align:right; font-size:16px;">Total : - </td>
						<td style="text-align:right; font-size:16px;"><?php if( $total_ex < $_tot_in ) { echo $_tot_in; }else if( $total_ex > $_tot_in ){ echo $total_ex; } ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
		
			<div class="col-md-6">
			<div class="box" style="overflow-x:scroll;">
				<table id="" class="table table-bordered table-hover" style="margin-bottom:0px;">
					<thead style="background-color:#3c8dbc;">
						<tr>
							<th colspan="2">Particulars</th>
							<th>Credit</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Sales</td>
							<td><?php echo $sales_ret->sal_sum_c; ?></td>
							<td></td>
						</tr>
						<tr>
							<td> - Sales Returns</td>
							<td><?php echo $sales->sal_sum_d; ?></td>
							<td style="text-align:right; font-size:16px;"><?php if($sales_ret->sal_sum_c > $sales->sal_sum_d ){ echo $sales_dif = $sales_ret->sal_sum_c - $sales->sal_sum_d; } else{ echo $sales_dif = $sales->sal_sum_d - $sales_ret->sal_sum_c; } ?></td>
						</tr>
						<tr>
							<th colspan="3">Direct Income</th>
						</tr>
						<?php $num_inco = $direct_in->num_rows; $co_in = 0; $total_in = 0; ?>
						<?php 	while($direct_inr = $direct_in->fetch_object()){ $co_in++; 
									$acounti = $con->query("SELECT client_name FROM `client_master` WHERE client_id = '".$direct_inr->gl_code."'")->fetch_object();
									$sales_inc = $conn->query("SELECT sum(credit_amt) as sales_inc from `10` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$direct_inr->gl_code."'")->fetch_object(); 
									$sales_incd = $conn->query("SELECT sum(debit_amt) as sales_incd from `10` WHERE c_id='".$_SESSION['company_id']."' AND gl_code='".$direct_inr->gl_code."'")->fetch_object(); 
								?>
						<tr>
							<td><?php echo $acounti->client_name; ?></td>
							<td><?php if($sales_incd->sales_incd > $sales_inc->sales_inc) { echo $dif_inc = $sales_incd->sales_incd - $sales_inc->sales_inc; }else{ echo $dif_inc = $sales_inc->sales_inc - $sales_incd->sales_incd; } ?></td>
							<td style="text-align:right; font-size:16px;"><?php $total_in += $dif_inc; if($co_in === $num_inco) { echo $total_in; } ?></td>
					</tr>
								
							<?php	} 
							if( $total_ex > $_tot_in ) { ?>
					<tr>
						<th style="font-size:16px;" colspan="2">Gross Loss</th>
						<th style="text-align:right; font-size:16px;"><?php echo $total_ex - $_tot_in ; ?></th>
					</tr>
						<?php } ?> 	
					<tr>
						<td colspan="2" style="text-align:right; font-size:16px;">Total : - </td>
						<td style="text-align:right; font-size:16px;"><?php if( $total_ex < $_tot_in ) { echo $_tot_in; }else if( $total_ex > $_tot_in ){ echo $total_ex; } ?></td>
					</tr>
					</tbody>
				</table>
	
	
	
<?php	
	exit;