<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php $ed = $con->query("select * from user_master where user_master_id = '".$_GET['id']."'")->fetch_object(); ?>
   <section class="content-header">
      <h1>
       Edit User
      </h1>
   </section>

    <!-- Main content -->
    <section class="content">
	  
<div class="row">
<div class="col-md-6">		
<div class="box box-primary">
<div class="box-header with-border">
				  <h3 class="box-title">Fillup Information</h3>
				</div>	
<div class="box-body">	 
			<form action="Process/edit_user_proce.php" method="post" enctype="multipart/form-data">
			  
                <div class="form-group">
                  <label for="exampleInputEmail1">Full Name</label>
                  <input type="text" name="fullname" class="form-control" value="<?php echo $ed->full_name; ?>" id="" placeholder="Enter your Name here.." required>
					<input type="hidden" name="id_user" value="<?php echo $ed->user_master_id; ?>" />
				</div>
				<div class="form-group">
                  <label for="exampleInputPassword1"> User Name</label>
                  <input type="text" name="username" class="form-control" value="<?php echo $ed->username; ?>" id="exampleInputPassword1" placeholder="Enter UserName" readonly>
                </div>
				<div class="form-group">
                  <label for="exampleInputEmail1">Password</label>
                  <input type="password" name="userpass" class="form-control" id="password" value="123456" placeholder="Enter Your Password">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Confirm Password</label>
                  <input type="password" name="confirmpass" class="form-control" value="123456" id="confirm_password" placeholder="Confirm Password..">
                </div>
				 
				<div class="form-group">
                  <label for="exampleInputPassword1"> User Photo</label>
                  <input type="file" name="user_img" class="form-control" accept="image/*" id="exampleInputPassword1" placeholder="Upload Photo">
                </div>
</div>				
</div>				
		
		
		<?php 
			function com($val,$data)
			{
				$array = explode(",",$val);
				foreach( $array as $val )
				{
					if( $data == $val )
					{
						echo "checked";
					}
				}
			}
		?>
			
		<script>
			var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
			</script>	
			
<div class="row">
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Company Authentication</h3>
					</div>
					<div class="box-body">
						<?php while($sel_companyr = $sel_company->fetch_object()){ ?>
							<div class="form-group">
								<label class="control-sidebar-subheading">
								<?php echo $sel_companyr->company_name; ?>
								<input type="checkbox" name="company[]" value="<?php echo $sel_companyr->company_id; ?>" class="pull-left" <?php com($ed->company_authen,$sel_companyr->company_id); ?> >
								</label>
							</div>
						<?php } ?>
					</div>
				</div>
            </div>
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Year Authentication</h3>
					</div>
					<div class="box-body">
					<?php while($sel_dater = $sel_date->fetch_object()){ ?>
						<div class="form-group">
							<label>
							<?php echo $sel_dater->year; ?>
							<input type="checkbox" value="<?php echo $sel_dater->financial_id; ?>" name="year[]" class="pull-left" <?php com($ed->year_authen,$sel_dater->financial_id); ?> />
							</label>
						</div>
					<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>		
				
				<?php $que = $con->query("select * from page ORDER BY id ASC LIMIT 21,41"); ?>
				<?php $quea = $con->query("select * from page ORDER BY id ASC LIMIT 21 "); ?>

			<div class="row">
				<div class="col-md-6">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Page Authentication</h3>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="box-body">
									<?php while($quear = $quea->fetch_object()){ ?>
										<div class="form-group">
											<label class="control-sidebar-subheading">
												<input type="checkbox" name="page[]" value="<?php echo $quear->val; ?>" <?php com($ed->page_authen,$quear->val); ?> />
												<?php echo "&nbsp;&nbsp;".$quear->name; ?>
											</label>
										</div>
									<?php } ?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="box-body">
									<?php while($quer = $que->fetch_object()){ ?>
										<div class="form-group">
											<label class="control-sidebar-subheading">
												<input type="checkbox" name="page[]" value="<?php echo $quer->val; ?>" <?php com($ed->page_authen,$quer->val); ?> />
												<?php echo "&nbsp;&nbsp;".$quer->name; ?>
											</label>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>		
				</div>		
				
				
				
				
				
				
				
			
			
			
				
			

</div>
             <div class="row">
			<div class="col-md-12">
				<div class="box">
						  <div class="box-footer">
							<button type="submit" name="submit" class="btn btn-primary">Submit</button>
							<button type="reset" class="btn btn-primary btn-danger">Reset</button>
						  </div>
					 	
				</div>
				</div>
				</div>
            </form>
		
	
    </section>
    <!-- /.content -->





<?php include_once('footer.php'); ?>