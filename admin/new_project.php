<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>

<section class="content-header">
      <h1>
        Add New Project
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
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Fillup Information</h3>
				</div>
				<form action="Process/add_project_process.php" method="post">
					  <div class="box-body">
							<div class="col-md-6">
								<div class="form-group">
								  <label for="">Project Name</label>
								  <input type="text" class="form-control" id="" name="project_name" placeholder="Enter Name" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label for="">Contact Person Name</label>
								  <input type="text" class="form-control" id="" name="contact_person_name" placeholder="Enter Contact Person Name" >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label for="">Contact No.</label>
								  <input type="text" class="form-control" pattern="[789][0-9]{9}" id="" name="project_no" placeholder="Enter Contact No." >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label for="">Email Id</label>
								  <input type="email" name="project_email" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control bor" id="" placeholder="Enter Email Id" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label for="">Address</label>
								  <textarea type="text" name="project_address" class="form-control" id="" placeholder="Enter Address" ></textarea>
								</div>
							</div>
					 </div>
					  <div class="box-body">
						  <div class="box-footer">
							<button type="submit" class="btn btn-primary big">Submit</button>
							<button type="reset" class="btn btn-primary btn-danger big">Reset</button>
						  </div>
					  </div>
            </form>
			</div>
		</div>
	</div>
	  
	  
    </section>





<?php include_once('footer.php'); ?>