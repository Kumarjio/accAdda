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
    $email = $_POST['email'];
    $sortBy = $_POST['sortBy'];
	if(!empty($keywords))
	{
		$whereSQL = "WHERE project_name = '".$keywords."' and flag = '0'";
	}
	else if (!empty($email)){
		$whereSQL = "WHERE email = '".$email."' and flag = '0'";
	}
	if(empty($keywords) && empty($email))
	{
		$whereSQL .= "where flag = '0'";
	}	
	
		if(!empty($sortBy)){
			$orderSQL = " ORDER BY project_id ".$sortBy;
		}else{
			$orderSQL = " ORDER BY project_id DESC ";
		}
    //get number of rows
   $queryNum = $con->query("SELECT COUNT(*) as postNum FROM project_master ".$whereSQL.$orderSQL);
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
    $query = $con->query("SELECT * FROM project_master $whereSQL $orderSQL LIMIT $start,$limit");
    
		if($query->num_rows > 0){ ?>
			<table id="" class="table table-bordered table-hover" style="margin-bottom:0px;">
                <thead style="background-color:#3c8dbc;">
					<tr>
						<th style="text-align:center;">Manage</th>
						  <th>Project Name</th>
						  <th>Contact Person</th>
						  <th>Contact</th>
						  <th>Email</th>
						  <th>Address</th>
					</tr>
                </thead>
				<tbody>
					<?php while($row = $query->fetch_assoc()){ $postID = $row['project_id']; ?>
						<tr>
							<td style="text-align:center;"><a href="edit_project.php?edit_project_id=<?php echo $row['project_id']; ?>"><button type="button" class="btn btn-info btn-sm">Edit</button></a> &nbsp;<a href="Process/delete.php?pro_del_id=<?php echo $row['project_id']; ?>" onclick="return confirm('Are you sure you want to delete this Project ?');"><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td>
							<td><?php echo $row['project_name']; ?></td>
							<td><?php if(!empty($row['contact_person_name'])){ echo $row['contact_person_name']; }else { echo "- -"; }  ?></td>
							<td><?php if($row['contact_no'] != 0){ echo $row['contact_no']; } else { echo "- -"; } ?></td>
							<td><?php echo $row['email']; ?></td>
							<td><?php  if(!empty($row['address'])){ echo nl2br($row['address']); }else { echo "- -"; } ?></td>
						</tr>
					<?php } ?>
				</tbody>
				
				<tfoot>
				<tr><td colspan="7"><?php echo $pagination->createLinks(); ?></td></tr>
				</tfoot>
				
			</table>
<?php 	}else{ ?>
			<div class="box-header with-border">
				<h3 style="text-align:center; margin:0;">No Data Found</h3>
			</div>
<?php } } ?>