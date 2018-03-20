<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); error_reporting(0);?>

    <section class="content-header">
      <h1>
        Manage Sales Invoice 
       </h1>
      
    </section>
    <form method="post" action="Process/downloads.php">
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
					<a href="add_sales_invoice.php"><h3 class="box-title">Add Sales Invoice</h3></a>
				</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Account Name </label>
						  <input type="text" class="form-control" id="magage_sales_id" name="manage_sales" placeholder="Account Name">
						  <input type="hidden" id="manage_sales_id_hidden" name="manage_sales_hidden"/>

						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Date Range</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control" id="sales_date_range"data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
								</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Project Name</label>
							    <select name="client_sale_type" id="sales_project_name" onchange="searchFilter()" class="form-control">
									<option value="0">-- Select Project Name --</option>
									<?php while($sel_projectsr = $sel_projects->fetch_object()){ ?>
											<option value="<?php echo $sel_projectsr->project_id; ?>"><?php echo $sel_projectsr->project_name; ?></option>
										<?php } ?>
								</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							
						  
						 
						  <label for="">Sales Invoice NO</label>
						  <input type="text" class="form-control" id="sales_qo_no" name="" placeholder="Sales Invoice No.">
						</div>
					</div>
					
				
			</div>
			<div class="box-body">
					<div class="box-footer">
						<div class="col-md-3">
							<div class="form-group">
								<a onclick="searchFilter()" id="sales_invoic" class="btn btn-primary">Search</a>
								<a onclick="reset()" class="btn btn-primary btn-danger">Reset Search</a>
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
						<div class="col-md-1 pull-right">
							<button type="submit">Download</button>
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
	
<!-- pagination  -->				
				
	
 						
<!-- pagination  --> 						
				

						
								
            </div>
			</div>
		
</section>
</form>
<script>
window.onload = function(){searchFilter();};
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#manage_sales_id_hidden').val();
	var project = $('#sales_project_name').val();
	var date = $('#sales_date_range').val();
	var pi_no = $('#sales_qo_no').val();
    var sortBy = $('#sortBy').val();
	var num_rows = $('#num_rows').val();
	if(keywords != '' || project != '0' || date != '' || pi_no != '' || sortBy != '')
	{
    $.ajax({
        type: 'POST',
        url: 'manage_search/manage_sale_search.php',
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
		$('#sales_date_range').daterangepicker({
			autoUpdateInput: false,
			locale: {
            format: 'DD/MM/YYYY',
			cancelLabel: 'Clear'
			}
		});
		
			$('#sales_date_range').on('apply.daterangepicker', function(ev, picker) {
				$(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
			});

			$('#sales_date_range').on('cancel.daterangepicker', function(ev, picker) {
				$(this).val('');
			});
		
	});
	function reset(){	
window.location.href = location.pathname.substring(location.pathname.lastIndexOf("/") + 1);
}
</script>


<script src="plugins/search/manage_sales_invoice_auto.js" ></script>


<?php include_once('footer.php'); ?>