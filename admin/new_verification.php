<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>

	<section class="content-header">
      <h1>
       Add New Project Verification
      </h1>
	</section>
   <form action="Process/process_new_verification.php" method="post">
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-body">
						<div class="form-group">
							<label for="">Project Name </label>
								<input type="text" class="form-control" id="account_name_newver" name="project_name" autocomplete="off" spellcheck="false" placeholder="Project Name" required>
								<input type="hidden" id="name_hidden_ver" name="hidden_pro_name">
								<p id="p_name" style="display:none; color:red;"></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-body">
						<div class="form-group">
							<label for="">To.</label>
								<input type="text" class="form-control" id="" name="to_add" autocomplete="off" spellcheck="false" placeholder="To." required>
								
								<p id="p_name" style="display:none; color:red;"></p>
						</div>
					</div>
				</div>
			</div>
			<script> 
								$(function()
								{
								$('#product_date_sales').datepicker({
								autoclose: true,
								format: 'dd/mm/yyyy',
								});
											$("#product_date_sales").datepicker("setDate", new Date());
								});
			
								</script>
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-body">
						<div class="form-group">
							<label for="">Date </label>
								<input type="text" class="form-control" id="product_date_sales" name="t_date" autocomplete="off" spellcheck="false" placeholder="Project Name" required>
								
								<p id="p_name" style="display:none; color:red;"></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<table id="table" class="table table-bordered table-hover">
							<thead>
								<tr>
								  <th>SR. No.</th>
								  <th>Date</th>
								  <th>Product</th>
								  <th>Description</th>
								  <th>Side</th>
								  <th>Channage</th>
								  <th>Quntity</th>
								  <th>Remark</th>
								</tr>
							</thead>
							<tbody class="input_email_row">
								<tr id="1">
									<td>1</td>
									<td><input type="text" id="ver_date" name="ver_date[]" style="width:120px;" required/></td>
									<td><input type="text" id="ver_product_name" name="ver_product_name[]" style="width:120px;" required/></td>
									<td><textarea style="width:100px;" name="ver_discription[]" id="ver_product_name_desc" required></textarea></td>
									<td><select name="ver_side[]" style="width:100px;"><option value="">Select Side</option><option value="L.H.S">L.H.S</option><option value="R.H.S">R.H.S</option><option value="Center">Center</option></select></td>
									<td><input type="text" style="width:100px;" name="ver_change[]" id="ver_change"/></td>
									<td><input type="text" style="width:100px;" name="ver_remark[]" id="ver_quen1" required/></td>
									<td><textarea style="width:120px;" name="remarks_detail[]"></textarea></td>
									<td></td>
								</tr>
							</tbody>
							<tfoot>
							<tr>
							<td id=""></td>
							<td id="pr_name" style="color:red;" colspan="5"></td>
							
						</tr>
								<tr>
									<th></th>
									<th></th>
									<th></th>
									<th>Total :></th>
									<th></th>
									<th><input type="hidden" id="all_price" name="total_qu" /></th>
									<th id="allPrice">0</th>
									<th colspan="2"><button type="button" class="btn btn-primary" id="add_verification_button">Add New Row</button></th>
								</tr>
							</tfoot>
					</table>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<table id="table_email" class="table table-bordered table-hover">
							<thead>
								<tr>
								  <th>SR. No.</th>
								  <th>Email Id</th>
								  <th></th>
								</tr>
							</thead>
							<tbody class="input_email_wrap">
								<tr id="1">
									<td>1</td>
									<td><input type="email" class="form-control" id="em1" name="ver_email[]" required/></td>
								</tr>
							</tbody>
							<tfoot>
							<tr>
							<th></th>
									<th id="pr_na" style="color:red;"></th>
									
									<th colspan="2"></th>
								</tr>
								<tr>
									<th></th>
									<th></th>
									<th colspan="2"><button type="button" class="btn btn-primary" id="add_email_button">Add New Row</button></th>
								</tr>
							</tfoot>
					</table>
				</div>
			</div>
		</div>
			<div class="box-footer">
				<div class="box-body">
					<button type="submit" class="btn btn-primary" onclick="return auth()">Submit</button>
					<button type="reset" class="btn btn-primary btn-danger">Reset</button>
				</div>
				 <p id="errall" style="display:none; color: red; font-weight: 900; padding: 9px 0 0 12px;"></p>
			</div>
	</section>
    </form>
 <script src="plugins/search/new_ver_auto.js"></script>
 <script src="plugins/dynamicadd/dynamic_ver_email.js"></script>
 <script src="plugins/dynamicadd/dynamic_ver_row.js"></script>
 <script>
function auth()
{
	if($('#account_name_newver').val() != '')
	{
		tab = $('#table tbody>tr:last').attr('id');
		for( j = 1; j <= tab; j++ )
		{
			as = $('#sales_detail'+j).val();
			if(as == '')
			{
				$('#errall').fadeIn("slow");
				$('#errall').html("Please Select Product Name");
				return false;
			}
		}
		for(i = 1; i <= tab; i++)
		{
			qu = $('#sales_total'+i+'_quentity').val();
			pr = $('#sales_total'+i).val();
			if( qu <= 0 || pr <= 0  )
			{
				$('#errall').fadeIn("slow");
				$('#errall').html("Please Check Quantity And Rate In Product Detail");
				return false;
			}
		}
	}else
	{
		$('#errall').fadeIn("slow");
		$('#errall').html("Please Select Project Name");
		$('#p_name').fadeIn("slow");
		$('#p_name').html("Please Select Project Name");
		return false;
	}
}
</script>
 
<?php include_once('footer.php'); ?>
