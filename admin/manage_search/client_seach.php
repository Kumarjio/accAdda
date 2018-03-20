<?php
if(isset($_POST['page'])){
    //Include pagination class file
    include('Pagination.php');
   //print_r($_POST);exit;
    //Include database configuration file
    include('../config/config2.php');
   
    $start = !empty($_POST['page'])?$_POST['page']:0;
    $limit = $_POST['num_rows'];
    //print_r($_POST);exit;
    //set conditions for search
    $whereSQL = $orderSQL = '';
    $keywords = $_POST['keywords'];
    
	$project = $_POST['project'];
	
    $sortBy = $_POST['sortBy'];
		if(!empty($keywords)){
			$whereSQL = "WHERE client_id = '".$keywords."' and dflag = '0'";
		}
		if($project != "0"){
			if(!empty($keywords)){
			$whereSQL .= "and client_ac_type = '".$project."' and dflag = '0' ";
			}else{
				$whereSQL .= "where client_ac_type = '".$project."' and dflag = '0' ";
			}
		}
		if(empty($keywords) && $project == "0")
		{
			$whereSQL = "where dflag = '0' ";
		}
		if(!empty($sortBy)){
			$orderSQL = " ORDER BY client_id ".$sortBy;
		}else{
			$orderSQL = " ORDER BY client_id DESC ";
		}
	
    //get number of rows
    $queryNum = $con->query("SELECT COUNT(*) as postNum FROM client_master ".$whereSQL.$orderSQL);
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
    $query = $con->query("SELECT * FROM client_master $whereSQL $orderSQL LIMIT $start,$limit");
    
		if($query->num_rows > 0){ ?>
			<table id="" class="table table-bordered table-hover">
						<thead style="background-color:#3c8dbc;">
							<tr>
								<th>Manage</th>
								<th>Full Name</th>
								<th>Contact No.</th>
								<th>Email Id</th>
								<th>Address</th>
								<th>Account Type</th>
							</tr>
						</thead>
				<tbody>
					<?php while($row = $query->fetch_assoc()) { $postID = $row['client_id']; 
					if(!empty($row['client_ac_type'])){ $query1 = $con->query("select * from account_type where ac_id = ".$row['client_ac_type'])->fetch_object(); }?>
						<tr>
							<td><a href="view_client_data.php?client_show_id=<?php echo $row['client_id']; ?>" ><button type="button" class="btn btn-default btn-sm">View</button></a><?php if($row['flag'] == 0){ ?> &nbsp;<a href="edit_client.php?id=<?php echo $row['client_id'] ?>"><button type="button" class="btn btn-info btn-sm">Edit</button></a> &nbsp;<a onclick="return confirm('Are you sure you want to delete this Client ?');" href="Process/delete.php?client_d_id=<?php echo $row['client_id']; ?>"><button type="button" class="btn btn-danger btn-sm">Delete</button></a><?php } ?> </td>
							<td><?php echo $row['client_name']; ?></td>
							<td><?php echo $row['client_contact_no']; ?></td>
							<td><?php echo $row['client_email']; ?></td>
							<td><?php echo nl2br($row['client_address']); ?></td>
							<td><?php echo $query1->ac_name; ?></td>
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