<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); error_reporting(0); ?>

<section class="content-header">
      <h1>
        Manage Prefix
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
	<?php if(isset($_SESSION['emsg'])){ ?>
	<div class="alert alert-danger" id="fade">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<?php echo $_SESSION['emsg']; ?>
	</div>
	<?php } unset($_SESSION['emsg']);?>
	<?php if(isset($_SESSION['msg'])){ ?>
	<div class="alert alert-success" id="fade">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<?php echo $_SESSION['msg']; ?>
	</div>
	<?php } unset($_SESSION['msg']);?>
	<div class="row">
		<div class="col-md-12">
		<div class="box box-primary">
			<form action="Process/add_prefix_pro.php" method="post">
				<div class="box-body">
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" class="form-control input-sm" id="" placeholder="Serial Name" name="serial_name" required />
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" class="form-control input-sm" id="" placeholder="Prefix_code" name="prefix_code" required />
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="number" class="form-control input-sm" id="" placeholder="Total_page_invoice" name="t_p_invoice" required />
						</div>
					</div>
					<div class="box-body">
					<div class="col-md-12">
						<button type="submit" name="com_button" class="btn btn-primary">Submit</button>
					</div>	
					</div>
				</div>
			</div>
			
		</form>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
				<div class="box" style="overflow-x:scroll;">
				
					<table id="" class="table table-bordered table-hover" style="margin-bottom:0px;">
						<thead style="background-color:#3c8dbc;">
							<tr>
							<th colspan="">Manage</th>
						  <th>Sr_No.</th>
						  <th>Serial Name</th>
						  <th>Prefix Code</th>
						  <th>Sufix Code</th>
						  <th>Total Page/Invoice</th>
						  
						</tr>
						</thead>
<!-- pagination  -->

<?php
	$tbl_name="prefix_master";
		
	
	$adjacents = 10;
	
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT COUNT(*) as num FROM $tbl_name";
	$total_pages = mysqli_fetch_array(mysqli_query($con,$query));
	$total_pages = $total_pages['num'];
	
	/* Setup vars for query. */
	$targetpage = "manage_prefix.php"; 	//your file name  (the name of this file)
	$limit = 5; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "SELECT * FROM $tbl_name LIMIT $start, $limit";
	$result = mysqli_query($con,$sql);
	
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;							//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	
	$pagination = "";
	
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<li class=\"paginate_button Next\">
									<a href=\"$targetpage?page=$prev\">Previous</a>
							</li>";
		else
			$pagination.= "<li class=\"paginate_button previous disabled\"><a href=\"javascript:;\">Previous</a></li>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<li class=\"paginate_button active\"><a href=\"javascript:;\">$counter</a></li>";
				else
					$pagination.= "<li class=\"paginate_button\"><a href=\"$targetpage?page=$counter\">$counter</a></li>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class=\"paginate_button active\"><a href=\"javascript:;\">$counter</a></li>";
					else
						$pagination.= "<li class=\"paginate_button active\"><a href=\"$targetpage?page=$counter\">$counter</a></li>";					
				}
				$pagination.= "...";
				$pagination.= "<li class=\"paginate_button\"><a href=\"$targetpage?page=$lpm1\">$lpm1</a></li>";
				$pagination.= "<li class=\"paginate_button\"><a href=\"$targetpage?page=$lastpage\">$lastpage</a></li>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<li class=\"paginate_button\"><a href=\"$targetpage?page=1\">1</a></li>";
				$pagination.= "<li class=\"paginate_button\"><a href=\"$targetpage?page=2\">2</a></li>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class=\"paginate_button active\"><a href=\"javascript:;\">$counter</a></li>";
					else
						$pagination.= "<li class=\"paginate_button\"><a href=\"$targetpage?page=$counter\">$counter</a></li>";					
				}
				$pagination.= "...";
				$pagination.= "<li class=\"paginate_button\"><a href=\"$targetpage?page=$lpm1\">$lpm1</a></li>";
				$pagination.= "<li class=\"paginate_button\"><a href=\"$targetpage?page=$lastpage\">$lastpage</a></li>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<li class=\"paginate_button\"><a href=\"$targetpage?page=1\">1</a></li>";
				$pagination.= "<li class=\"paginate_button\"><a href=\"$targetpage?page=2\">2</a></li>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class=\"paginate_button active\"><a href=\"javascript:;\">$counter</a></li>";
					else
						$pagination.= "<li class=\"paginate_button active\"><a href=\"$targetpage?page=$counter\">$counter</a></li>";
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<li class=\"paginate_button Next\">
									<a href=\"$targetpage?page=$next\">Next</a>
							</li>";
		else
			$pagination.= "<li class=\"paginate_button previous disabled\"><a href=\"javascript:;\">Next</a></li>";
		$pagination.= "</div>\n";		
	}
	
?>
 						
<!-- pagination  --> 						
						<tbody>
							<?php $sr_n = 0; while($res_no = mysqli_fetch_object($result)){ $sr_n++;?>
									<tr>
									<td><a href="edit_prefix.php?edit_prefix_id=<?php echo $res_no->prefix_id; ?>"><button type="button" class="btn btn-info btn-sm">Edit</button></a> &nbsp;<a href="Process/delete.php?del_prefix_id=<?php echo $res_no->prefix_id; ?>" onclick="return confirm('Are you sure you want to delete this Prefix ?');"><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td>
										<td> <?php echo $sr_n; ?></td>
										<td><?php echo $res_no->serial_name; ?></td>
										<td><?php echo $res_no->prefix_code; ?></td>
										<td><?php echo $prefix; ?></td>
										<td><?php echo $res_no->total_page; ?></td>
									</tr>
							<?php }	?>
						</tbody>
						
						<tfoot>
							<tr>
								<th colspan="6">
								
									<div class="dataTables_paginate paging_simple_numbers">
									<ul class="pagination pull-right">
										<?=$pagination?>
									</ul>
							</div>
								</th>
							</tr>
						</tfoot>
					</table>
						
				</div>
			</div>
	</div>

    </section> <!-- /.content -->





<?php include_once('footer.php'); ?>