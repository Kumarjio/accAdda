<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>

   <section class="content-header">
      <h1>
       Add New User
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
			<form action="Process/add_user_proce.php" method="post" enctype="multipart/form-data">
			  
                <div class="form-group">
                  <label for="exampleInputEmail1">Full Name</label>
                  <input type="text" name="fullname" class="form-control" id="full" autocomplete="off" placeholder="Enter your Name here.." required>
                </div>
				<div class="form-group">
                  <label for="exampleInputPassword1"> User Name</label>
                  <input type="text" name="username" class="form-control" autocomplete="off" id="user" placeholder="Enter UserName" required>
				  <p style="color:red; display:none;"  id="uer"></p>
				  <p style="color:green; display:none;"  id="uok"></p>
                </div>
				<div class="form-group">
                  <label for="exampleInputEmail1">Password</label>
                  <input type="password" name="userpass" class="form-control" id="password" placeholder="Enter Your Password" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Confirm Password</label>
                  <input type="password" name="confirmpass" class="form-control" id="confirm_password" placeholder="Confirm Password.." required>
                </div>
				 
				<div class="form-group">
                  <label for="exampleInputPassword1"> User Photo</label>
                  <input type="file" name="user_img" class="form-control" accept="image/*" id="" placeholder="Upload Photo">
                </div>
</div>				
</div>				
		
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
								<input type="checkbox" name="company[]" value="<?php echo $sel_companyr->company_id; ?>" class="pull-left" >
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
							<input type="checkbox" value="<?php echo $sel_dater->financial_id; ?>" name="year[]" class="pull-left" />
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
												<input type="checkbox" name="page[]" value="<?php echo $quear->val; ?>" />
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
												<input type="checkbox" name="page[]" value="<?php echo $quer->val; ?>" />
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
				
				
				
				
				
				
				
			
			
			
				<input type="hidden" id="hid" />
			

</div>
             <div class="row">
			<div class="col-md-12">
				<div class="box">
						  <div class="box-footer">
							<button type="submit" name="submit" id="butoon" class="btn btn-primary">Submit</button>
							<button type="reset" class="btn btn-primary btn-danger">Reset</button>
						  </div>
					 	<p id="errall" style=" display:none; color: red; font-weight: 900; padding: 0 0 8px 12px;"></p>
				</div>
				</div>
				</div>
            </form>
		
	
    </section>
<script>
$(function(){
	$('#user').keyup(function(){
		
		
		$.ajax({
			type: 'POST',
			url: 'search/username_check.php',
			data:'page='+$(this).val(),
			success: function (html) {
				if(html === '1')
				{
					
					$('#uok').fadeOut("fast");
					$('#uer').fadeIn("slow");
					$('#uer').html("UserName Allready Exists Plz Try With Different Username");
					$('#hid').val("1");
				}
				else
				{
					$('#uer').fadeOut("fast");
					$('#uok').fadeIn("slow");
					$('#uok').html("Username Is Valid");
					$('#hid').val("0");
				}
			}
		});
	});

	$('#butoon').click(function(){
		if( $('#hid').val() == '1' )
		{
			$('#errall').fadeIn("slow");
			$('#errall').html("UserName Allready Exists Plz Try With Different Username");
			return false;
		}
		else
		{
			$('#errall').fadeOut("fast");
			return true;
		}
	});
	
});
</script>





<?php include_once('footer.php'); ?>