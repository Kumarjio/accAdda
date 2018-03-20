<?php include_once('header.php'); ?>
<?php include_once('sidebar.php');

?>


   <section class="content-header">
      <h1>
        Journal Entries
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
					<div class="box-header with-border">
					  <h3 class="box-title">Search Entries</h3>
					</div>
						<div class="box-body">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Account Name </label>
									<input type="text" class="form-control" id="acc_name_journal_report" name="account_name" placeholder="Account Name" autocomplete="off" spellcheck="false">
									<input type="hidden" id="journal_report_hidden_client_id" name="journal_report_pay_hidden"/>
								</div>
							</div>
							
							<div class="col-md-6">
							<div class="form-group">
								<label>Date Range</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" class="form-control" id="date_range" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
									</div>
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
									<option value="">-- Sort By --</option>
									<option value="asc">Ascending</option>
									<option value="desc">Descending</option>
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
    <!-- /.content -->
	
<script>
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#journal_report_hidden_client_id').val();
	var date = $('#date_range').val();
    var sortBy = $('#sortBy').val();
	var num_rows = $('#num_rows').val();
	if(keywords != '' || date != '' || sortBy != '')
	{
    $.ajax({
        type: 'POST',
        url: 'manage_search/jurnal_getData.php',
        data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&purchase_project_date='+date+'&num_rows='+num_rows,
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
</script>

<script src="plugins/search/journal_entries_auto.js" ></script>



<?php include_once('footer.php'); ?>