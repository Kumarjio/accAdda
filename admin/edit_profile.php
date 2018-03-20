<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>

<section class="content-header">
      <h1>
        Edit Profile
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
	<form method="post" action="Process/edit_profile_pro.php" enctype='multipart/form-data' >
    <div class="row">
        <div class="col-md-6">
			<div class="box box-primary">
				<div class="box-body box-profile">
				<span class="btn btn-default btn-file" style="margin:10px auto; display:table;">
				
					<img class="profile-user-img img-responsive img-circle" id="blah" style="width:35% !important;" src="<?php echo $q->user_photo; ?>" alt="User profile picture">
					<input type="file" id="imgInp" name="img" title=" " />
				</span>
					<div class="form-group">
						<label for="">UserName</label>
						<input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>" />
						<input type="text" class="form-control" id="wid_magage_product_id" name="user" value="<?php echo $q->username; ?>" placeholder="Enter UserName" autocomplete="off" spellcheck="false" readonly>
					</div>
					<div class="form-group">
						<label for="">Full Name</label>
						<input type="text" class="form-control" id="wid_magage_product_id" name="name" value="<?php echo $q->full_name; ?>" placeholder="Enter Full Name" autocomplete="off" spellcheck="false" required>
					</div>	
					<ul class="list-group list-group-unbordered">
						
					</ul>

					  <button type="submit" class="btn btn-primary"><b>Save</b></button>
					  <a href="edit_pass.php" class="btn btn-primary btn-danger">Change Password</a>
				</div>
			</div>
		</div>
	</div>
	</form>
</section>
<script>
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
$(function(){
$("#imgInp").change(function(){
    readURL(this);
});
$('#imgInp').attr('title', '');
});
</script>


<?php include_once('footer.php'); ?>