<?php
if(isset($_POST['page'])){
    //Include pagination class file
    include('Pagination.php');
   
    //Include database configuration file
    include('../config/config2.php');
   
    $start = !empty($_POST['page'])?$_POST['page']:0;
    $limit = 10;
    //print_r($_POST);exit;
    //set conditions for search
    $whereSQL = $orderSQL = '';
    $keywords = $_POST['keywords'];
    $sortBy = $_POST['sortBy'];
		
		if(!empty($sortBy)){
			$orderSQL = " ORDER BY id ".$sortBy;
		}else{
			$orderSQL = " ORDER BY id DESC ";
		}
    //get number of rows
    $queryNum = $con->query("SELECT COUNT(*) as postNum FROM state_code ");
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
    $query = $con->query("SELECT * FROM state_code LIMIT $start,$limit");
    
		if($query->num_rows > 0){ ?>
			<table id="" class="table table-bordered table-hover" style="margin-bottom:0px;">
                <thead style="background-color:#3c8dbc;">
					<tr>
							<th style="text-align:center;">Manage</th>
							  <th>State Name</th>
							  <th>State Code</th>
					</tr>
                </thead>
				<tbody>
					<?php while($row = $query->fetch_assoc()){ $postID = $row['id']; ?>
						<tr>
						<td style="text-align:center;"><a href="edit_s.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-info btn-sm">Edit</button></a></td>
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['code']; ?></td>
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