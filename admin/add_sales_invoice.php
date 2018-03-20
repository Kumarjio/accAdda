<?php include_once('header.php'); ?>
<?php include_once('sidebar.php');?>
    <section class="content-header">
      <h1>
        Add Sales Invoice 
       </h1>
      
    </section>
	<form action="add_sales_chalan.php" id="form_full" method="post">
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
							<input type="text" class="form-control" id="account_name_sales" name="client_name" autocomplete="off" spellcheck="false" placeholder="Account Name" required>
							<input type="hidden" name="for_pre_client_id" id="client_id" />
						</div>
					</div>
					
					<div class="col-md-12" id="chalan_id" style="display:none; overflow-y:scroll; max-height:350px;">
						
							<div  class="form-group">
								<label for="">Chalan List</label>
									<div id="invoice_id_sel_change">
										
									</div>
								<input type="hidden" id="hide_in" />
							</div>
						
					</div>
			</div>
			<div class="box-body">
						  <div class="box-footer">
							<button type="submit" class="btn btn-primary">Make Invoice</button>
							<button type="reset" class="btn btn-primary btn-danger">Reset</button>
						  </div>
			</div>
        </div>
      </div>
	</div>
</section>
</form>
<script src="plugins/search/autocomplete_sales_c.js"></script>

<?php include_once('footer.php'); ?>