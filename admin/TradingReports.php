<?php include_once('header.php'); ?>
<?php include_once('sidebar.php');
?>
<section class="content-header">
      <h1>
        Trading Report
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

	<div class="row" style="display:none;" id="row_pur_in">
		
	</div>	
	
	<div class="row no-print">
        <div class="col-xs-12">
		
			<a href="fpdf/trading.php" ><button type="submit" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button></a>
		
		</div>
		</div>
	
	
	
</section>
<script>
window.onload = function(){searchFilter();};
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    $.ajax({
        type: 'POST',
        url: 'manage_search/trading_report.php',
        data:'page='+page_num,
        success: function (html) {
					$('#row_pur_in').fadeIn('slow');
					$('#row_pur_in').html(html);
        }
    });
}
</script>	
	
	
	
	
	
	
	
	
	
<?php include_once('footer.php'); ?>