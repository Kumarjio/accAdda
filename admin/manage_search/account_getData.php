<?php

    include('../config/config2.php');
    $keywords = $_POST['keywords'];
	$date = $_POST['purchase_project_date'];
	$sql = '';
	if(!empty($date))
	{
	$dates = explode("-", $date);
	$date1 = trim($dates[0]);
	$date2 = trim($dates[1]);
	$sql = "AND `l_date` BETWEEN '".$date1."' AND '".$date2."'";
	}
	$glcode = array();
	$ids = $conn->query("SELECT distinct(gl_code) FROM `".$keywords."` WHERE c_id='".$_SESSION['company_id']."' ".$sql);
	if( $ids->num_rows > 0)
	{
	while($idsa = $ids->fetch_object())
	{
		array_push($glcode,$idsa->gl_code);
	}
	
	foreach($glcode as $debit_ar)
	{
		$account = $con->query("select * from client_master where client_id = '".$debit_ar."'")->fetch_object();
		$debit = $conn->query("SELECT sum(debit_amt) as debittotal FROM `".$keywords."` WHERE c_id='".$_SESSION['company_id']."' AND credit_amt = '0.00' AND gl_code='".$debit_ar."'")->fetch_object();
		$credit = $conn->query("SELECT sum(credit_amt) as credittotal FROM `".$keywords."` WHERE c_id='".$_SESSION['company_id']."' AND debit_amt = '0.00' AND gl_code='".$debit_ar."'")->fetch_object();
		if($debit->debittotal > $credit->credittotal)
		{
			$value_big = $debit->debittotal;
			$extra = $debit->debittotal - $credit->credittotal; 
		}
		else
		{
			$value_big = $credit->credittotal;
			$extra = $credit->credittotal - $debit->debittotal;
		}

		?>
		<div class="col-md-6">
		<style>#data_pl >td{ font-size:18px; }</style>
			<div class="box" id="result_purchase" style="overflow-x:scroll;">
			<table id="data_pl" class="table table-bordered table-hover" style="margin-bottom:0px;">
                <thead style="background-color:#3c8dbc;">
					<tr>
						<th>Particulars</th>
						<th>Debit</th>
					</tr>
                </thead>
				<tbody>
					<tr>
						<td colspan="" >A/c. <?php echo ucwords($account->client_name); ?></td>
						<td></td>
					</tr>
					<tr>
						<td>Credit :-</td>
						<td><?php if($debit->debittotal < $credit->credittotal){ echo $extra; }else { echo "-"; } ?></td>
					</tr>
					<tr>
						<td>Total :-</td>
						<td><?php echo $value_big; ?></td>
					</tr>
				</tbody>
			</table>
			</div>
		</div>
		<div class="col-md-6">
		<style>#data_pl >td{ font-size:18px; }</style>
			<div class="box" id="result_purchase" style="overflow-x:scroll;">
			<table id="data_pl" class="table table-bordered table-hover" style="margin-bottom:0px;">
                <thead style="background-color:#3c8dbc;">
					<tr>
						<th>Particulars</th>
						<th>Credit</th>
					</tr>
                </thead>
				<tbody>
					<tr>
						<td>A/c. <?php echo ucwords($account->client_name); ?></td>
						<td></td>
					</tr>
					<tr>
						<td>Debit :-</td>
						<td><?php if($debit->debittotal > $credit->credittotal){ echo $extra; } else { echo "-"; }?></td>
					</tr>
					<tr>
						<td>Total :-</td>
						<td><?php echo $value_big; ?></td>
					</tr>
				</tbody>
			</table>
			</div>
		</div>
		<?php
	}
	}else
	{ ?>
	<div class="col-md-12">
		<div class="box" id="result_purchase" style="overflow-x:scroll;">
			<div class="box-header with-border">
				<h3 style="text-align:center; margin:0;">No Data Found</h3>
			</div>
		</div>
	</div>
	<?php
}
?>
	