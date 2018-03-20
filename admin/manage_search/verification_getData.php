<?php
if(isset($_POST['page'])){
    //Include pagination class file
    include('Pagination.php');
   
    //Include database configuration file
    include('../config/config2.php');
   
    $start = !empty($_POST['page'])?$_POST['page']:0;
    $limit = $_POST['num_rows'];
	$sdate = $_POST['sdate'];
    //print_r($_POST);exit;
    //set conditions for search
    $whereSQL = $orderSQL = '';
	$whereSQL = '';
    $keywords = $_POST['keywords'];
	//$project = $_POST['project'];
	$date = $_POST['purchase_project_date'];
    $sortBy = $_POST['sortBy'];
	
		if(!empty($keywords)){
			$whereSQL = "and project_name = '".$keywords."'";
		}
		
		if(!empty($date)){
			$dates = explode("-", $date);
			$date1 = trim($dates[0]);
			$date2 = trim($dates[1]);
		}
		
		if(!empty($sdate))
		{
			if(empty($keywords))
			{
				$whereSQL .= "and c_date = '".$sdate."'";
			}
			
			if(!empty($keywords))
			{
				$whereSQL .= "and c_date = '".$sdate."'";
			}
		}
		
		if(!empty($sortBy)){
			$orderSQL = " ORDER BY id ".$sortBy;
		}else{
			$orderSQL = " ORDER BY id DESC ";
		}
	
    //get number of rows
	
    $queryNum = $conn->query("SELECT COUNT(*) as postNum FROM ver_mst where c_id = '".$_SESSION['company_id']."' ".$whereSQL.$orderSQL);
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
    $query = $conn->query("SELECT * FROM ver_mst where c_id = '".$_SESSION['company_id']."' $whereSQL $orderSQL LIMIT $start,$limit");
    
		if($query->num_rows > 0){ ?>
			
					<?php while($row = $query->fetch_assoc()){ $postID = $row['id']; ?>
					<?php $proj_name=$con->query("SELECT * FROM `project_master` WHERE project_id = '".$row['project_name']."'")->fetch_object();?>
					<?php $pro_de = $conn->query("SELECT * FROM `ver_detail_mst` WHERE ver_id = '".$postID."'"); ?>
						<table id="" class="table table-bordered table-hover">
                <thead style="background-color:#3c8dbc;">
					<tr>
							  <th>Sended Date</th>
							  <th>Project Name</th>
							  <th>Email ID</th>
							  <th>Manage</th>
							
					</tr>
                </thead>
				<tbody>
						<tr>
							<td><?php echo $row['c_date']; ?></td>
							
							<td><?php echo $proj_name->project_name;?></td>
							
							<td><?php echo $row['email']; ?></td>
							<td><a href="fpdf/ver.php?id=<?php echo $row['id']; ?>" >Download</a> | <a href="fpdf/vmail.php?id=<?php echo $row['id']; ?>" >Mail</a></td>
						</tr>
						<tr>
						<td style="font-size:20px; text-align:center; vertical-align:middle;"><?php echo $proj_name->project_name;?></td>
						<td colspan="3">
							<table id="" class="table table-bordered table-hover">
								<thead style="background-color:#3c8dbc;">
											<tr>
												<th>Date</th>
												<th>Product</th>
												<th>Side</th>
												<th>Channage</th>
												<th>Quantity</th>
												<th>Remark</th>
											</tr>
								</thead>
								<tbody>
									<?php while($pro_der = $pro_de->fetch_object()){ ?>
										<tr>
											<td><?php echo $pro_der->vdate; ?></td>
											<td><?php echo $pro_der->product; ?></td>
											<td><?php echo $pro_der->side; ?></td>
											<td><?php echo $pro_der->chanage; ?></td>
											<td><?php echo $pro_der->qty; ?></td>
											<td><?php echo $pro_der->remark; ?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</td>
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