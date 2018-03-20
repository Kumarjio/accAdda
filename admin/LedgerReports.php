<?php include_once('header.php'); ?>
<?php include_once('sidebar.php');
?>


   <section class="content-header">
      <h1>
        Ledger Reports
      </h1>
    </section>
<form method="post" action="fpdf/ledger.php">
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
									<input type="hidden" id="journal_report_hidden_client_id" name="id_add_pay_hidden"/>
								</div>
							</div>
							
							<div class="col-md-6">
						<div class="form-group">
							<label>Date Range:</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" id="date_range" name="today_date" class="form-control" autocomplete="off" spellcheck="false">	
								</div>
						</div>
					</div>
							</div>
					<div class="box-body">
						<div class="box-footer">
							<a onclick="searchFilter()" id="purchase_invoic" class="btn btn-primary">Search</a>
							<button type="button" id="reset" class="btn btn-primary btn-danger">Reset Search</button>
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
	<div class="row no-print">
        <div class="col-xs-12">
		
			<button type="submit" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>
		
		</div>
		</div>
    </section>
    <!-- /.content -->
</form>
<script>
	$(function(){
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
$('#reset').click( reset );		
	});
function searchFilter(page_num) {
    var keywords = $('#journal_report_hidden_client_id').val();
	var date = $('#date_range').val();
	if(keywords != '' || date != '' )
	{
    $.ajax({
        type: 'POST',
        url: 'manage_search/ledger_getData.php',
        data:'keywords='+keywords+'&purchase_project_date='+date,
        success: function (html) {
					$('#row_pur_in').fadeIn('slow');
					$('#row_pur_in').html(html);
        }
    });
	}
}


function reset(){	
window.location.href = location.pathname.substring(location.pathname.lastIndexOf("/") + 1);
}


</script>
<script src="plugins/search/ledger_report_auto.js" ></script>



<?php include_once('footer.php'); ?>