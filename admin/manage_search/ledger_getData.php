<?php

    include('../config/config2.php');
    $keywords = $_POST['keywords'];
	$date = $_POST['purchase_project_date'];
	$account_type = $con->query('select * from client_master where client_id = "'.$keywords.'"')->fetch_object();
	$sql = '';
	if(!empty($date))
	{
		$dates = explode("-", $date);
		$date1 = trim($dates[0]);
		$date2 = trim($dates[1]);
		$sql = "AND l_date between '".$date1."' AND '".$date2."'";
	}
		$query = $conn->query("SELECT * FROM `".$account_type->client_ac_type."` WHERE c_id='".$_SESSION['company_id']."' AND credit_amt = '0.00' AND gl_code = '".$keywords."'".$sql);
		$query_c = $conn->query("SELECT * FROM `".$account_type->client_ac_type."` WHERE c_id='".$_SESSION['company_id']."' AND  debit_amt = '0.00' AND gl_code = '".$keywords."'".$sql);
		
		
		if($query->num_rows > 0){ ?>
		<div class="col-md-6">
			<div class="box" id="result_purchase" style="overflow-x:scroll;">
			<table id="" class="table table-bordered table-hover" style="margin-bottom:0px;">
                <thead style="background-color:#3c8dbc;">
					<tr>
						<th>Invoice No.</th>
						<th>Date</th>
						<th>Particulars</th>
						<th>Debit</th>
					</tr>
                </thead>
				<tbody>
					<?php $debit_sum = 0; while($row = $query->fetch_assoc()){ $ac_n = $con->query('select * from client_master where client_id = "'.$row['debit_name'].'"')->fetch_object() ?>
						<tr>
							<td><?php echo $row['inv_id']; ?></td>
							<td><?php echo $row['l_date']; ?></td>
							<td><?php if(!empty($ac_n->client_name)){ ?>By <?php echo $ac_n->client_name; } ?></td>
							<td><?php if(!empty($row['debit_amt'])){ echo $row['debit_amt'];} $debit_sum += $row['debit_amt'];?></td>
						</tr>
					<?php } ?>
				</tbody>
				
				<tfoot style="background-color:#3c8dbc;">
				<tr><th colspan="2"></th><th colspan="">Total :-</th><th colspan=""><?php echo $debit_sum; ?></th></tr>
				</tfoot>
				
			</table>
			</div>
		</div>
<?php 	}else{ ?>
<div class="col-md-6">
			<div class="box" id="result_purchase" style="overflow-x:scroll;">
			<div class="box-header with-border">
				<h3 style="text-align:center; margin:0;">No Data Found</h3>
			</div>
			</div>
			</div>
<?php } 

if($query_c->num_rows > 0){ ?>
		<div class="col-md-6">
			<div class="box" id="result_purchase" style="overflow-x:scroll;">
			<table id="" class="table table-bordered table-hover" style="margin-bottom:0px;">
                <thead style="background-color:#3c8dbc;">
					<tr>
						<th>Invoice No.</th>
						<th>Date</th>
						<th>Particulars</th>
						<th>Credit</th>
					</tr>
                </thead>
				<tbody>
					<?php $credit_sum = 0; while($rowc = $query_c->fetch_assoc()){ $ac_nc = $con->query('select * from client_master where client_id = "'.$rowc['credit_name'].'"')->fetch_object() ?>
						<tr>
							<td><?php echo $rowc['inv_id']; ?></td>
							<td><?php echo $rowc['l_date']; ?></td>
							<td><?php if(!empty($ac_nc->client_name)){ ?>By <?php echo $ac_nc->client_name; }?></td>
							<td><?php if(!empty($rowc['credit_amt'])){ echo $rowc['credit_amt']; } $credit_sum += $rowc['credit_amt'];?></td>
						</tr>
					<?php } ?>
				</tbody>
				
				<tfoot style="background-color:#3c8dbc;">
				<tr><th colspan="2"></th><th colspan="">Total :-</th><th colspan=""><?php echo $credit_sum; ?></th></tr>
				</tfoot>
				
			</table>
			</div>
		</div>
<?php 	}else{ ?>
		<div class="col-md-6">
			<div class="box" id="result_purchase" style="overflow-x:scroll;">
			<div class="box-header with-border">
				<h3 style="text-align:center; margin:0;">No Data Found</h3>
			</div>
			</div>
			</div>
<?php } ?>