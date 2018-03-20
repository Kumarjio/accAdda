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
    $name = $_POST['name'];
    $sortBy = $_POST['sortBy'];
	if(!empty($keywords))
	{
		$whereSQL = "and username LIKE '%".$keywords."%'";
	}
	else if (!empty($name)){
		$whereSQL = "and full_name LIKE '%".$name."%'";
	}
	
		if(!empty($sortBy)){
			$orderSQL = " ORDER BY user_master_id ".$sortBy;
		}else{
			$orderSQL = " ORDER BY user_master_id DESC ";
		}
    //get number of rows
   $queryNum = $con->query("SELECT COUNT(*) as postNum FROM user_master where df = '0' ".$whereSQL.$orderSQL);
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
    $query = $con->query("SELECT * FROM user_master where df = '0' $whereSQL $orderSQL LIMIT $start,$limit");
    
		if($query->num_rows > 0){ ?>
			<table id="" class="table table-bordered table-hover">
                <thead style="background-color:#3c8dbc;">
							<tr>
								<th>Manage</th>
								<th>Full Name</th>
								<th>User Name</th>
								<th>Image</th>
							</tr>
                </thead>
				<tbody>
					<?php while($row = $query->fetch_assoc()){ $postID = $row['user_master_id']; ?>
						<tr>																									
							<td><a href="edit_user.php?id=<?php echo $postID; ?>"><button type="button" class="btn btn-info btn-sm">Edit</button></a> &nbsp;<a href="Process/delete.php?user_d_id=<?php echo $row['user_master_id']; ?>" onclick="return confirm('Are you sure you want to delete this User ?');"><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td>
							<td><?php echo $row['full_name']; ?></td>
							<td><?php echo $row['username']; ?></td>
							<td><img src="<?php echo $row['user_photo']; ?>" style="width:100px;" /></td>
						</tr>
					<?php } ?>
				</tbody>
				
				<tfoot>
				<tr><td colspan="4"><?php echo $pagination->createLinks(); ?></td></tr>
				</tfoot>
				
			</table>
<?php 	}else{ ?>
			<div class="box-header with-border">
				<h3 style="text-align:center; margin:0;">No Data Found</h3>
			</div>
<?php } } ?>