<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php error_reporting(0);?>


<section class="content-header">
      <h1>
         View Challan
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
					<div class="box-body">
						<div class="box-header with-border">
							<a href="AddNewChallan.php" ><h3 class="box-title">Add New Challan</h3></a>
						</div>
							
									<div class="col-md-6">
										<div class="form-group">
											<label for="">Account Name </label>
											<input type="text" class="form-control" id="acc_name_view_quatation" name="" placeholder="Enter Account Name" autocomplete="off" spellcheck="false">
											<input type="hidden" id="view_quatation_client_id" />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Date Range:</label>
											<div class="input-group">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" id="date_range" class="form-control" autocomplete="off" spellcheck="false">	
											</div>
										</div>	
									</div>
							
							
									<div class="col-md-6">
										<div class="form-group">
											<label>Project Name</label>
												<select name="client_ac_type" id="project_id" onchange="searchFilter()" class="form-control">
													<option value="0">-- Select Project Name --</option>
													<?php while($sel_projectsr = $sel_projects->fetch_object()){ ?>
														<option value="<?php echo $sel_projectsr->project_id; ?>"><?php echo $sel_projectsr->project_name; ?></option>
													<?php } ?>
												</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
										  <label for="">CH NO</label>
										  <input type="text" class="form-control" id="chalan_no_auto" name="" autocomplete="off" spellcheck="false" placeholder="Enter Chalan No.">
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
	
      	
    </section> <!-- /.content -->
<script>
window.onload = function(){searchFilter();};
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#view_quatation_client_id').val();
	var project = $('#project_id').val();
	var date = $('#date_range').val();
	var pi_no = $('#chalan_no_auto').val();
    var sortBy = $('#sortBy').val();
	var num_rows = $('#num_rows').val();
	if(keywords != '' || project != '0' || date != '' || pi_no != '' || sortBy != '')
	{
    $.ajax({
        type: 'POST',
        url: 'manage_search/getData_chalan.php',
        data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&project='+project+'&purchase_project_date='+date+'&pi_no='+pi_no+'&num_rows='+num_rows,
        success: function (html) {
					$('#row_pur_in').fadeIn('slow');
					$('#result_purchase').html(html);
        }
    });
	}
}
</script>
<script>
	$(document).ready(function(){
		$('#date_range').daterangepicker({
			autoUpdateInput: false,
			locale: {
            format: 'DD/MM/YYYY',
			cancelLabel: 'Clear'
			}
		});
		
			$('#date_range').on('apply.daterangepicker', function(ev, picker) {
				$(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
			});

			$('#date_range').on('cancel.daterangepicker', function(ev, picker) {
				$(this).val('');
			});
		
	});
	function reset(){	
window.location.href = location.pathname.substring(location.pathname.lastIndexOf("/") + 1);
}
</script>

<script src="plugins/search/view_challan_auto.js" ></script>

<?php include_once('footer.php'); ?>

