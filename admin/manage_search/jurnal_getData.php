<?php
if(isset($_POST['page'])){
    //Include pagination class file
    include('Pagination.php');
   
    //Include database configuration file
    include('../config/config2.php');
   
    $start = !empty($_POST['page'])?$_POST['page']:0;
    $limit = $_POST['num_rows'];
    //print_r($_POST);exit;
    //set conditions for search
    $whereSQL = $orderSQL = '';
    $keywords = $_POST['keywords'];
	$date = $_POST['purchase_project_date'];
    $sortBy = $_POST['sortBy'];
	
		
		
		
		
		
		
		
		
		if(!empty($keywords)){
			$whereSQL = " And (`d1` = '".$keywords."' OR `d2` = '".$keywords."' OR `d3` = '".$keywords."' OR `d4` = '".$keywords."' OR `d5` = '".$keywords."' OR `d6` = '".$keywords."' OR `d7` = '".$keywords."' OR `d8` = '".$keywords."' OR `d9` = '".$keywords."' OR `d10` = '".$keywords."' OR `c1` = '".$keywords."'  OR `c2` = '".$keywords."' OR `c3` = '".$keywords."' OR `c4` = '".$keywords."' OR `c5` = '".$keywords."' OR `c6` = '".$keywords."' OR `c7` = '".$keywords."' OR `c8` = '".$keywords."' OR `c9` = '".$keywords."' OR `c10` = '".$keywords."')";
		}
		
		if(!empty($date)){
			$dates = explode("-", $date);
			$date1 = trim($dates[0]);
			$date2 = trim($dates[1]);
			if(!empty($keywords)){
				$whereSQL .= "AND j_date between '".$date1."' AND '".$date2."'";
			}else{
				$whereSQL .= "And j_date between '".$date1."' AND '".$date2."'";
			}
		}
		
		if(!empty($sortBy)){
			$orderSQL = " ORDER BY id ".$sortBy;
		}else{
			$orderSQL = " ORDER BY id DESC ";
		}
    //get number of rows
    $queryNum = $conn->query("SELECT COUNT(*) as postNum FROM journal_mst where c_id = '".$_SESSION['company_id']."'".$whereSQL.$orderSQL);
    $resultNum = $queryNum->fetch_assoc();
    $rowCount = $resultNum['postNum'];

    //initialize pagination class
    $pagConfig = array(
        'currentPage' => $start,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'searchFilter'
    );
    $pagination =  new Pagination($pagConfig);
   // echo "SELECT * FROM journal_mst where c_id = '".$_SESSION['company_id']."' $whereSQL $orderSQL LIMIT $start,$limit";
    //get rows
    $query = $conn->query("SELECT * FROM journal_mst where c_id = '".$_SESSION['company_id']."' $whereSQL $orderSQL LIMIT $start,$limit");
    
		if($query->num_rows > 0){ ?>
		<table id="" class="table table-bordered table-hover">
                <thead style="background-color:#3c8dbc;">
					<tr>
						<th>Date</th>
						<th>Detail</th>
						<th>Debit</th>
						<th>Credit</th>
						<th>Invoice</th>
					</tr>
                </thead>
				<tbody>
<?php while($data = $query->fetch_object()) { ?>
<?php if($data->db1 != '0.00') { ?>
	<tr>
		<td><?php echo $data->j_date; ?></td>
		<td>By <?php $d1 = $con->query("select * from client_master where client_id = '".$data->d1."'")->fetch_object(); echo $d1->client_name; ?></td>
		<td><?php echo $data->db1; ?></td>
		<td>-</td>
		<td></td>
	</tr>
<?php } ?>
<?php if($data->db2 != '0.00') { ?>
	<tr>
		<td>+</td>
		<td>By <?php $d2 = $con->query("select * from client_master where client_id = '".$data->d2."'")->fetch_object(); echo $d2->client_name; ?></td>
		<td><?php echo $data->db2; ?></td>
		<td>-</td>
		<td></td>
	</tr>
<?php } ?>
<?php if($data->db3 != '0.00') { ?>
	<tr>
		<td>+</td>
		<td>By <?php $d3 = $con->query("select * from client_master where client_id = '".$data->d3."'")->fetch_object(); echo $d3->client_name; ?></td>
		<td><?php echo $data->db3; ?></td>
		<td>-</td>
		<td></td>
	</tr>
<?php } ?>
<?php if($data->db4 != '0.00') { ?>
	<tr>
		<td>+</td>
		<td>By <?php $d4 = $con->query("select * from client_master where client_id = '".$data->d4."'")->fetch_object(); echo $d4->client_name; ?></td>
		<td><?php echo $data->db4; ?></td>
		<td>-</td>
		<td></td>
	</tr>
<?php } ?>
<?php if($data->db5 != '0.00') { ?>
	<tr>
		<td>+</td>
		<td>By <?php $d5 = $con->query("select * from client_master where client_id = '".$data->d5."'")->fetch_object(); echo $d5->client_name; ?></td>
		<td><?php echo $data->db5; ?></td>
		<td>-</td>
		<td></td>
	</tr>
<?php } ?>
<?php if($data->db6 != '0.00') { ?>
	<tr>
		<td>+</td>
		<td>By <?php $d6 = $con->query("select * from client_master where client_id = '".$data->d6."'")->fetch_object(); echo $d6->client_name; ?></td>
		<td><?php echo $data->db6; ?></td>
		<td>-</td>
		<td></td>
	</tr>
<?php } ?>
<?php if($data->db7 != '0.00') { ?>
	<tr>
		<td>+</td>
		<td>By <?php $d7 = $con->query("select * from client_master where client_id = '".$data->d7."'")->fetch_object(); echo $d7->client_name; ?></td>
		<td><?php echo $data->db7; ?></td>
		<td>-</td>
		<td></td>
	</tr>
<?php } ?>
<?php if($data->db8 != '0.00') { ?>
	<tr>
		<td>+</td>
		<td>By <?php $d8 = $con->query("select * from client_master where client_id = '".$data->d8."'")->fetch_object(); echo $d8->client_name; ?></td>
		<td><?php echo $data->db8; ?></td>
		<td>-</td>
		<td></td>
	</tr>
<?php } ?>
<?php if($data->db9 != '0.00') { ?>
	<tr>
		<td>+</td>
		<td>By <?php $d9 = $con->query("select * from client_master where client_id = '".$data->d9."'")->fetch_object(); echo $d9->client_name; ?></td>
		<td><?php echo $data->db9; ?></td>
		<td>-</td>
		<td></td>
	</tr>
<?php } ?>
<?php if($data->db10 != '0.00') { ?>
	<tr>
		<td>+</td>
		<td>By <?php $d10 = $con->query("select * from client_master where client_id = '".$data->d10."'")->fetch_object(); echo $d10->client_name; ?></td>
		<td><?php echo $data->db10; ?></td>
		<td>-</td>
		<td></td>
	</tr>
<?php } ?>
<?php if($data->cr1 != '0.00') { ?>
	<tr>
		<td>+</td>
		<td>&emsp;&emsp;To <?php $c1 = $con->query("select * from client_master where client_id = '".$data->c1."'")->fetch_object(); echo $c1->client_name; ?></td>
		<td>-</td>
		<td><?php echo $data->cr1; ?></td>
		<td></td>
	</tr>
<?php } ?>	
<?php if($data->cr2 != '0.00') { ?>
	<tr>
		<td>+</td>
		<td>&emsp;&emsp;To <?php $c2 = $con->query("select * from client_master where client_id = '".$data->c2."'")->fetch_object(); echo $c2->client_name; ?></td>
		<td>-</td>
		<td><?php echo $data->cr2; ?></td>
		<td></td>
	</tr>
<?php } ?>
<?php if($data->cr3 != '0.00') { ?>
	<tr>
		<td>+</td>
		<td>&emsp;&emsp;To <?php $c3 = $con->query("select * from client_master where client_id = '".$data->c3."'")->fetch_object(); echo $c3->client_name; ?></td>
		<td>-</td>
		<td><?php echo $data->cr3; ?></td>
		<td></td>
	</tr>
<?php } ?>
<?php if($data->cr4 != '0.00') { ?>
	<tr>
		<td>+</td>
		<td>&emsp;&emsp;To <?php $c4 = $con->query("select * from client_master where client_id = '".$data->c4."'")->fetch_object(); echo $c4->client_name; ?></td>
		<td>-</td>
		<td><?php echo $data->cr4; ?></td>
		<td></td>
	</tr>
<?php } ?>		
<?php if($data->cr5 != '0.00') { ?>
	<tr>
		<td>+</td>
		<td>&emsp;&emsp;To <?php $c5 = $con->query("select * from client_master where client_id = '".$data->c5."'")->fetch_object(); echo $c5->client_name; ?></td>
		<td>-</td>
		<td><?php echo $data->cr5; ?></td>
		<td></td>
	</tr>
<?php } ?>		
<?php if($data->cr6 != '0.00') { ?>
	<tr>
		<td>+</td>
		<td>&emsp;&emsp;To <?php $c6 = $con->query("select * from client_master where client_id = '".$data->c6."'")->fetch_object(); echo $c6->client_name; ?></td>
		<td>-</td>
		<td><?php echo $data->cr6; ?></td>
		<td></td>
	</tr>
<?php } ?>	
<?php if($data->cr7 != '0.00') { ?>
	<tr>
		<td>+</td>
		<td>&emsp;&emsp;To <?php $c7 = $con->query("select * from client_master where client_id = '".$data->c7."'")->fetch_object(); echo $c7->client_name; ?></td>
		<td>-</td>
		<td><?php echo $data->cr7; ?></td>
		<td></td>
	</tr>
<?php } ?>	
<?php if($data->cr8 != '0.00') { ?>
	<tr>
		<td>+</td>
		<td>&emsp;&emsp;To <?php $c8 = $con->query("select * from client_master where client_id = '".$data->c8."'")->fetch_object(); echo $c8->client_name; ?></td>
		<td>-</td>
		<td><?php echo $data->cr8; ?></td>
		<td></td>
	</tr>
<?php } ?>	
<?php if($data->cr9 != '0.00') { ?>
	<tr>
		<td>+</td>
		<td>&emsp;&emsp;To <?php $c9 = $con->query("select * from client_master where client_id = '".$data->c9."'")->fetch_object(); echo $c9->client_name; ?></td>
		<td>-</td>
		<td><?php echo $data->cr9; ?></td>
		<td></td>
	</tr>
<?php } ?>	
<?php if($data->cr10 != '0.00') { ?>
	<tr>
		<td>+</td>
		<td>&emsp;&emsp;To <?php $c10 = $con->query("select * from client_master where client_id = '".$data->c10."'")->fetch_object(); echo $c10->client_name; ?></td>
		<td>-</td>
		<td><?php echo $data->cr10; ?></td>
		<td></td>
	</tr>
<?php } ?>	
<tr><td colspan="5" ></td></tr>
<?php } ?>			
		</tbody>
		<tfoot>
				<tr><td colspan="5"><?php echo $pagination->createLinks(); ?></td></tr>
		</tfoot>
		</table>
<?php 	}else{ ?>
			<div class="box-header with-border">
				<h3 style="text-align:center; margin:0;">No Data Found</h3>
			</div>
<?php } } ?>