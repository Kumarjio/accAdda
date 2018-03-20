<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>


   <section class="content-header">
      <h1>
        Edit Client Details
      </h1>
    </section>
<?php $update_client = $con->query('select * from client_master where client_id = "'.$_GET['id'].'"');
$update_clientr = $update_client->fetch_object(); ?>
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
					  <h3 class="box-title">Fillup Information</h3>
					</div>
			<form action="Process/update_client_process.php" method="post">
					  <div class="box-body">
					  <input type="hidden" name="id" value="<?php echo $update_clientr->client_id; ?>" />
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Enter Name</label>
						  <input type="text" class="form-control" id="" value="<?php echo $update_clientr->client_name; ?>" name="client_name" placeholder="Enter Name" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Contact No.</label>
						  <input type="text" class="form-control" pattern="[789][0-9]{9}" id="" value="<?php echo $update_clientr->client_contact_no; ?>" name="client_no" placeholder="Enter Contact No." >
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>A/c Type</label>
							    <select name="client_ac_type" id="" class="form-control" required>
									<option value="">-- Select A/c Type --</option>
									<?php while($sel_account_typer = $sel_account_type->fetch_object()){ ?>
										<option value="<?php echo $sel_account_typer->ac_id; ?>" <?php if($sel_account_typer->ac_id == $update_clientr->client_ac_type){echo 'selected="selected"';} ?>><?php echo $sel_account_typer->ac_name; ?></option>
									<?php } ?>
								</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Email Id</label>
						  <input type="email" name="client_email" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="<?php echo $update_clientr->client_email; ?>" class="form-control bor" id="" placeholder="Enter Email Id" >
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="exampleInputPassword1">GSTIN</label>
						  <input type="text" class="form-control" name="gst_no" value="<?php echo $update_clientr->gst; ?>" id="" placeholder="Enter GSTIN" >
						</div>
					</div>
					<div class="col-md-4">
							<div class="form-group">
								<label>State Name</label>
									<select name="state_code" id="eclient_state" class="form-control" required>
										<option value="">-- Select State Name --</option>
										<?php while($stater = $state->fetch_object()){ ?>
											<option <?php if($update_clientr->state ==  $stater->code ){ echo "selected"; } ?> value="<?php echo $stater->code; ?>"><?php echo $stater->name; ?></option>
										<?php } ?>
									</select>
							</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
						  <label for="exampleInputPassword1">State Code</label>
						  <input type="text" class="form-control" name="" id="code"  value="<?php echo $update_clientr->state; ?>" placeholder="State Code" readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Tin No.</label>
						  <input type="text" name="clint_tin_no" class="form-control" value="<?php echo $update_clientr->client_tin; ?>"  id="" placeholder="Enter Tin No.">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Address</label>
						  <textarea type="text" name="client_address" class="form-control" value="" id="" placeholder="Enter Address" required><?php echo $update_clientr->client_address; ?></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Cst No.</label>
						  <input type="text" name="clint_cst_no" class="form-control" value="<?php echo $update_clientr->client_cst; ?>" id="" placeholder="Enter Cst No.">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Opening Balance</label>
						  <input type="text" name="client_opening_balance" value="<?php echo $update_clientr->client_openingbal; ?>" class="form-control" id="" placeholder="Enter Opening Balance">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Series</label>
							<select name="client_series" id="" class="form-control">
								<option value="">-- Select Series --</option>
								<?php $sel_prefix = $con->query('select * from prefix_master'); while($sel_prefixr = $sel_prefix->fetch_object()){?>
									<option value="<?php echo $sel_prefixr->prefix_id; ?>" <?php if($sel_prefixr->prefix_id == $update_clientr->client_series){echo 'selected="selected"';} ?> ><?php echo $sel_prefixr->serial_name; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Terms Day.</label>
						  <input type="text" class="form-control" name="client_termday" value="<?php echo $update_clientr->client_termday; ?>" id="" placeholder="Enter Terms Day.">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Opening Balance Type</label>
								<select name="client_opening_type" id="" class="form-control">
									<option value="None" <?php if('None' == $update_clientr->client_opening_type){echo 'selected="selected"';} ?>>None</option>
									<option value="Debit" <?php if('Debit' == $update_clientr->client_opening_type){echo 'selected="selected"';} ?>>Debit</option>
									<option value="Credit" <?php if('Credit' == $update_clientr->client_opening_type){echo 'selected="selected"';} ?>>Credit</option>
								</select>
						</div>
					</div>
					 </div>
					  <!-- /.box-body -->
					  <div class="box-body">
						  <div class="box-footer">
							<button type="submit" class="btn btn-primary">Update Client</button>
							<button type="reset" class="btn btn-primary btn-danger">Reset</button>
						  </div>
					  </div>
            </form>
				</div>
			</div>
		</div>
	  
    </section>
    <!-- /.content -->


<script src="plugins/state_select.js"></script>


<?php include_once('footer.php'); ?>