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
    $pi_no = $_POST['pi_no'];
	$project = $_POST['project'];
	$date = $_POST['purchase_project_date'];
    $sortBy = $_POST['sortBy'];
	if(!empty($pi_no))
	{
		$whereSQL = "and s_numner = '".$pi_no."'";
	}
	else
	{
		if(!empty($keywords)){
			$whereSQL = "and act_no = '".$keywords."'";
		}
		if($project != "0"){
			if(!empty($keywords)){
			$whereSQL .= "and prj_id = '".$project."'";
			}else{
				$whereSQL .= "and prj_id = '".$project."'";
			}
		}
		
		if(!empty($date)){
			$dates = explode("-", $date);
			$date1 = trim($dates[0]);
			$date2 = trim($dates[1]);
			if(empty($keywords) && $project == '0')
			{
				$whereSQL .= "and due_date between '".$date1."' AND '".$date2."'";
			}
			
			if(!empty($keywords))
			{
				$whereSQL .= "and due_date between '".$date1."' AND '".$date2."'";
			}
			if($project != '0')
			{
				$whereSQL .= "and due_date between '".$date1."' AND '".$date2."'";
			}
		}
		
		
	}
	
	if(!empty($sortBy)){
			$orderSQL = " ORDER BY s_id ".$sortBy;
		}else{
			$orderSQL = " ORDER BY s_id DESC ";
		}
    //get number of rows
    $queryNum = $conn->query("SELECT COUNT(*) as postNum FROM n_quat_mst where usage_flag = '0' and c_id = '".$_SESSION['company_id']."' ".$whereSQL.$orderSQL);
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
    
    //get rows
    $query = $conn->query("SELECT * FROM n_quat_mst where usage_flag = '0' and c_id = '".$_SESSION['company_id']."' $whereSQL $orderSQL LIMIT $start,$limit");
    
		if($query->num_rows > 0){ ?>
			<table id="" class="table table-bordered table-hover">
                <thead style="background-color:#3c8dbc;">
					<tr>
						<th style="text-align:center;">Manage</th>
						<th>Invoice No.</th>
						<th>Account Name</th>
						<th>Project Name</th>
						<th>Total Amount</th>
						<th>Date</th>
					</tr>
                </thead>
				<tbody>
					<?php while($row = $query->fetch_assoc()){ $postID = $row['s_id']; $account = $con->query("select * from client_master where client_id = '".$row['act_no']."'")->fetch_object(); $prj_name = $con->query("select * from project_master where project_id = '".$row['prj_id']."'")->fetch_object();?>
						<tr>
							<td style="text-align:center;"><a href="qu_invoice.php?id=<?php echo $row['s_id']; ?>" ><button type="button" class="btn btn-default btn-sm">View</button></a> &nbsp;<a href="edit_qu.php?id=<?php echo $row['s_id']; ?>"><button type="button" class="btn btn-info btn-sm">Edit</button></a> &nbsp;<a href="Process/delete.php?del_qu_id=<?php echo $row['s_id']; ?>" onclick="return confirm('Are you sure you want to delete this Quatation ?');"><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td>
							<td><?php echo $row['s_numner']; ?></td>
							<td><?php if(!empty($row['act_no'])) { echo $account->client_name; } else{ echo "-"; } ?></td>
							<td><?php if(!empty($row['prj_id'])){ echo $prj_name->project_name; } else{ echo "-"; } ?></td>
							<td><?php echo $row['total_amt']; ?></td>
							<td><?php echo $row['s_date']; ?></td>
						</tr>
					<?php } ?>
				</tbody>
				
				<tfoot>
				<tr><td colspan="6"><?php echo $pagination->createLinks(); ?></td></tr>
				</tfoot>
				
			</table>
<?php 	}else{ ?>
			<div class="box-header with-border">
				<h3 style="text-align:center; margin:0;">No Data Found</h3>
			</div>
<?php } } ?>