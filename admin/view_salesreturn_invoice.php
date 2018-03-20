<?php include_once('header.php'); ?>
<?php include_once('sidebar.php');error_reporting(0);?>

    <section class="content-header">
      <h1>
        View Sales Return Invoice 
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
			<div class="box-body">
				<div class="box-header with-border">
					<a href="return_sal_sel.php"><h3 class="box-title">Add Sales Return Invoice</h3></a>
				</div>
				
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Account Name </label>
						  <input type="text" class="form-control" id="sales_return_id" name="" placeholder="Account Name">
						  <input type="hidden" id="sales_return_id_hidden" name="sales_return_hidden"/>

						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Due Date </label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control" id="sales_return" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
								</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Project Name</label>
							    <select name="client_ac_type" id="salesreturn_project"  onchange="searchFilter()" class="form-control">
									<option value="">-- Select Project Name --</option>
									<?php while($sel_projectsr = $sel_projects->fetch_object()){ ?>
											<option value="<?php echo $sel_projectsr->project_id; ?>"><?php echo $sel_projectsr->project_name; ?></option>
										<?php } ?>
								</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Invoice NO.</label>
						  <input type="text" class="form-control" id="sales_return_invoice" name="" placeholder="Sales Invoice No.">
						</div>
					</div>
					
				
			</div>
			<div class="box-body">
					<div class="box-footer">
						<div class="col-md-3">
							<div class="form-group">
								<button type="submit" onclick="searchFilter()" id="sales_invoic" class="btn btn-primary">Search</button>
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
    var keywords = $('#sales_return_id_hidden').val();
	var project = $('#salesreturn_project').val();
	var date = $('#sales_return').val();
	var pi_no = $('#sales_return_invoice').val();
    var sortBy = $('#sortBy').val();
	var num_rows = $('#num_rows').val();
	if(keywords != '' || project != '0' || date != '' || pi_no != '' || sortBy != '')
	{
    $.ajax({
        type: 'POST',
        url: 'manage_search/manage_sale_return_search.php',
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
		$('#sales_return').daterangepicker({
			autoUpdateInput: false,
			locale: {
            format: 'DD/MM/YYYY',
			cancelLabel: 'Clear'
			}
		});
		
			$('#sales_return').on('apply.daterangepicker', function(ev, picker) {
				$(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
			});

			$('#sales_return').on('cancel.daterangepicker', function(ev, picker) {
				$(this).val('');
			});
		
	});
	function reset(){	
window.location.href = location.pathname.substring(location.pathname.lastIndexOf("/") + 1);
}
</script>

<script src="plugins/search/view_sales_return_auto.js"></script>


<?php include_once('footer.php'); ?>