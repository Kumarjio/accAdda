<?php include_once('header.php'); ?>
<?php include_once('sidebar.php');?>
<?php //$date_ver = $con->query(); ?>
    <section class="content-header">
      <h1>
        View Verification
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
					<h3 class="box-title"> Search Verification</h3>
				</div>
				<form action="Process/add_client_process.php" method="post">
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Project Name </label>
						  <input type="text" class="form-control" id="view_acc_name" name="" placeholder="Project Name">
						  <input type="hidden" id="hid_id">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Date range </label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" id="date_range" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
								</div>
						</div>
					</div>
				
						<div class="col-md-6">
						<div class="form-group">
							<label>Select Date</label>
							    <select name="client_ac_type" id="invoice_id_sel_change" class="form-control">
									<option value="">-- Select Date --</option>
								</select>
						</div>
					</div>
					
				</form>
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
				$.ajax({
							method : "POST",
							url : "search/verf_date_range.php",
							data : "id="+$(this).val(),
							success:function( out ){
								console.log(out);
								$.each(JSON.parse(out), function (key,value) {
									$("#invoice_id_sel_change").append( value );
								});
							}
						});
			});

			$('#date_range').on('cancel.daterangepicker', function(ev, picker) {
				$(this).val('');
			});
		
	});
</script>
<script>
window.onload = function(){searchFilter();};
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#hid_id').val();
	var date = $('#date_range').val();
	var sdate = $('#invoice_id_sel_change').val();
    var sortBy = $('#sortBy').val();
	var num_rows = $('#num_rows').val();
	if(keywords != '' || date != '' ||  sortBy != '')
	{
    $.ajax({
        type: 'POST',
        url: 'manage_search/verification_getData.php',
        data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&purchase_project_date='+date+'&num_rows='+num_rows+'&sdate='+sdate,
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
 <script src="plugins/search/view_ver_auto.js"></script>

<?php include_once('footer.php'); ?>