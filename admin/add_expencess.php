<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
   <section class="content-header">
      <h1>
       Add Expense
      </h1>
   </section>
   <form role="form" method="post" action="Process/add_expencess_process.php">
    <section class="content">
	<div class="row">
	<div class="col-md-12">
	<div class="box box-primary">
            <div class="box-header with-border col-md-12">
              <h3 class="box-title">Add Expense</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
			
              <div class="box-body " >
			  <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Account Name</label>
                  <input type="text" class="form-control"  id="acc_name_exp" placeholder="Enter Account Name" autocomplete="off" spellcheck="false" name="account_name" required>
				  <input type="hidden" id="acc_name_hidd_exp" name="acc_name_hidd_exp">
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                <label>Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" id="today_exp" name="date_exp" class="form-control pull-right" >
                </div>
				</div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
                 
                  <label>Project Name</label>
							    <select name="client_ac_type" id="pro_name_exp" class="form-control" required>
									<option value="">--Select Project--</option>
									<?php while($sel_projectsr = $sel_projects->fetch_object()){ ?>
										<option value="<?php echo $sel_projectsr->project_id; ?>"><?php echo $sel_projectsr->project_name; ?></option>
									<?php } ?>
								</select>
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputPassword1">Amount</label>
                  <input type="number" min="0" class="form-control" id="amount_exp"  placeholder="Enter Amount" name="amount_exp" required>
                </div>
				</div>
				<div class="col-md-6">
				 <div class="form-group">
                  <label>Remarks</label>
                  <textarea class="form-control" id="remars_exp" rows="" placeholder="Enter Remarks" name="remars_exp"></textarea>
                </div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
                  <label>Payment Mode</label>
							    <select name="payment_act_mode" id="pay_mode" class="form-control" required>
									<option value="">--Select Payment Mode--</option>
									<option value="cash">Cash</option>
									<option value="bank">Bank</option>
								</select>
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
						  <input type="text" class="form-control" id="cheque_exp" name="cheque_no_exp" placeholder="cheque_no" >
						</div>
					</div>
					</div>
				</div>
			</div>
              
			 
			 	
             
                
              
			  
              <!-- /.box-body -->
				 <div class="box-footer">
				 <div class="box-body">
                <button type="submit" onclick="return auth()" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-primary btn-danger">Reset</button>
              </div>
			  <p id="errall" style="display:none; color: red; font-weight: 900; padding: 9px 0 0 12px;"></p>
			  </div>
			   
             </div> 
            </div>
          </div>
          <!-- /.box -->
			
	</section>
	</form>
	<script>
	$(document).ready(function(){
		$('#today_exp').datepicker({
				autoclose: true,
				format: 'dd/mm/yyyy',
            });
			$("#today_exp").datepicker("setDate", new Date());
		
	});
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
			if( $('#cheque_exp').val() == '' )
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
	<script src="plugins/search/add_exp_auto.js"></script>
         
<?php include_once('footer.php'); ?>