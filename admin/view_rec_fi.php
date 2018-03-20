<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php
if( isset($_GET['id']) )
{
	$a =  "Payment";
	$reciept_no = $conn->query("SELECT * FROM payment_mst where id = '".$_GET['id']."'")->fetch_object();
	 $cli = $con->query("select * from client_master where client_id = '".$reciept_no->act_id."'")->fetch_object();
}else if(isset($_GET['Rid']))
{
	$a =  "Reciept";
	$reciept_no = $conn->query("SELECT * FROM reciept_mst where id = '".$_GET['Rid']."'")->fetch_object();
	$cli = $con->query("select * from client_master where client_id = '".$reciept_no->act_id."'")->fetch_object();
}
 ?>
<script src="plugins/add_payment.js"></script>
<section class="content-header">
      <h1>
        View <?php echo $a; ?>
      </h1>
      
    </section>
	

    <!-- Main content -->
	<form action="Process/add_payment_process.php" method="post">
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
						  <input type="text" class="form-control" id="acc_name_payment" name="account_name" value="<?php echo $cli->client_name;  ?>" placeholder="Enter Account Name" autocomplete="off" spellcheck="false" readonly>
						  <input type="hidden" id="add_pay_client_id" name="id_add_pay_hidden"/>
						</div>
							</div>
				
				
					
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Amount </label>
						  <input type="text" class="form-control" id="amount_payment" value="<?php echo $reciept_no->amount; ?>" name="amount" placeholder="Enter Amount" autocomplete="off" spellcheck="false" readonly>
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
									<input type="text" id="" value="<?php echo $reciept_no->p_date; ?>" name="today_date" class="form-control" autocomplete="off" spellcheck="false" readonly>	
								</div>
						</div>
					</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label for="">T.D.S</label>
								  <input type="text" class="form-control" id="tds_payment" value="<?php echo $reciept_no->tds; ?>" name="tds" placeholder="T.D.S" autocomplete="off" spellcheck="false" readonly>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Reciept No</label>
						  <input type="text" class="form-control" value="<?php echo $reciept_no->p_number; ?>" id="" name="payment_reciept_no" placeholder="" readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Total</label>
						  <input type="text" class="form-control" id="total_payment" value="<?php echo $reciept_no->total; ?>" name="total" placeholder="" readonly>
						</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
							<label>Payment mode</label>
							    <select name="payment_act_mode" id="pay_mode" class="form-control" disabled>
									<option value=""><?php echo $reciept_no->mode; ?></option>
								</select>
							
						
					</div>
					
					</div>
					
					<div class="col-md-6">
					<div class="form-group">
						  <label for="">Round of </label>
						  <input type="text" class="form-control" value="<?php echo $reciept_no->rd; ?>" id="" name="round_off" placeholder="" readonly>
						</div>
					</div>
					<?php if($reciept_no->mode == 'bank'){ ?>
					<div class="row" id="bank_payment" style="">
					<div class="col-md-12">
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Bank Name</label>
						  <input type="text" class="form-control" id="pay_bank" value="<?php echo $reciept_no->bank_name; ?>" name="bank_name_payment" placeholder="Enter Bank Name" autocomplete="off" spellcheck="false" readonly>
						  <input type="hidden" id="pay_bank_id" name="pay_bank_id"/>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Cheque No.</label>
						  <input type="text" class="form-control" id="" value="<?php echo $reciept_no->chk_no; ?>" name="cheque_no_payment" placeholder="Enter Cheque no." readonly>
						</div>
					</div>
					</div>
					</div>
					<?php } ?>
					<div class="col-md-6">
					<div class="form-group">
							<label>Project Name</label>
							    <select name="client_ac_type" id="" class="form-control" disabled>
									<option value="">-- Select Project --</option>
									<?php while($sel_projectsr = $sel_projects->fetch_object()){ ?>
										<option <?php if($sel_projectsr->project_id == $reciept_no->prj_id){ echo "selected"; } ?> value="<?php echo $sel_projectsr->project_id; ?>"><?php echo $sel_projectsr->project_name; ?></option>
									<?php } ?>
								</select>
						
					</div>
					</div>
					
					<div class="col-md-6">
								<div class="form-group">
								  <label for="">Remarks</label>
								  <textarea type="text" name="remark" class="form-control" id="" placeholder="" readonly><?php echo $reciept_no->remark; ?></textarea>
								</div>
							</div>
					
					
					
					
					</div>
				
			</div>
        </div>
      </div>
    </section> <!-- /.content -->
	</form>



<?php include_once('footer.php'); ?>