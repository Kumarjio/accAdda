<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php $payment_no = $conn->query("SELECT * FROM reciept_mst ORDER BY id DESC LIMIT 1")->fetch_object(); ?>
<script src="plugins/add_reciept.js"></script>

<section class="content-header">
      <h1>
        Add Reciept
      </h1>
      
    </section>

    <!-- Main content -->
	<form action="Process/add_reciept_process.php" method="post">
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
					<h3 class="box-title"> Fillup Information</h3>
				</div>
				<div class="col-md-6">
								<div class="form-group">
						  <label for="">Account Name </label>
						  <input type="text" class="form-control" id="account_name_add_reciept" name="" onblur="searchFilter();" placeholder="Enter Account Name" autocomplete="off" spellcheck="false" required>
						  <input type="hidden" name="add_reciept_client_id" id="add_reciept_client_id">
						</div>
							</div>
				
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Amount </label>
						  <input type="number" min="0" class="form-control" id="amount_payment" name="amount" placeholder="Enter Amount" autocomplete="off" spellcheck="false" required>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-6">
						<div class="form-group">
							<label>Date :</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" id="today" name="today_date" class="form-control" autocomplete="off" spellcheck="false">	
								</div>
						</div>
					</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label for="">T.D.S</label>
								  <input type="number" min="0" class="form-control" id="tds_payment" name="tds" placeholder="T.D.S" value="0" autocomplete="off" spellcheck="false">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Payment No</label>
						  <input type="text" class="form-control" id="" name="payment_reciept_no" placeholder="" value="RE_<?php if(empty($payment_no->id)){echo 1;} else {echo $payment_no->id+1;} ?>" readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Total</label>
						  <input type="text" class="form-control" id="total_payment" name="total" placeholder="" readonly>
						</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
							<label>Payment Mode</label>
							    <select name="client_mode_type" id="pay_mode" class="form-control" required>
									<option value="">-- Select Payment Mode --</option>
									<option value="cash">Cash</option>
									<option value="bank">Bank</option>
								</select>
						
					</div>
					
					</div>
					
					<div class="col-md-6">
					<div class="form-group">
						  <label for="">Round of </label>
						  <input type="text" class="form-control" id="" name="round_off" placeholder="">
						</div>
					</div>
					
					<div class="row" id="bank_payment" style="display:none;">
					<div class="col-md-12">
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Bank Name</label>
						  <input type="text" class="form-control" id="pay_bank" name="bank_name_payment" placeholder="Enter Bank Name" autocomplete="off" spellcheck="false">
						   <input type="hidden" id="pay_bank_id" name="pay_bank_id"/>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Cheque No.</label>
						  <input type="text" class="form-control" id="check" name="cheque_no_payment" placeholder="Enter Cheque no." >
						</div>
					</div>
					</div>
					</div>
					
					<div class="col-md-6">
					<div class="form-group">
					
							<label>Project Name</label>
							    <select name="client_ac_type" id="" class="form-control" required>
									<option value="">--Select Project--</option>
									<?php while($sel_projectsr = $sel_projects->fetch_object()){ ?>
										<option value="<?php echo $sel_projectsr->project_id; ?>"><?php echo $sel_projectsr->project_name; ?></option>
									<?php } ?>
								</select>
						
					</div>
					</div>
					
					<div class="col-md-6">
								<div class="form-group">
								  <label for="">Remarks</label>
								  <textarea type="text" name="client_address" class="form-control" id="" placeholder="" ></textarea>
								</div>
							</div>
					
					
					
					
					</div>
					<div class="box-body">
					<div class="box-footer">
							<button type="submit" onclick="return auth()" class="btn btn-primary">Make Reciept</button>
							<button type="reset" class="btn btn-primary btn-danger" >Reset</button>
							
					</div>
					<p id="errall" style="display:none; color: red; font-weight: 900; padding: 9px 0 0 12px;"></p>
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
	</form>

	<script>
		
		function searchFilter(page_num) {
			page_num = page_num?page_num:0;
			var keywords = $('#add_reciept_client_id').val();
			if(keywords != '')
			{
			$.ajax({
				type: 'POST',
				url: 'manage_search/receipt_dt.php',
				data:'keywords='+keywords,
				success: function (html) {
							$('#row_pur_in').fadeIn('slow');
							$('#result_purchase').html(html);
				}
			});
			}
		}
	</script>
	<script>
function auth()
{
	if($('#pay_mode').val() == 'bank')
	{
		if( $('#pay_bank').val() == '' )
		{
			$('#errall').fadeIn("fast");
			$('#errall').html('Please Add Bank Name');
			return false;
		}
		else
		{
			if( $('#check').val() == '' )
			{
				$('#errall').fadeIn("fast");
				$('#errall').html('Please Add Cheque No.');
				return false;
			}
			else
			{
				$('#errall').fadeOut("fast");
				return true;
			}
		}
	}
	else
	{
		return true;
	}
}
</script>	
	
	
<script src="plugins/search/add_reciept_auto.js" ></script>


<?php include_once('footer.php'); ?>