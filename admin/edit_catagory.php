<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); error_reporting(0); ?>

<section class="content-header">
      <h1>
        Manage Category
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
	<?php $up_cat = $con->query("select * from catagory_master where catagory_id = '".$_GET['edit_cat_id']."'"); 
	$up_catr = $up_cat->fetch_object();
	?>
   <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
		  <div class="box-header with-border">
					<h3 class="box-title">Edit Category</h3>
				</div>
            <form action="Process/edit_catagory_process.php" method="post" enctype="multipart/form-data" >
			<input type="hidden" name="cat_id" value="<?php echo $up_catr->catagory_id; ?>" />
              <div class="box-body">
                <div class="form-group">
                  <input type="text" class="form-control" id="" value="<?php echo $up_catr->name; ?>" name="catagory_name" placeholder="Enter category name" required>
                </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update Category</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
		</div>
	</div>
	</div>
			


    </section>






<?php include_once('footer.php'); ?>