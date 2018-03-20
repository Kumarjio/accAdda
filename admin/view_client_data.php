<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php $view_client_data = $con->query('select * from client_master where client_id = "'.$_GET["client_show_id"].'"')->fetch_object(); ?>


    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Client Information</h3>
					</div>
			<form action="Process/add_client_process.php" method="post">
					  <div class="box-body">
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Enter Name</label>
						  <input type="text" value="<?php echo $view_client_data->client_name; ?>" class="form-control" id="" name="client_name" readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Contact No.</label>
						  <input type="text" class="form-control" id="" name="client_no" value="<?php echo $view_client_data->client_contact_no; ?>" readonly>
						</div>
					</div>
					<div class="col-md-6">
					<?php $sel_ac_type = $con->query('select ac_name from account_type where ac_id = "'.$view_client_data->client_ac_type.'"')->fetch_object(); ?>
						<div class="form-group">
							<label>A/c Type</label>
							<input type="text" class="form-control" id="" name="client_no" value="<?php echo $sel_ac_type->ac_name; ?>" readonly>  
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Email Id</label>
						  <input type="email" name="client_email" class="form-control bor" value="<?php echo $view_client_data->client_email; ?>" id="" readonly>
						</div>
					</div>
						<div class="col-md-6">
						<div class="form-group">
						  <label for="exampleInputPassword1">GSTIN</label>
						  <input type="text" class="form-control" name="gst_no" value="<?php echo $view_client_data->gst; ?>" id="" placeholder="Enter GSTIN" readonly>
						</div>
					</div>
					<div class="col-md-4">
							<div class="form-group">
								<label>State Name</label>
									<select name="state_code" id="client_state" class="form-control" disabled>
										<option value="">-- Select State Name --</option>
										<?php while($stater = $state->fetch_object()){ ?>
											<option <?php if($view_client_data->state ==  $stater->code ){ echo "selected"; } ?> value="<?php echo $stater->code; ?>"><?php echo $stater->name; ?></option>
										<?php } ?>
									</select>
							</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
						  <label for="exampleInputPassword1">State Code</label>
						  <input type="text" class="form-control" name="" id="code"  value="<?php echo $view_client_data->state; ?>" placeholder="State Code" readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Tin No.</label>
						  <input type="text" name="clint_tin_no" class="form-control" id="" value="<?php echo $view_client_data->client_tin; ?>" readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Address</label>
						  <textarea type="text" name="client_address" class="form-control" id="" readonly><?php echo $view_client_data->client_address; ?></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Cst No.</label>
						  <input type="text" name="clint_cst_no" class="form-control" id="" value="<?php echo $view_client_data->client_cst; ?>" readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Opening Balance</label>
						  <input type="text" name="client_opening_balance" class="form-control" value="<?php echo $view_client_data->client_openingbal; ?>" id="" readonly>
						</div>
					</div>
					<div class="col-md-6">
					<?php $sel_series = $con->query('select serial_name from prefix_master where prefix_id = "'.$view_client_data->client_series.'"')->fetch_object(); ?>
						<div class="form-group">
							<label>Series</label>
							<input type="text" name="client_opening_balance" class="form-control" value="<?php if($view_client_data->client_series){ echo $sel_series->serial_name; }?>" id="" readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Terms Day.</label>
						  <input type="text" class="form-control" name="client_termday" id="" value="<?php echo $view_client_data->client_termday; ?>" readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Opening Balance Type</label>
								<input type="text" class="form-control" name="client_termday" id="" value="<?php echo $view_client_data->client_opening_type; ?>" readonly>
						</div>
					</div>
					 </div>
					  <!-- /.box-body -->
            </form>
				</div>
			</div>
		</div>
	  
    </section>
    <!-- /.content -->





<?php include_once('footer.php'); ?>