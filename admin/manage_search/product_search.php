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
    $size = $_POST['size'];
	$catg = $_POST['catg'];
    $sortBy = $_POST['sortBy'];
	if(!empty($keywords))
	{
		$whereSQL = "WHERE product_id = '".$keywords."' and flag = '0'";
	}
	else
	{
		if(!empty($size)){
			$whereSQL = "WHERE product_size = '".$size."' and flag = '0'";
		}
		if($catg != "0"){
			if(!empty($size)){
			$whereSQL .= "and product_catagory = '".$catg."' and flag = '0'";
			}else{
				$whereSQL .= "where product_catagory = '".$catg."' and flag = '0'";
			}
		}
	}
	if(empty($keywords) && empty($size) && $catg == "0")
	{
		$whereSQL .= "where flag = '0'";
	}		
		if(!empty($sortBy)){
			$orderSQL = " ORDER BY product_id ".$sortBy;
		}else{
			$orderSQL = " ORDER BY product_id DESC ";
		}
    //get number of rows
    $queryNum = $con->query("SELECT COUNT(*) as postNum FROM product_master ".$whereSQL.$orderSQL);
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
    $query = $con->query("SELECT * FROM product_master $whereSQL $orderSQL LIMIT $start,$limit");
    
		if($query->num_rows > 0){ ?>
			<table id="" class="table table-bordered table-hover" style="margin-bottom:0px;">
                <thead style="background-color:#3c8dbc;">
					<tr>
							<th style="text-align:center;">Manage</th>
							  <th>Product Name</th>
							  <th>HSN/SAC</th>
							  <th>GST Rate</th>
							  <th>Description</th>
							  <th>Unit</th>
							  <th>Size</th>
							  <th>Category</th>
					</tr>
                </thead>
				<tbody>
					<?php while($row = $query->fetch_assoc()){ $postID = $row['product_id']; ?>
						<tr>
						<td style="text-align:center;"><a href="edit_product.php?update_product_id=<?php echo $row['product_id']; ?>"><button type="button" class="btn btn-info btn-sm">Edit</button></a> &nbsp;<a onclick="return confirm('Are you sure you want to delete this Product ?');"  href="Process/delete.php?project_d_id=<?php echo $row['product_id']; ?>" ><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td>
							<td><?php echo $row['product_name']; ?></td>
							<td><?php echo $row['HSN']; ?></td>
							<td><?php echo $row['rate']; ?> %</td>
							<td><?php echo nl2br($row['product_desc']); ?></td>
							<td><?php echo $row['product_unit']; ?></td>
							<td><?php if(!empty($row['product_size'])){ echo $row['product_size']; }else { echo "- -"; } ?></td>
							<td><?php if(!empty($row['product_catagory'])){ echo $row['product_catagory'];}else { echo "- -"; }  ?></td>
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