<?php include_once('header.php');?>
<?php include_once('sidebar.php'); ?>


   <section class="content-header">
      <h1>
        Home
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
			<div class="box">
				<div class="box-header with-border">
					  <h3 class="box-title">Welcome &nbsp;&nbsp;&nbsp;<u><?php echo $sel_user->full_name; ?></u></h3>
				</div>
			</div>
		</div>
	</div>
	  
	
	
	  
    </section>
 





<?php include_once('footer.php'); ?>