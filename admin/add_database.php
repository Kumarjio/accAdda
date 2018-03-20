<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); 
include_once('function/add_database_func.php');  
if(isset($_POST['add_year']))
{
	$financial_year = $con->query("select * from financial_year_master where year = '".$_POST['financial_year']."'");
	if($financial_year->num_rows > 0)
	{
		$_SESSION['emsg'] = "OOps Financial Year ".$_POST['financial_year']." Is Already Created";
		echo "<script>window.location='add_database.php';</script>";
		exit;
	}
	else
	{
		$add_year = $con->query("insert into `financial_year_master` (`year`) values ('".$_POST['financial_year']."')");
			if($add_year)
			{
				create_financial_year($_POST['financial_year'],host,user,pass);
				$_SESSION['msg'] = "Financial Year ".$_POST['financial_year']." Succssesfully Added";
				echo "<script>window.location='add_database.php';</script>";
				exit;
			}
	}
}
?>

   <section class="content-header">
      <h1>
        Add Financial Year
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
		<div class="row">
			<div class="col-md-12">
			<div class="box box-primary">
			<div class="box-body">
			<?php if(isset($_SESSION['emsg'])){ ?>
			<div class="alert alert-danger" id="fade" style="">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				<p><?php echo $_SESSION['emsg']; ?></p>
			</div>
			<?php } unset($_SESSION['emsg']);?>
				<div style="margin:10px 0 0 0">
					<form method="post" id="add_year">
						<div class="col-md-6">
							<div class="form-group">
									<?php $date = date("Y")+1; ?>	
								<input type="text" name="financial_year" value="<?php echo date("Y")."_".$date; ?>" class="form-control" id="financial_year" placeholder="Year" readonly/>
							</div>
						</div>
						<div class="col-md-3">
							<button type="submit" name="add_year" id="butn" class="btn btn-primary"><div id="load" style="display:none;"><i style="margin:0 10px; 0 0" class="fa fa-spin fa-refresh"></i><span style="margin-right:10px;">Please Wait...</span></div><div id="button">Add Financial Year</div></button>
						</div>
						<div class="col-md-3">
								
						</div>
					</form>
				</div>
			</div>
		</div>
		</div>
	  </div>
    </section>
	<script>
		$(document).ready(function(){
			$('#add_year').submit(function(){
				$('#button').hide();
				
				$('#butn').css('opacity','1');
				$('#load').show();
				return true;
				//$('#butn').prop('disabled', true);
			});
		});
	</script>
<?php include_once('footer.php'); ?>