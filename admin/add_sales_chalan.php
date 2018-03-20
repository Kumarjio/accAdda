<?php if(empty($_POST)) {
	include_once('config/config.php');
	$_SESSION['emsg'] = 'Somthing Went Wrong Please Select Chalan';
	header('location:add_sales_invoice.php');
	exit;
} ?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php');




$query_detail = ""; 
$Tfreight = 0;
$total = 0; $cgst = 0; $sgst = 0; $igst = 0; $_chalan = array();
$last = count($_POST['chalan']); $conter = 1;
foreach($_POST['chalan'] as $index => $val ){
	if($conter != $last)
	{
		$query_detail .= "s_id ='".$_POST['chalan'][$index]."' or " ;
		$conter++;	
	}
	else
	{
		$query_detail .= "s_id = '".$_POST['chalan'][$index]."'" ;
	}
	
}
$client_data = $con->query("select * from client_master where client_id = '".$_POST['for_pre_client_id']."'")->fetch_object();
$chalan_details = $conn->query("select * from quatation_detail_mst where ".$query_detail);

$chalan = $conn->query("select * from quatation_mst where ".$query_detail);

while($chalanr = $chalan->fetch_object())
{
	array_push($_chalan,$chalanr->s_numner);
	$Tfreight += $chalanr->freight;
	if( $chalanr->igst != '0.00' )
	{
		$igst += $chalanr->igst; 
	}
	
	if( $chalanr->cgst != '0.00' && $chalanr->sgst != '0.00' )
	{
		$cgst += $chalanr->cgst;
		$sgst += $chalanr->sgst;
	}
	$total += $chalanr->total_amt;
}

if($client_data->client_series != '0'){
		$prefix_det = $con->query("select * from prefix_master where prefix_id = '".$client_data->client_series."' ")->fetch_object();
		$s_de = $conn->query("select * from sales_mst where s_numner LIKE '".$prefix_det->prefix_code."%' ORDER BY s_id DESC LIMIT 1")->fetch_object();
		if(empty($s_de->s_id)){
			$code = 1;
			$billbookno = 1;
		}
		else 
		{
			$lcode = ltrim($s_de->s_numner,$prefix_det->prefix_code."_"); $code = rtrim($lcode,"_".$prefix);
			if(empty($code))
			{
				$_s = substr($lcode, strpos($lcode, "_") - 1); 
				$code = substr($_s , 0 ,1);
			}
			$code = intval($code) + 1;
			if($s_de->billbookno == '0')
			{
				$s_de->billbookno = 1;
			}
			if( $code - 1  == intval($prefix_det->total_page) * intval($s_de->billbookno))
			{
				$billbookno = intval($s_de->billbookno) + 1;
			}else
			{
				$billbookno = $s_de->billbookno;
			}
		}
}
$company = $con->query("select * from company_mas where company_id = '".$_SESSION['company_id']."'")->fetch_object();
if( $company->state == $client_data->state )
{
		if($client_data->gst == '')
		{
			$tax_type = "Local-Retail";
		}
			
		if($client_data->gst != '')
		{
			$tax_type = "Local-Tax";
		}
}
else if( $company->state != $client_data->state )
{
		if($client_data->gst == '')
		{
			$tax_type = "InterState-Retail";
		}
			
		if($client_data->gst != '')
		{
			$tax_type = "InterState-Tax";
		}
}
?>
    <section class="content-header">
      <h1>
        Add Sales Invoice 
       </h1>
    </section>
	<form action="Process/add_sales_invoice_process.php" id="form_full" method="post">
	<?php foreach($_POST['chalan'] as $index => $val) { ?>
<input type="hidden" name="flag[]" value="<?php echo $_POST['chalan'][$index]; ?>" />
	<?php } ?>
	<section class="content">
   <?php if(isset($_SESSION['emsg'])){ ?>
	<div class="alert alert-danger" id="fade">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<?php echo $_SESSION['emsg']; ?>
	</div>
	<?php } unset($_SESSION['emsg']); ?>
	<?php if(isset($_SESSION['msg'])){ ?>
	<div class="alert alert-success" id="fade">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<?php echo $_SESSION['msg']; ?>
	</div>
	<?php } unset($_SESSION['msg']); ?>
    <div class="row">
        <div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body">
				<div class="box-header with-border">
					<h3 class="box-title">Fillup Information</h3>
				</div>
				
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Account Name </label>
						  <input type="text" class="form-control" id="account_name_sales" value="<?php echo $client_data->client_name; ?>" name="client_name" readonly>
							<input type="hidden" name="for_pre_client_id" value="<?php echo $_POST['for_pre_client_id']; ?>" />
						</div>
					</div>
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
								  <textarea type="text" name="client_address" class="form-control" id="client_address_sales" placeholder="" readonly><?php echo $client_data->client_address; ?></textarea>
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
						  <input type="text" class="form-control" id="client_tin_sales" value="<?php echo $client_data->gst; ?>" name="client_tin" placeholder="" readonly>
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
						  <label for="">Sales Type</label>
						  <input type="text" class="form-control" value="<?php echo $tax_type; ?>" id="client_cst_sales" name="client_cst" placeholder="" readonly>
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
						  <label for="">Invoice No</label>
						  <input type="text" class="form-control" value="<?php if($client_data->client_series != '0'){ echo $prefix_det->prefix_code."_".$code."_".$prefix; } ?>" id="invoice_se_re" name="invoice" placeholder="" readonly>
						</div>
					</div>
					<?php if($client_data->client_series == '0'){ ?>
					<div class="col-md-6">
						<div class="form-group">
							<label>Series</label>
							<select name="client_series" id="sel_series" class="form-control" required>
								<option value="">-- Select Series For This Invoice --</option>
								<?php $sel_prefix = $con->query('select * from prefix_master'); while($sel_prefixr = $sel_prefix->fetch_object()){?>
									<option value="<?php echo $sel_prefixr->prefix_id; ?>" ><?php echo $sel_prefixr->serial_name; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				<?php } ?>
					<script>
						$(function(){
							$('#sel_series').change(function(){
								$.ajax({
									method : "POST",
									url : "search/series_check.php",
									dataType : 'json',
									data : "id="+$(this).val(),
									success:function( out ){
										$('#invoice_se_re').val(out.invoice);
										$('#billbook_ph_r').val(out.bill);
									}
								});
							});
						});
					</script>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Bill Book No</label>
						  <input type="text" class="form-control" value="<?php if($client_data->client_series != '0'){ echo $billbookno; } ?>" id="billbook_ph_r" name="billbook" placeholder="" readonly>
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
							<label>Project Name</label>
							    <select name="project_name" id="" class="form-control" required>
									<option value="">-- Select Project Name --</option>
									<?php while($sel_projectsr = $sel_projects->fetch_object()){ ?>
										<option value="<?php echo $sel_projectsr->project_id; ?>"><?php echo $sel_projectsr->project_name; ?></option>
									<?php } ?>
								</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Date </label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" placeholder="Select Date" name="date" value="<?php echo date('d/m/Y'); ?>" class="form-control" readonly>
								</div>
								
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Chalan No. </label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" placeholder="Select Date" name="chalan_no_max" value="<?php echo implode(",",$_chalan);  ?>" class="form-control" readonly>
								</div>
								
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
					<h3 class="box-title" id="click2"> Sales detail</h3>
				</div>
				<table id="table" class="table table-bordered table-hover" style="margin-bottom:0px;">
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
							  <th>CGST</th>
							  <th>SGST</th>
							  <th>IGST</th>
							  <th>Remarks</th>
							  <th></th>
							</tr>
						</thead>
						<tbody class="input_fields_wrap_sales">
						<?php $subtotal = 0; $co = 0; $cggst = 0; while($delati = $chalan_details->fetch_object()){ $co++; ?>
							<tr>
								<td><?php echo $co; // $cigst = $delati->qty * $delati->rate * $delati->grate / 100 ; ?></td>
								<td><input type="hidden" name="id_pro[]" value="<?php echo $delati->p_name ?>" /><input type="text" id="sales_detail" name="product_name[]" value="<?php echo $delati->pr_name; ?>" style="width:120px;" readonly/></td>
								<td><input type="text" id="hsn" name="hsn[]" value="<?php echo $delati->HSN; ?>" style="width:120px;" readonly/></td>
								<td><textarea style="width:100px;" name="discription[]" id="product_desc_sales" readonly><?php echo $delati->p_desc; ?></textarea></td>
								<td><input type="text" style="width:70px;" value="<?php echo $delati->grate." %"; ?>" name="gst_rate[]" id="gst_rate" readonly></td>
								<td><input type="text" style="width:100px;" id="product_unit_sales" name='product_unit[]' value="<?php echo $delati->unit; ?>" readonly></td>
								<td><input type="text" style="width:70px;" name="quntity[]" value="<?php echo $delati->qty; ?>" id="sales_total1_quentity" readonly/></td>
								<td><input type="text" style="width:70px;" name="price[]" id="sales_total1" value="<?php echo $delati->rate; ?>" readonly/></td>
								<td><input type="text" style="width:70px;" name="total_price[]" value="<?php echo $tot = $delati->qty * $delati->rate; $cigst = $tot * $delati->grate / 100; ?>" id="sales_total1_Toprice" readonly/></td>
								<td><input type="text" style="width:70px;" name="" value="<?php if( $company->state == $client_data->state ){ echo $cigst / 2; } ?>" id="" readonly/></td>
								<td><input type="text" style="width:70px;" name="" value="<?php if( $company->state == $client_data->state ){ echo $cigst / 2; } ?>" id="" readonly/></td>
								<td><input type="text" style="width:70px;" name="" value="<?php if( $company->state != $client_data->state ){ echo $cigst; } ?>" id="" readonly/></td>
								<td><textarea style="width:70px;" name="remarks_detail[]" readonly><?php echo $delati->remark; ?></textarea></td>
								
							</tr>
						<?php $subtotal += $tot; $cggst += $cigst; } ?>
						</tbody>
						<tfoot>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th>Total :></th>
								<th></th>
								<th></th>
								<th id="allPrice"><?php echo $subtotal; ?></th>
								<th id="allPrice"><?php if( $company->state == $client_data->state ){ echo $cggst / 2; } ?></th>
								<th id="allPrice"><?php if( $company->state == $client_data->state ){ echo $cggst / 2; } ?></th>
								<th id="allPrice"><?php if( $company->state != $client_data->state ){ echo $cggst ; } ?></th>
								<th></th>
							</tr>
						</tfoot>
				</table>
				<input type="hidden" id="t_price_without_tax_sales" value="<?php echo $subtotal; ?>" name="price_without_tax_sales" />
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
						  <label for="">VAT NO.</label>
						  <input type="text" class="form-control" value="<?php echo $se_com_vat->comp_vat_no; ?>" id="" name="com_vat_no" placeholder="VAT NO." readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Freight</label>
								<input type="text" class="form-control" value="<?php echo $Tfreight; ?>" id="freight" name="freight" placeholder="Enter Freight" value="0" >
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">CST NO.</label>
						  <input type="text" class="form-control" value="<?php echo $se_com_vat->comp_cst_no; ?>" id="" name="com_cst_no" placeholder="CST NO." readonly>
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
						  <label for="">Good Dispatch To</label>
						  <input type="text" class="form-control" class="form-control" id="" name="good_dispatch_to" placeholder="Good Dispatch To">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Total Amount</label>
						  <input type="text" class="form-control" value="<?php echo $subtotal + $Tfreight + $cgst + $sgst + $igst; ?>" class="form-control" id="totalpricewith_tax_sales" name="total_amount" placeholder="Total Amount" readonly>
						</div>
					</div>
					<input type="hidden" name="cgst" value="<?php echo $cgst ?>" />
					<input type="hidden" name="sgst" value="<?php echo $sgst ?>" />
					<input type="hidden" name="igst" value="<?php echo $igst ?>" />
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Good Dispatch From</label>
						  <input type="text" class="form-control" class="form-control" id="" name="good_dispatch_from" placeholder="Good Dispatch From">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							  <label for="">Remarks</label>
							  <textarea type="text" name="remark" class="form-control" class="form-control" id="" placeholder="Remarks"></textarea>
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
								<button type="submit" name="submit" class="btn btn-primary">Submit</button>
								<button type="reset" class="btn btn-primary btn-danger">Reset</button>
							</div>
						</div>
        </div>
		
      </div>
	  </div>
</section>
</form>

<?php include_once('footer.php'); ?>