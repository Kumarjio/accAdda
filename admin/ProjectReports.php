<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>


   <section class="content-header">
      <h1>
        Project Reports
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
									<label>Project Name</label>
										<select name="client_ac_type" id="project_id" onchange="searchFilter()" class="form-control">
											<option value="0">--Select Project--</option>
											<?php while($sel_projectsr = $sel_projects->fetch_object()){ ?>
												<option value="<?php echo $sel_projectsr->project_id; ?>"><?php echo $sel_projectsr->project_name; ?></option>
											<?php } ?>
										</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Account Name </label>
									<input type="text" class="form-control" id="acc_name_journal_report" name="account_name" placeholder="Account Name" autocomplete="off" spellcheck="false">
									<input type="hidden" id="journal_report_hidden_client_id" name="id_add_pay_hidden"/>
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
								
							</div>
						</div>
				</div>	
			</div>
		</div>
		<div class="row" style="display:none;" id="row_pur_in">
			
		</div>
    </section>
<script src="plugins/search/journal_entries_auto.js" ></script>
<script>
function searchFilter() {
    
    var keywords = $('#journal_report_hidden_client_id').val();
	var project = $('#project_id').val();
    var sortBy = $('#sortBy').val();
	if(keywords != '' && project != '0' )
	{
    $.ajax({
        type: 'POST',
        url: 'manage_search/project_veri_get.php',
        data:'keywords='+keywords+'&sortBy='+sortBy+'&project='+project,
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
<?php include_once('footer.php'); ?>