<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>

<section class="content-header">
      <h1>
        Change Password
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
	<?php $q = $con->query("select * from user_master where user_master_id = '".$_SESSION['id']."'")->fetch_object(); ?>
	<form method="post" action="Process/edit_pass_pro.php" enctype='multipart/form-data' >
    <div class="row">
        <div class="col-md-6">
			<div class="box box-primary">
				<div class="box-body box-profile">
                <div class="form-group">
                  <label>Old Password</label>

                  <div class="input-group">
                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>" />
					<input type="password" class="form-control" id="input" name="old" placeholder="Enter Old Password" autocomplete="off" spellcheck="false" required>
                    <div class="input-group-addon" onclick="toggler(this)" style="cursor: pointer"><i class="glyphicon glyphicon-eye-open"></i></div>
                  </div>
                </div>
				<div class="form-group">
                  <label>New Password</label>

                  <div class="input-group">
                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>" />
					<input type="password" class="form-control" id="input1" name="np" placeholder="Enter New Password" autocomplete="off" spellcheck="false" required>
                    <div class="input-group-addon" href="javascript:;" onclick="toggler1(this)" style="cursor: pointer"><i class="glyphicon glyphicon-eye-open"></i></div>
                  </div>
                </div>
				<div class="form-group">
                  <label>Confirm Password</label>

                  <div class="input-group">
                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>" />
					<input type="password" class="form-control" id="input2" name="ncp" placeholder="Enter Confirm Password" autocomplete="off" spellcheck="false" required>
                    <div class="input-group-addon" href="javascript:;" onclick="toggler2(this)" style="cursor: pointer"><i class="glyphicon glyphicon-eye-open"></i></div>
                  </div>
                </div>
				</div>
				<div class="box-footer">
				<button type="submit" class="btn btn-primary"><b>Change Password</b></button>
				</div>
			</div>
		</div>
	</div>
	</form>
</section>
<script>
function toggler(e) {
        if( e.innerHTML == '<i class="glyphicon glyphicon-eye-open"></i>' ) {
            e.innerHTML = '<i class="glyphicon glyphicon-eye-close"></i>'
            document.getElementById('input').type="text";
        } else {
            e.innerHTML = '<i class="glyphicon glyphicon-eye-open"></i>'
            document.getElementById('input').type="password";
        }
}
function toggler1(e) {
        if( e.innerHTML == '<i class="glyphicon glyphicon-eye-open"></i>' ) {
            e.innerHTML = '<i class="glyphicon glyphicon-eye-close"></i>'
            document.getElementById('input1').type="text";
        } else {
            e.innerHTML = '<i class="glyphicon glyphicon-eye-open"></i>'
            document.getElementById('input1').type="password";
        }
}
function toggler2(e) {
        if( e.innerHTML == '<i class="glyphicon glyphicon-eye-open"></i>' ) {
            e.innerHTML = '<i class="glyphicon glyphicon-eye-close"></i>'
            document.getElementById('input2').type="text";
        } else {
            e.innerHTML = '<i class="glyphicon glyphicon-eye-open"></i>'
            document.getElementById('input2').type="password";
        }
}
</script>



<?php include_once('footer.php'); ?>