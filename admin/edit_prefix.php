<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>

<section class="content-header">
      <h1>
        Edit Prefix
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
	$up_prefix = $con->query("select * from prefix_master where prefix_id = '".$_GET['edit_prefix_id']."'");
	$up_prefixr = $up_prefix->fetch_object();
	?>
	<div class="row">
		<div class="col-md-12">
		<div class="box box-primary">
			<form action="Process/edit_prefix_pro.php" method="post">
			<input type="hidden" name="pre_up_id" value="<?php echo $up_prefixr->prefix_id; ?>" />
				<div class="box-body">
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" class="form-control input-sm" value="<?php echo $up_prefixr->serial_name; ?>" id="" placeholder="Serial Name" name="serial_name" required />
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" class="form-control input-sm" value="<?php echo $up_prefixr->prefix_code; ?>" id="" placeholder="Prefix_code" name="prefix_code" required />
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="number" class="form-control input-sm" value="<?php echo $up_prefixr->total_page; ?>" id="" placeholder="Total_page_invoice" name="t_p_invoice" required />
						</div>
					</div>
					<div class="box-body">
					<div class="col-md-12">
						<button type="submit" name="com_button" class="btn btn-primary">Update</button>
					</div>
					</div>
				</div>
			</div>
			
		</form>
		</div>
	</div>
    </section> <!-- /.content -->





<?php include_once('footer.php'); ?>