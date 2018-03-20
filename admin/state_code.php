<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>


<section class="content-header">
      <h1>
        Manage State
      </h1>
    </section>
<form action="Process/state_pro.php" method="post">
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
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Fillup Information</h3>
					</div>
			
					<div class="box-body">
						<div class="col-md-6">
							<div class="form-group">
							  <label for="">Enter State Name</label>
							  <input type="text" class="form-control" id="" name="name" placeholder="Enter State Name" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label for="">Enter State Code</label>
							  <input type="number" min="0" class="form-control" id="" name="code" placeholder="Enter State Code" required>
							</div>
						</div>
					</div>
					<div class="box-body">
						<div class="box-footer">
							<div class="col-md-12">
								<div class="form-group">
									<button type="submit" id="purchase_invoic" class="btn btn-primary big">Submit</button>
									<button type="reset" class="btn btn-primary btn-danger big">Reset</button>
								</div>
							</div>
							</div>
							</div>
				</div>
			</div>
			
				<div class="col-md-6" style="display:none;" id="row_pur_in">
					<div class="box" id="result_purchase" style="overflow-x:scroll;">
						
					</div>
				</div>
		</div>
		
			
		
		
			</section>	
				</form>
<script>
window.onload = function(){searchFilter();};
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#product_name_id_hidden').val();
    var sortBy = $('#sortBy').val();
    $.ajax({
        type: 'POST',
        url: 'manage_search/state_get.php',
        data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
        success: function (html) {
			$('#row_pur_in').fadeIn('slow');
			$('#result_purchase').html(html);
        }
    });
}

function reset(){	
window.location.href = location.pathname.substring(location.pathname.lastIndexOf("/") + 1);
}


</script>
<?php include_once('footer.php'); ?>