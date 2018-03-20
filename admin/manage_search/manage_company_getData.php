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
    $pi_no = $_POST['contact_number'];
	$project = $_POST['email'];
	
    $sortBy = $_POST['sortBy'];
	if(!empty($keywords))
	{
		$whereSQL = "WHERE company_id = '".$keywords."' and flag = '0' ";
	}
	
	else if(!empty($project))
	{
		$whereSQL = "WHERE comp_email = '".$project."'  and flag = '0' ";
	}
	else if(!empty($pi_no))
	{
		$whereSQL = "WHERE contact_no = '".$pi_no."'  and flag = '0' ";
	}
	
	else{
		$whereSQL = "WHERE flag = '0'";
	}
		if(!empty($sortBy)){
			$orderSQL = " ORDER BY company_id ".$sortBy;
		}else{
			$orderSQL = " ORDER BY company_id DESC ";
		}
	
	
    //get number of rows
    $queryNum = $con->query("SELECT COUNT(*) as postNum FROM company_mas ".$whereSQL.$orderSQL);
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
    $query = $con->query("SELECT * FROM company_mas $whereSQL $orderSQL LIMIT $start,$limit");
    
		if($query->num_rows > 0){ ?>
			<table id="" class="table table-bordered table-hover">
                <thead style="background-color:#3c8dbc;">
					<tr>
						<th style="text-align:center;">Manage</th>
						<th>Company Name</th>
						<th>Contact No.</th>
						<th>Email Id</th>
						<th>Contact Person Name</th>
						<th>Contact Person No.</th>
					</tr>
                </thead>
				<tbody>
					<?php while($row = $query->fetch_assoc()){ $postID = $row['company_id']; ?>
						<tr>
							<td style="text-align:center;"><a href="view_company.php?view_company_id=<?php echo $row['company_id'] ; ?>"><button type="button" class="btn btn-default btn-sm">View</button></a> &nbsp;<a href="edit_companny.php?edit_com_id=<?php echo $row['company_id']; ?>"><button type="button" class="btn btn-info btn-sm">Edit</button></a> &nbsp;<a href="Process/delete.php?del_com_id=<?php echo $row['company_id']; ?>" onclick="return confirm('Are you sure you want to delete this Company ?');"><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td>
							<td><?php echo $row['company_name']; ?></td>
							<td><?php echo $row['contact_no']; ?></td>
							<td><?php echo $row['comp_email']; ?></td>
							<td><?php echo $row['contact_person_name']; ?></td>
							<td><?php echo $row['contact_person_no']; ?></td>
							
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