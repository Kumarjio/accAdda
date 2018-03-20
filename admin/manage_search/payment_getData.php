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
	$project = $_POST['project'];
	$date = $_POST['purchase_project_date'];
    $sortBy = $_POST['sortBy'];
	
		if(!empty($keywords)){
			$whereSQL = "and act_id = '".$keywords."'";
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
				$whereSQL .= "and p_date between '".$date1."' AND '".$date2."'";
			}
			
			if(!empty($keywords))
			{
				$whereSQL .= "and p_date between '".$date1."' AND '".$date2."'";
			}
			if($project != '0')
			{
				$whereSQL .= "and p_date between '".$date1."' AND '".$date2."'";
			}
		}
		
		if(!empty($sortBy)){
			$orderSQL = " ORDER BY id ".$sortBy;
		}else{
			$orderSQL = " ORDER BY id DESC ";
		}
	
    //get number of rows
    $queryNum = $conn->query("SELECT COUNT(*) as postNum FROM payment_mst where `df` = '0' and c_id = '".$_SESSION['company_id']."' ".$whereSQL.$orderSQL);
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
    $query = $conn->query("SELECT * FROM payment_mst where `df` = '0' and c_id = '".$_SESSION['company_id']."' $whereSQL $orderSQL LIMIT $start,$limit");
    
		if($query->num_rows > 0){ ?>
			<table id="" class="table table-bordered table-hover">
                <thead style="background-color:#3c8dbc;">
					<tr>
							<th>Manage</th>
							  <th>Account Name</th>
							  <th>Amount</th>
							  <th>Payment Mode</th>
							  <th>Bank Name</th>
							  <th>Cheque No.</th>
							  <th>Project Name</th>
							  <th>Date</th>
							  
					</tr>
                </thead>
				<tbody>
					<?php while($row = $query->fetch_assoc()){ $postID = $row['id']; ?>
					<?php $proj_name=$con->query("SELECT * FROM `project_master` WHERE project_id = '".$row['prj_id']."'")->fetch_object();?>
						<tr>
						<td style="text-align:center;"><a href="view_pay_fi.php?id=<?php echo $row['id']; ?>" ><button type="button" class="btn btn-default btn-sm">View</button></a> &nbsp;<a href="Process/delete.php?del_payment_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this Detail ?');"><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td>
							<td><?php echo $row['act_name']; ?></td>
							<td><?php echo $row['amount']; ?></td>
							<td><?php echo $row['mode']; ?></td>
							<td><?php echo $row['bank_name']; ?></td>
							<td><?php echo $row['chk_no']; ?></td>
							<td><?php if(!empty($row['prj_id'])){ echo $proj_name->project_name; } ?></td>
							<td><?php echo $row['p_date']; ?></td>
					
						</tr>
					<?php } ?>
				</tbody>
				
				<tfoot>
				<tr><td colspan="8"><?php echo $pagination->createLinks(); ?></td></tr>
				</tfoot>
				
			</table>
<?php 	}else{ ?>
			<div class="box-header with-border">
				<h3 style="text-align:center; margin:0;">No Data Found</h3>
			</div>
<?php } } ?>