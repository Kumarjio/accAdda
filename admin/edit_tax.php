<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>

<section class="content-header">
      <h1>
        Edit Tax
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
	<?php
	$up_tax = $con->query("select * from tax_master where tax_id = '".$_GET['edit_tax_id']."'");
	$up_taxr = $up_tax->fetch_object(); 
	?>
	<div class="row">
		<div class="col-md-12">
		<div class="box box-primary">
			<form action="Process/edit_tax_pro.php" method="post">
			<input type="hidden" name="tax_id" value="<?php echo $up_taxr->tax_id; ?>" />
				<div class="box-body">
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" class="form-control input-sm" id="" value="<?php echo $up_taxr->tax_name; ?>" placeholder="Tax_name" name="tax_name" required />
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="number" class="form-control input-sm" id="" value="<?php echo $up_taxr->st; ?>" placeholder="S.T" name="st_no" required />
						</div>
					</div>
				</div>
				<div class="box-footer">
				<div class="box-body">
							<button type="submit" name="com_button" class="btn btn-primary">Update</button>
							<button type="reset" class="btn btn-primary btn-danger">Reset</button>
				</div>
				</div>
			</div>
			
		</form>
		</div>
	</div>
    </section> <!-- /.content -->





<?php include_once('footer.php'); ?>