<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>

    <section class="content-header">
       <h1>
        Edit Product
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
    <div class="row">
       <?php $update_product =  $con->query("select * from product_master where product_id = '".$_GET['update_product_id']."' "); 
	   $update_productr = $update_product->fetch_object();
	   ?>
        <div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				  <h3 class="box-title">Fillup Information</a></h3>
			</div>
			<form action="Process/update_product_process.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="up_pr_id" value="<?php echo $update_productr->product_id; ?>" />
					<div class="box-body">
						<div class="col-md-6">
							<div class="form-group ">
								<label for="">Product Name</label>
									<input type="text" class="form-control" id="" value="<?php echo $update_productr->product_name; ?>" name="product_name" placeholder="Enter Product Name" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ">
								<label for="">HSN/SAC</label>
									<input type="text" class="form-control" id="" value="<?php echo $update_productr->HSN; ?>" name="hsn" placeholder="HSN/SAC" required>
							</div>
						</div>
						<div class="col-md-6">
							 <div class="form-group ">
								  <label>GST Rate</label>
								  <select class="form-control " name="rate" required>
									<option value="">-- Select GST Rate --</option>
									<?php while($sel_taxr = $sel_tax->fetch_object()){ ?>
										<option value="<?php echo $sel_taxr->st; ?>" <?php if($sel_taxr->st == $update_productr->rate ){ echo 'selected="selected"'; } ?>><?php echo $sel_taxr->tax_name; ?></option>
									<?php } ?>
								  </select>
							 </div>
						</div>
						<div class="col-md-6">
							 <div class="form-group ">
								  <label>Category</label>
								  <select class="form-control " name="product_catagory" >
									<option value="" <?php if($update_productr->product_catagory == '- -'){ echo 'selected="selected"'; } ?>>-- Select Category --</option>
									<?php while($sel_catagoryr = $sel_catagory->fetch_object()){ ?>
										<option value="<?php echo $sel_catagoryr->name; ?>" <?php if($sel_catagoryr->name == $update_productr->product_catagory){echo 'selected="selected"';} ?>><?php echo $sel_catagoryr->name; ?></option>
									<?php } ?>
								  </select>
							 </div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Unit</label>
							  <select class="form-control" name="product_unit" required>
								<option value="" <?php if($update_productr->product_unit == '- -'){ echo 'selected="selected"'; } ?>>-- Select Unit --</option>
								<?php while($sel_unitr = $sel_unit->fetch_object()){ ?>
									<option value="<?php echo $sel_unitr->unit_name; ?>" <?php if($sel_unitr->unit_name == $update_productr->product_unit){echo 'selected="selected"';} ?>><?php echo $sel_unitr->unit_name; ?></option>
								<?php } ?>
							  </select>
							</div>	
						</div>
						<div class="col-md-6">
							 <div class="form-group ">
							  <label for="" >Product Size</label>
							  <input type="text" class="form-control" id="" value="<?php echo $update_productr->product_size; ?>" name="product_size" placeholder="Enter Product Size" >
							 </div>
						</div>
						
						<div class="col-md-6">				
							<div class="form-group ">
							  <label for="" >Product Description</label>
							  <textarea type="" class="form-control" id="" name="product_desc" placeholder="Enter Product Description" required><?php echo $update_productr->product_desc; ?></textarea>
							</div>
						</div>
					</div>
				 <div class="box-footer">
					<div class="box-body">
								<button type="submit" class="btn btn-primary big" >Update</button>
								<button type="reset" class="btn btn-primary btn-danger big">Reset</button>
					</div>
				</div>
			</form>			
			</div>
		</div>
	</div>
      <!-- /.row -->
</section> <!-- /.content -->





<?php include_once('footer.php'); ?>