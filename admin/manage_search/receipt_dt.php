<?php


    include('../config/config2.php');
   
$query = $conn->query("SELECT * FROM `sales_mst` WHERE act_no = '".$_POST['keywords']."' and cut_amt != '0.00' and c_id = '".$_SESSION['company_id']."'");
		if($query->num_rows > 0){ ?>
			<table id="" class="table table-bordered table-hover" style="margin-bottom:0px;">
                <thead style="background-color:#3c8dbc;">
					<tr>
							  <th>Account Name</th>
							  <th>Bill No</th>
							  <th>Bill Date</th>
							  <th>Total Amount</th>	  
							  <th>Panding Amount</th>	  
					</tr>
                </thead>
				<tbody>
					<?php while($row = $query->fetch_assoc()){ $postID = $row['s_id']; $account = $con->query("select * from client_master where client_id = '".$row['act_no']."'")->fetch_object(); $prj_name = $con->query("select * from project_master where project_id = '".$row['prj_id']."'")->fetch_object();?>
						<tr>
							<td><?php echo $account->client_name; ?></td>
							<td><?php echo $row['s_numner']; ?></td>
							<td><?php echo $row['s_date']; ?></td>
							<td><?php echo $row['total_amt']; ?></td>
							<td><?php echo $row['cut_amt']; ?></td>
						</tr>
					<?php } ?>
				</tbody>
				
			
				
			</table>
<?php 	}else{ ?>
			<div class="box-header with-border">
				<h3 style="text-align:center; margin:0;">No Data Found</h3>
			</div>
<?php }  ?>