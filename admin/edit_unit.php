<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>

<section class="content-header">
      <h1>
        Edit Unit
         </h1>
    </section>
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
	$up_unit = $con->query("select * from unit_master where unit_id = '".$_GET['edit_unit_id']."'")->fetch_object();
	?>
      <div class="row">
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Fillup Information</h3>
            </div>
						<form action="Process/edit_unit_pro.php" method="post" enctype="multipart/form-data">
							<div class="box-body">
								<div class="form-group">
								<input type="hidden" name="unit_id" value="<?php echo $up_unit->unit_id; ?>" />
								  <label for="exampleInputEmail1">Unit Name</label>
								  <input type="unit name" class="form-control" value="<?php echo $up_unit->unit_name; ?>" id="" name="unit_name" placeholder="unit_name" required>
								</div>
								  <div class="box-footer">
									<button type="submit" class="btn btn-primary">Update Unit</button>
								  </div>
							</div>
						</form>
            </div>
      </div>
    
	</div>
    </section> <!-- /.content -->





<?php include_once('footer.php'); ?>