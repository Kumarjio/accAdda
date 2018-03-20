<?php include_once('header.php'); ?>
<?php include_once('sidebar.php');?>
<?php $sel_pur_no = $conn->query("SELECT * FROM quatation_mst ORDER BY s_id DESC LIMIT 1")->fetch_object(); 
$chalan = $conn->query("SELECT * FROM purchase_mst where s_id = '".$_GET['id']."'")->fetch_object();
$client = $con->query("Select * from client_master where client_id = '".$chalan->act_no."'")->fetch_object();
?>
<form action="Process/edit_pi_pro.php" id="form_full" method="post"> 
 <section class="content-header">
      <h1>
        Edit Purchase Invoice 
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
						  <input type="text" class="form-control" value="<?php echo $client->client_name; ?>" id="account_name_sales" name="client_name" autocomplete="off" spellcheck="false" placeholder="Account Name" required disabled>
							<input type="hidden" id="tax_type" value="<?php if($client->state == $se_com_vat->state ){ echo "1"; }else{ echo "3"; } ?>" />
							<input type="hidden" name="for_pre_client_id" value="<?php echo $client->client_id; ?>" />
							<input type="hidden" name="s_id_u" value="<?php echo $_GET['id'] ?>" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Date </label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" placeholder="Select Date" value="<?php echo $chalan->s_date; ?>" name="date" id="" class="form-control" readonly>
								</div>
								<script> 
								$(function()
								{
								$('#product_date_sales').datepicker({
								autoclose: true,
								format: 'dd/mm/yyyy',
								});
											
								});
			
								</script>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
								  <label for="">Account Address</label>
								  <textarea type="text" name="client_address" class="form-control" id="client_address_sales" placeholder="" readonly><?php echo $client->client_address; ?></textarea>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label for="">Chalan No.</label>
								  <input type="text" class="form-control" id="" value="<?php echo $chalan->ch_no; ?>" name="ch_no" placeholder="Enter Chalan No.">
								</div>
					</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Party's GSTIN</label>
						  <input type="text" class="form-control" id="client_tin_sales" value="<?php echo $client->gst; ?>" name="client_tin" placeholder="" readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Chalan Date </label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" placeholder="Select Chalan Date" value="<?php echo $chalan->ch_date ?>" name="ch_date" id="product_lr_date_sales" class="form-control">
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
							<label>Sel Type</label>
							    <input type="text" class="form-control" value="<?php if( $client->state == $se_com_vat->state && !empty($client->gst) ) { echo "Local Tax"; }else if($client->state == $se_com_vat->state && empty($client->gst) ) { echo "Local Retail"; } else if($client->state != $se_com_vat->state && empty($client->gst) ){ echo "InterState Retail"; }else if($client->state != $se_com_vat->state && !empty($client->gst) ){ echo "InterState Tax"; } ?>"  placeholder="Enter Lr No." readonly>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Transport</label>
						  <input type="text" class="form-control" value="<?php echo $chalan->transport; ?>" id="" name="transport_name" placeholder="Transport">
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Purchase Invoice No.</label>
						  <input type="text" class="form-control" value="<?php echo $chalan->s_numner; ?>" id="" name="qa_no" placeholder="Quatation No." readonly>
							
						</div>
					</div>
					
					
					
					
					
					
					
					<div class="col-md-6">
						<div class="form-group">
							<label>Project Name</label>
							    <select name="project_name" id="" class="form-control" required>
									<option value="">-- Select Project Name --</option>
									<?php while($sel_projectsr = $sel_projects->fetch_object()){ ?>
										<option value="<?php echo $sel_projectsr->project_id; ?>" <?php if($sel_projectsr->project_id == $chalan->prj_id){ echo "selected"; } ?> ><?php echo $sel_projectsr->project_name; ?></option>
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
				<table id="table" class="table table-bordered table-hover">
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
						<?php $p_de = $conn->query("select * from purchase_detail_mst where s_id = '".$_GET['id']."'"); $c = 0; $su_total = 0; $cgst_s = 0; $sgst_s = 0; $igst_s = 0;
						while($p_der = $p_de->fetch_object()){ $c++;
						?>
							<tr id="<?php echo $c; ?>">
								<td><?php echo $c; ?><input type="hidden" name="sr_no_product[]" value="1" /><input type="hidden" name="" id="rem<?php echo $c; ?>" value="<?php echo $p_der->sd_id; ?>" /></td>
								<td><input type="hidden" value="<?php echo $p_der->p_name; ?>" name="id[]" id="id<?php echo $c; ?>" /><input type="hidden" value="<?php echo $p_der->grate; ?>" id="sales_detail<?php echo $c; ?>_grate"/><input type="text" id="sales_detail<?php echo $c; ?>" value="<?php echo $p_der->pr_name; ?>" name="product_name[]" style="width:120px;" required /></td>
								<td><input type="text" id="hsn<?php echo $c; ?>" name="hsn[]" value="<?php echo $p_der->HSN; ?>" style="width:100px;" readonly /></td>
								<td><textarea style="width:100px;" name="discription[]" id="product_desc_sales<?php echo $c; ?>"><?php echo $p_der->p_desc; ?></textarea></td>
								<td><input type="text" style="width:70px;" name="gst_rate[]" value="<?php echo $p_der->grate; ?> %" id="gst_rate<?php echo $c; ?>" readonly/></td>
								<td><input type="text" style="width:70px;" name="product_unit[]" value="<?php echo $p_der->unit; ?>" id="product_unit_sales<?php echo $c; ?>" readonly/></td>
								<td><input type="number" min="0" style="width:80px;" name="quntity[]" value="<?php echo $p_der->qty; ?>" class="<?php echo $c; ?>" id="sales_total<?php echo $c; ?>_quentity" required/></td>
								<td><input type="number" min="0" style="width:80px;" name="price[]" value="<?php echo $p_der->rate; ?>" id="sales_total<?php echo $c; ?>" required /></td>
								<td><input type="text" style="width:70px;" name="total_price[]" value="<?php echo $p_der->amt; ?>" id="sales_total<?php echo $c; ?>_Toprice" readonly/></td>
								<td><input type="text" style="width:70px;" value="<?php if( $client->state == $se_com_vat->state ) { $cgst_s += $p_der->amt  * $p_der->grate / 100 / 2; echo $p_der->amt  * $p_der->grate / 100 / 2; }else{ echo "0"; } ?>" name="" id="sales_total<?php echo $c; ?>cgst"  readonly/></td>
								<td><input type="text" style="width:70px;" value="<?php if( $client->state == $se_com_vat->state ) { echo $p_der->amt  * $p_der->grate / 100 / 2; }else{ echo "0"; } ?>" name="" id="sales_total<?php echo $c; ?>sgst" readonly/></td>
								<td><input type="text" style="width:70px;" value="<?php if( $client->state != $se_com_vat->state ) { $igst_s += $p_der->amt  * $p_der->grate / 100 ; echo $p_der->amt  * $p_der->grate / 100; }else{ echo "0"; } ?>" name="" id="sales_total<?php echo $c; ?>igst" readonly/></td>
								<td><textarea style="width:70px;" value="" name="remarks_detail[]"><?php echo $p_der->remark; ?></textarea></td>
								<td><?php $su_total += $p_der->amt;  ?><a href="" class="<?php echo $c; ?>" id="remove<?php echo $c; ?>">Remove</a></td>
							</tr>
							
							<script>
								$(function(){
									
									$('#remove<?php echo $c ?>').click(function(){
										var r = confirm("Are You Sure You Want To Delete This Row ? ");
											if (r == true) {
												
										$.ajax({
											method : "POST",
											url : "Process/delete_pi_row.php",
											data : "id="+$('#rem<?php echo $c; ?>').val(),
											success:function( data ){
												if(data == 'ok')
												{
													$('#<?php echo $c; ?>').fadeOut();	
													return true;
												}
												else
												{
													alert('Please Try Again.');
												}
											}
										});
									}else {
										return false;
										}
									});
									$('#sales_detail<?php echo $c; ?>').focus(function(){
										$( "#sales_detail<?php echo $c; ?>" ).autocomplete({
											  source: 'search/sales_detail.php',
												select:function(e, ui){
													e.preventDefault();
													$(this).val(ui.item.label);
													$('#gst_rate<?php echo $c; ?>').val(ui.item.gst+" %");
													$('#id<?php echo $c; ?>').val(ui.item.id);
													$('#hsn<?php echo $c; ?>').val(ui.item.hsn);
													$('#sales_detail<?php echo $c; ?>_grate').val(ui.item.gst);
													$('#product_desc_sales<?php echo $c; ?>').val(ui.item.discription);
													$('#product_unit_sales<?php echo $c; ?>').val(ui.item.unit);	
												},
												change: function( event, ui ) {
													if(ui.item==null)
													{
														this.value='';
													}
												}
										});
									});

								$('#sales_total<?php echo $c; ?>').keyup( Toprice );
								$('#sales_total<?php echo $c; ?>_quentity').keyup( Toprice1 );
								});
							</script>
							
							
							
							
							
							
						<?php } ?>
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
								<th id="allPrice"><?php echo $su_total; ?></th>
								<th id="cgstPrice"><?php if( $cgst_s != "0" ){ echo $cgst_s; }else{ echo "0"; } ?></th>
								<th id="sgstPrice"><?php if( $cgst_s != "0" ){ echo $cgst_s; }else{ echo "0"; } ?></th>
								<th id="igstPrice"><?php if( $igst_s != "0" ){ echo $igst_s; }else{ echo "0"; } ?></th>
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
								<input type="number" class="form-control" value="<?php echo $chalan->freight; ?>" min="0" id="" name="freight" placeholder="Enter Freight" value="0">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Against Form</label>
						  <input type="text" class="form-control" value="<?php echo $chalan->agnst; ?>" placeholder="Against Form" id="" name="Against_Form" placeholder="">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Total Amount</label>
						  <input type="text" class="form-control" value="<?php if($cgst_s != '0.00'){ $gst = $cgst_s * 2; }else{ $gst = $igst_s; } echo $su_total + $gst; ?>" class="form-control" id="totalpricewith_tax_sales" name="total_amount" placeholder="Total Amount" readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Good Dispatch From</label>
						  <input type="text" class="form-control" class="form-control" id="" value="<?php echo $chalan->from; ?>" name="good_dispatch_from" placeholder="Good Dispatch From">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Good Dispatch To</label>
						  <input type="text" class="form-control" class="form-control" id="" name="good_dispatch_to" value="<?php echo $chalan->to; ?>" placeholder="Good Dispatch To">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							  <label for="">Remarks</label>
							  <textarea type="text" name="remark" class="form-control" class="form-control" id="" placeholder="Remarks"><?php echo $chalan->remark; ?></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Due Date </label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control" name="due_date" placeholder="Select Due Date" id="product_due_date_sales" data-inputmask="'alias': 'dd/mm/yyyy'" value="<?php echo $chalan->due_date; ?>" data-mask>
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
							<button type="submit" onclick="return auth()" name="submit" class="btn btn-primary">Update</button>
							<button type="reset" class="btn btn-primary btn-danger">Reset</button>
						  </div>
						   <p id="errall" style="display:none; color: red; font-weight: 900; padding: 9px 0 0 12px;"></p>
					  </div>
        </div>
		
      </div>
	  </div>
</section>



<script>
		function Toprice(){
			
		var que = parseFloat( $('#'+this.id+'_quentity').val() );
		var price = parseFloat( $(this).val() );
		
		if(price && que){
			$('#'+this.id+'_Toprice').val( que * price );
			var asdf = parseFloat($('#'+this.id.replace('sales_total','sales_detail')+'_grate').val());
			if( $('#tax_type').val() == '2' || $('#tax_type').val() == '1' )
			{
				$('#'+this.id+'cgst').val( que * price * asdf / 100 / 2 );
				$('#'+this.id+'sgst').val( que * price * asdf / 100 / 2 );
			}
			else if( $('#tax_type').val() == '3' || $('#tax_type').val() == '4' )
			{
				$('#'+this.id+'igst').val( que * price * asdf / 100  );
			}
			var ida = $('#table tbody>tr:last').attr('id');
			totalPriceAll( ida );
		}
	};
	
	function Toprice1(){
		var que = parseFloat( $('#sales_total'+this.className).val() );
		var price = parseFloat( $('#sales_total'+this.className+'_quentity').val());
		if(price && que){
			$('#sales_total'+this.className+'_Toprice').val( que * price );
			var asdf = parseFloat($('#sales_detail'+this.className+'_grate').val());
			if( $('#tax_type').val() == '2' || $('#tax_type').val() == '1' )
			{
				$('#sales_total'+this.className+'cgst').val( que * price * asdf / 100 / 2 );
				$('#sales_total'+this.className+'sgst').val( que * price * asdf / 100 / 2 );
			}
			else if( $('#tax_type').val() == '3' || $('#tax_type').val() == '4' )
			{
				$('#sales_total'+this.className+'igst').val( que * price * asdf / 100  );
			}
			var ida = $('#table tbody>tr:last').attr('id');
			totalPriceAll( ida );
		}
	};
	
	function Topricere(){
			var ida = $('#table tbody>tr:last').attr('id');
			totalPriceAll( ida );
	};
	
function totalPriceAll( ida ) {
		var out = 0;
		var av = 0;
		var totaltax = 0;
		while(out < ida){
			out++;
			var id = parseFloat($('#sales_detail'+out+'_grate').val());
			var total = parseFloat($('#sales_total'+out+'_Toprice').val());
			if(!total)
			{
				total = 0;
			}
			var av = av + total;
			if(total != 0)
			{
			totaltax += total * id / 100; 
			}
		}
		$('#allPrice').html( av );
		$('#t_price_without_tax_sales').val( av );
		$('#totalpricewith_tax_sales').val( av + totaltax  );
		if( $('#tax_type').val() == '2' || $('#tax_type').val() == '1' )
			{
				$('#cgstPrice').html( parseFloat(totaltax) / 2 );
				$('#sgstPrice').html( parseFloat(totaltax) / 2 );
			}
			else if( $('#tax_type').val() == '3' || $('#tax_type').val() == '4' )
			{
				$('#igstPrice').html( parseFloat(totaltax) );
			}
		
		
}
</script>
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
<script src="plugins/dynamicadd/dynemic_pi_sledit.js"></script>

<?php include_once('footer.php'); ?>