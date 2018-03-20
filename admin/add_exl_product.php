<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>

    <section class="content-header">
       <h1>
        Import Excel File Product Master
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
        <!-- left column -->
        <div class="col-md-12">
		<div class="box box-primary">
			
			<form action="Process/add_pr_ex.php" method="post" enctype="multipart/form-data">
					<div class="box-body">
						<div class="col-md-6">
							 <div class="form-group ">
								  <input type="file" onchange="return check()" id="csv" placeholder="Upload Image Here" accept=".csv" name="file" class="form-control" required>
							</div>
							<p id="re" style="display:none; color:red;"></p>
						</div>
					</div>
				 <div class="box-footer">
					<div class="box-body">
					<button type="submit" name="submit" id="butn" class="btn btn-primary" onclick="return ch()"><div id="load" style="display:none;"><i style="margin:0 10px; 0 0" class="fa fa-spin fa-refresh"></i><span style="margin-right:10px;">Please Wait...</span></div><div id="button">submit</div></button>

								<button type="reset" class="btn btn-danger big">Reset</button>
					</div>
				</div>
			</form>			
			</div>
		</div>
	</div>
      <!-- /.row -->
</section> <!-- /.content -->


<script>
	function check()
	{
		if( $('#csv').val().replace(/^.*\./, '') != 'csv' )
		{
			$('#re').fadeIn();
			$('#re').html('Please Select Only { .Csv } File');
			return false;
		}
	}
	
	function ch()
	{
		if( $('#csv').val().replace(/^.*\./, '') != 'csv' )
		{
			$('#re').fadeIn();
			$('#re').html('Please Select Only { .Csv } File');
			return false;
		}
		else
		{
			$('#re').fadeOut();
			$('#button').hide();
				$('#butn').prop('disabled', true);
				$('#butn').css('opacity','1');
				$('#load').show();
			return true;
		}
	}
</script>




<?php include_once('footer.php'); ?>