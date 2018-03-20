<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>

<section class="content-header">
      <h1>
        Edit Project
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
 
      <?php $update_project = $con->query("select * from project_master where project_id= '".$_GET['edit_project_id']."'"); 
	  $update_projectr = $update_project->fetch_object();
	  ?>
	  
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Fillup Information</h3>
				</div>
				<form action="Process/edit_project_process.php" method="post">
				<input type="hidden" name="p_u_id" value="<?php echo $update_projectr->project_id; ?>" />
					  <div class="box-body">
							<div class="col-md-6">
								<div class="form-group">
								  <label for="">Project Name</label>
								  <input type="text" class="form-control" value="<?php echo $update_projectr->project_name; ?>"  id="" name="project_name" placeholder="Enter Name" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label for="">Contact Person Name</label>
								  <input type="text" class="form-control" value="<?php echo $update_projectr->contact_person_name; ?>" id="" name="contact_person_name" placeholder="Enter Contact Person Name" >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label for="">Contact No.</label>
								  <input type="text" class="form-control" id="" value="<?php echo $update_projectr->contact_no; ?>" pattern="[789][0-9]{9}" name="project_no" placeholder="Enter Contact No." >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label for="">Email Id</label>
								  <input type="email" name="project_email" value="<?php echo $update_projectr->email; ?>" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control bor" id="" placeholder="Enter Email Id" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label for="">Address</label>
								  <textarea type="text" name="project_address" class="form-control" id="" placeholder="Enter Address" ><?php echo $update_projectr->address; ?></textarea>
								</div>
							</div>
					 </div>
					  <div class="box-body">
						  <div class="box-footer">
							<button type="submit" class="btn btn-primary">Update</button>
							<button type="reset" class="btn btn-primary btn-danger">Reset</button>
						  </div>
					  </div>
            </form>
			</div>
		</div>
	</div>
	  
	  
    </section>





<?php include_once('footer.php'); ?>