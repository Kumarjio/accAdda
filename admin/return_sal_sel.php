<?php include_once('header.php'); ?>
<?php include_once('sidebar.php');?>
<?php $sel_pur_no1 = $conn->query("SELECT * FROM sales_mst where cut_amt != '0' "); ?>

    <section class="content-header">
      <h1>
        Sales Return Invoice 
       </h1>
      
    </section>
	<form action="add_salesreturn.php" enctype="multipart/form-data" method="get">
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
						  <input type="text" class="form-control" id="account_name_sales" name="" autocomplete="off" spellcheck="false" placeholder="Account Name" >
						</div>
					</div>
					<input type="hidden" id="client_id" name="" />
					<div class="col-md-6">
						<div class="form-group">
							<label>Select Sales Invoice No.</label>
							    <select name='invoice_id_sel' id='invoice_id_sel' class='form-control' required>
									<option value=''>-- Select Sales Invoice No. --</option>
									<?php while($sel_pur_no1r = $sel_pur_no1->fetch_object()){ ?>
										<option value='<?php echo $sel_pur_no1r->s_id; ?>'><?php echo $sel_pur_no1r->s_numner; ?></option>
									<?php } ?>
								</select>
						</div>
					</div>
					
					

	
				
			</div>
			<div class="box-body">
						  <div class="box-footer">
							<button type="submit" class="btn btn-primary">Make Sales Return Invoice</button>
							<button type="reset" class="btn btn-primary btn-danger">Reset</button>
						  </div>
					  </div>
        </div>
      </div>
</section>

</form>
<script src="plugins/dynamicadd/sales_re_in_dynamic.js"></script>
<script src="plugins/search/sales_re_in.js"></script>



<?php include_once('footer.php'); ?>