<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); error_reporting(0);?>

	<section class="content-header">
      <h1>
        Manage User
       </h1>
    </section>
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
						<div class="box-header with-border">
							<a href="add_user.php"> <h3 class="box-title">Add user</h3></a>
						</div>
								<div class="box-body">
									<div class="col-md-6">
										<div class="form-group">
											<label for="exampleInputEmail1">User Name</label>
												<input type="text" class="form-control" id="username_user" placeholder="Enter User Name">
										</div>
									</div>
									<div class="col-md-6">  
										<div class="form-group">
											<label for="exampleInputPassword1">Name</label>
												<input type="text" class="form-control" id="wid_magage_product_id" name="product_name_1" placeholder="Enter Name" autocomplete="off" spellcheck="false">
												<input type="hidden" id="wid_magage_product_id_hidden" name="manage_product_hidden"/>
										</div>
									</div>
								</div>
								<div class="box-body">
									<div class="box-footer">
										<div class="col-md-3">
											<div class="form-group">
												<button type="submit" onclick="searchFilter()" id="purchase_invoic" class="btn btn-primary">Search</button>
												<button type="button" onclick="reset()" class="btn btn-primary btn-danger">Reset Search</button>
											</div>
										</div>
										<div class="col-md-2 pull-right">
											<div class="form-group">
												<select id="sortBy" class="form-control" onchange="searchFilter()">
													<option value="desc">Descending</option>
													<option value="asc">Ascending</option>
												</select>
											</div>
										</div>
										<div class="col-md-2 pull-right">
											<div class="form-group">
												<select id="num_rows" class="form-control" onchange="searchFilter()">
													<option value="10">10</option>
													<option value="5">5</option>
													<option value="25">25</option>
													<option value="50">50</option>
													<option value="100">100</option>
												</select>
											</div>
										</div>
									</div>
								</div>
					</div>
				</div>
			</div>
			<div class="row" style="display:none;" id="row_pur_in">
				<div class="col-md-12">
					<div class="box" id="result_purchase" style="overflow-x:scroll;">
					
					</div>
				</div>
			</div>
		
	</section>
	<script>
window.onload = function(){searchFilter();};
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#username_user').val();
	var name = $('#wid_magage_product_id').val();
    var sortBy = $('#sortBy').val();
	var num_rows = $('#num_rows').val();
	if(keywords != '' || name != '0' )
	{
    $.ajax({
        type: 'POST',
        url: 'manage_search/user_search.php',
        data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&name='+name+'&num_rows='+num_rows,
        success: function (html) {
			$('#row_pur_in').fadeIn('slow');
			$('#result_purchase').html(html);
        }
    });
	}
}
function reset(){	
window.location.href = location.pathname.substring(location.pathname.lastIndexOf("/") + 1);
}
</script>
	<script src="plugins/search/wid_manage_user_auto.js" ></script>
<?php include_once('footer.php'); ?>