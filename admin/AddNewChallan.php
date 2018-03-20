<?php include_once('header.php'); ?>
<?php include_once('sidebar.php');?>
<?php $sel_pur_no = $conn->query("SELECT * FROM quatation_mst ORDER BY s_id DESC LIMIT 1")->fetch_object(); ?>
    <section class="content-header">
      <h1>
        Add New Challan 
       </h1>
      
    </section>
	<form action="Process/add_challan_process.php" id="form_full" method="post">
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
			<div class="box-body">
				<div class="box-header with-border">
					<h3 class="box-title"> Fillup Information</h3>
				</div>
				
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Account Name </label>
						  <input type="text" class="form-control" id="account_name_sales" name="client_name" autocomplete="off" spellcheck="false" placeholder="Account Name" required>
							<input type="hidden" id="tax_type" />
						</div>
					</div>
					<input type="hidden" name="for_pre_client_id" id="client_id" />
					<div class="col-md-6">
								<div class="form-group">
								  <label for="">PO NO.</label>
								  <input type="text" class="form-control" id="" name="po_no" placeholder="Enter Po No.">
								</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
								  <label for="">Account Address</label>
								  <textarea type="text" name="client_address" class="form-control" id="client_address_sales" placeholder="" readonly></textarea>
								</div>
							</div>
							<div class="col-md-6">
						<div class="form-group">
							<label>PO Date </label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" placeholder="Select PO Date" name="po_date" id="product_po_date_sales" class="form-control">
								</div>
								<script> 
								$(function()
								{
								$('#product_po_date_sales').datepicker({
								autoclose: true,
								format: 'dd/mm/yyyy',
								});
								});
			
								</script>
						</div>
					</div>	
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Party's GSTIN</label>
						  <input type="text" class="form-control" id="client_tin_sales" name="client_tin" placeholder="" readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">L R No</label>
						  <input type="text" class="form-control" id="" name="lr_no" placeholder="Enter Lr No.">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Sel Type</label>
							    <select name="" id="client_cst_sales" class="form-control" disabled>
									<option>--  --</option>
									<?php while($sel_typer = $sel_type->fetch_object()){ ?>
										<option value="<?php echo $sel_typer->id; ?>"><?php echo $sel_typer->type; ?></option>
									<?php } ?>
								</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>LR Date </label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" placeholder="Select LR Date" name="lr_date" id="product_lr_date_sales" class="form-control">
								</div>
								<script> 
								$(function()
								{
								$('#product_lr_date_sales').datepicker({
								autoclose: true,
								format: 'dd/mm/yyyy',
								});
								});
			
								</script>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Challan NO.</label>
						  <input type="text" class="form-control" value="CH_<?php if(empty($sel_pur_no->s_id)){echo 1;} else {echo $sel_pur_no->s_id+1;} ?>" id="" name="qa_no" placeholder="Quatation No." readonly>
							<input type="hidden" name="id_purchase_invoice" value="<?php if(empty($sel_pur_no->s_id)){echo 1;} else {echo $sel_pur_no->s_id+1;} ?>" />
						</div>
					</div>
					
					
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Transport</label>
						  <input type="text" class="form-control" id="" name="transport_name" placeholder="Transport">
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
							<label>Date </label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" placeholder="Select Date" name="date" id="product_date_sales" class="form-control">
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
						</div>
					</div>
					
					
					<div class="col-md-6">
						<div class="form-group">
							<label>Project Name</label>
							    <select name="project_name" id="" class="form-control" required>
									<option value="">-- Select Project Name --</option>
									<?php while($sel_projectsr = $sel_projects->fetch_object()){ ?>
										<option value="<?php echo $sel_projectsr->project_id; ?>"><?php echo $sel_projectsr->project_name; ?></option>
									<?php } ?>
								</select>
						</div>
					</div>
				
			</div>
        </div>
      </div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="box" style="overflow-x:scroll;">
			<div class="box-header with-border">
					<h3 class="box-title" id="click2">Product detail</h3>
				</div>
				<table id="table" style=" margin-bottom: 0px;" class="table table-bordered table-hover">
						<thead>
							<tr>
							  <th>SR. No.</th>
							  <th>Product Name</th>
							  <th>HSN/SAC</th>
							  <th>Description</th>
							  <th>GST Rate</th>
							  <th>Unit</th>
							  <th>Quntity</th>
							  <th>Rate</th>
							  <th>Total Rate</th>
							  <th>CGST Rate</th>
							  <th>SGST Rate</th>
							  <th>IGST Rate</th>
							  <th>Remarks</th>
							  <th></th>
							</tr>
						</thead>
						<tbody class="input_fields_wrap_sales">
							<tr id="1">
								<td>1<input type="hidden" name="sr_no_product[]" value="1" /></td>
								<td><input type="hidden" name="id[]" id="id" /><input type="hidden" id="sales_detail1_grate"/><input type="text" id="sales_detail" class="1d" name="product_name[]" style="width:120px;" required /></td>
								<td><input type="text" id="hsn" name="hsn[]" style="width:100px;" readonly /></td>
								<td><textarea style="width:100px;" name="discription[]" id="product_desc_sales"></textarea></td>
								<td><input type="text" style="width:70px;" name="gst_rate[]" id="gst_rate" readonly/></td>
								<td><select id="product_unit_sales" name='product_unit[]'><option>Select Unit</option><?php while($sel_unitr = $sel_unit->fetch_object()){ ?><option><?php echo $sel_unitr->unit_name; ?></option><?php } ?></select></td>
								<td><input type="number" style="width:80px;" name="quntity[]" min="0" class="1" id="sales_total1_quentity" required/></td>
								<td><input type="number" style="width:80px;" name="price[]" min="0" value="" id="sales_total1" required/></td>
								<td><input type="text" style="width:70px;" value="0" name="total_price[]" id="sales_total1_Toprice" readonly/></td>
								<td><input type="text" style="width:70px;" value="0" name="" id="sales_total1cgst" readonly/></td>
								<td><input type="text" style="width:70px;" value="0" name="" id="sales_total1sgst" readonly/></td>
								<td><input type="text" style="width:70px;" value="0" name="" id="sales_total1igst" readonly/></td>
								<td><textarea style="width:70px;" name="remarks_detail[]"></textarea></td>
								<td></td>
							</tr>
						</tbody>
						<tfoot>
						<tr>
							<td id=""></td>
							<td id="pr_name" style="color:red;" colspan="5"></td>
							<td id="qty_nm" style="color:red;" colspan="3"></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
							<tr>
								<th></th>
								<th><button type="button" class="btn btn-primary" id="add_field_button_sales">Add New Row</button></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th>Total :></th>
								<th></th>
								<th id="allPrice">0</th>
								<th id="cgstPrice">0</th>
								<th id="sgstPrice">0</th>
								<th id="igstPrice">0</th>
								<th ></th>
							</tr>
						</tfoot>
				</table>
				<input type="hidden" id="t_price_without_tax_sales" name="price_without_tax_sales" />
			</div>	
		</div>
	</div>
		<?php $se_com_vat = $con->query("select * from company_mas where company_id = '".$_SESSION['company_id']."'")->fetch_object(); ?>

	<div class="row">
        <div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body">
				
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">GSTIN NO.</label>
						  <input type="text" class="form-control" value="<?php echo $se_com_vat->gst; ?>" id="" name="com_vat_no" placeholder="VAT NO." readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Freight</label>
								<input type="number" class="form-control" id="" min="0" name="freight" placeholder="Enter Freight" value="0">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Against Form</label>
						  <input type="text" class="form-control" placeholder="Against Form" id="" name="Against_Form" placeholder="">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Total Amount</label>
						  <input type="text" class="form-control" class="form-control" id="totalpricewith_tax_sales" name="total_amount" placeholder="Total Amount" readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Good Dispatch From</label>
						  <input type="text" class="form-control" class="form-control" id="" name="good_dispatch_from" placeholder="Good Dispatch From">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Good Dispatch To</label>
						  <input type="text" class="form-control" class="form-control" id="" name="good_dispatch_to" placeholder="Good Dispatch To">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							  <label for="">Remarks</label>
							  <textarea type="text" name="remark" class="form-control" class="form-control" id="" placeholder="Remarks" ></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Due Date </label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control" name="due_date" placeholder="Select Due Date" id="product_due_date_sales" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
								</div>
								<script> 
								$(function()
								{
								$('#product_due_date_sales').datepicker({
								autoclose: true,
								format: 'dd/mm/yyyy',
								});
								});
			
								</script>
						</div>
					</div>
			</div>
			<div class="box-body">
						  <div class="box-footer">
							<button type="submit" name="submit" onclick="return auth()" class="btn btn-primary">Submit</button>
							<button type="reset" class="btn btn-primary btn-danger">Reset</button>
						  </div>
						  <p id="errall" style="display:none; color: red; font-weight: 900; padding: 9px 0 0 12px;"></p>
					  </div>
        </div>
		
      </div>
	  </div>
</section>
</form>
<script>
function auth()
{
	if($('#account_name_sales').val() != '')
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
		$('#errall').html("Please Select Acoount Name");
		return false;
	}
}
</script>
<script src="plugins/search/autocomplete_chalan_sl.js"></script>
<script src="plugins/dynamicadd/dynemic_chalan_sl.js"></script>

<?php include_once('footer.php'); ?>