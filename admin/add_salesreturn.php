<?php include_once('header.php'); ?>
<?php include_once('sidebar.php');?>
<?php $sel_pur_no1 = $conn->query("SELECT * FROM sales_return_mst ORDER BY id DESC LIMIT 1")->fetch_object();?>
<?php 
if( !isset($_GET['invoice_id_sel'])){ echo "<script>window.location='return_sal_sel.php';</script>"; }
$sels = $conn->query("select * from sales_mst where s_id = '".$_GET['invoice_id_sel']."'")->fetch_object();
$client = $con->query("select * from client_master where client_id = '".$sels->act_no."'")->fetch_object();
$product = $conn->query("select * from sales_detail_mst where s_id = '".$_GET['invoice_id_sel']."'");
?>
    <section class="content-header">
      <h1>
        Sales Return Invoice 
       </h1>
      
    </section>
	<form action="Process/sales_return_invoice.php" enctype="multipart/form-data" method="post">
	
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
						  <input type="text" class="form-control" id="account_name_sales" name="client_name" value="<?php echo $client->client_name; ?>" autocomplete="off" spellcheck="false" placeholder="Account Name" readonly>
						</div>
					</div>
					<input type="hidden" id="client_id" value="<?php echo $sels->act_no ?>" name="for_pre_client_id" />
					<div class="col-md-6">
						<div class="form-group">
						<label for="">Sales Invoice No.</label>
							<input type="text" class="form-control" id="account_name_sales" name="sl_no" value="<?php echo $sels->s_numner; ?>" autocomplete="off" spellcheck="false" placeholder="Account Name" readonly>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
								  <label for="">Account Address</label>
								  <textarea type="text" name="client_address" class="form-control" id="client_address_sales" placeholder="Enter Client Address" readonly><?php echo $client->client_address; ?></textarea>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label for="">Sales Return  NO.</label>
								<input type="text" class="form-control" value="SR_<?php if(empty($sel_pur_no1->id)){echo 1;} else {echo $sel_pur_no1->id+1;} ?>" id="" name="s_number" placeholder="sales return nmuber" readonly>
								<input type="hidden" name="id_s" value="<?php echo $sel_pur_no1->id + 1; ?>" />
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						  <label for="">Party's GSTIN </label>
						  <input type="text" class="form-control" id="client_tin_sales" value="<?php echo $client->gst; ?>" name="client_tin" placeholder="" readonly>
						</div>
						
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">CH NO.</label>
							<input type="text" class="form-control" id="chalan_no" value="<?php echo $sels->ch_no; ?>" name="chalan_no" placeholder="Enter Ch No." readonly>
						</div>
					</div>
				
					
					<div class="col-md-6">
								<div class="form-group">
									<label>Date :</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" id="returtody_chalan_date" name="today_date" class="form-control" placeholder="select Date">	
										</div>
								</div>
							</div>
								<div class="col-md-6">
					<div class="form-group">
							<label>CH. Date </label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" placeholder="Select Chalan Date" name="chalan_date" value="<?php echo $sels->ch_date; ?>" id="" autocomplete="off" spellcheck="false"  class="form-control" readonly>
								</div>
								<script> 
								$(function()
								{
								$('#returnsales_chalan_date').datepicker({
								autoclose: true,
								format: 'dd/mm/yyyy',
								});
								$('#returtody_chalan_date').datepicker({
								autoclose: true,
								format: 'dd/mm/yyyy',
								});
								$("#returtody_chalan_date").datepicker("setDate", new Date());
								});
			
								</script>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Transport</label>
						  <input type="text" class="form-control" id="trans_return_invoice" name="transport_name" placeholder="Transport">
						</div>
					</div>
				
						
					
					<div class="col-md-6">
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Project Name</label>
							    <select id="re_sales_invoice_pro" name="project_name" class="form-control" required>
									<option value="">-- Select Project Name --</option>
									<?php while($sel_projectsr = $sel_projects->fetch_object()){ ?>
										<option value="<?php echo $sel_projectsr->project_id; ?>" <?php if($sel_projectsr->project_id == $sels->prj_id){ echo "selected"; } ?>><?php echo $sel_projectsr->project_name; ?></option>
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
			<div class="box">
			<div class="box-header with-border">
					<h3 class="box-title" id="click2"> Product detail</h3>
				</div>
				<table id="table" class="table table-bordered table-hover">
						<thead>
							<tr>
							  <th>SR. No.</th>
							  <th>Product Name</th>
							  <th>Description</th>
							  <th>Unit</th>
							  <th>Quntity</th>
							  <th>Rate</th>
							  <th>Total Rate</th>
							  <th>Remarks</th>
							  <th></th>
							</tr>
						</thead>
						<tbody class="input_fields_wrap_sales"><?php $subtotal = 0; ?>
						<?php $c = 0; while($productr = $product->fetch_object()){ $c++; ?>
							<tr id="<?php echo $c; ?>">
								<td><?php echo $c; ?><input type="hidden" name="sr_no_product[]" value="1" /><input type="hidden" id="rem<?php echo $c; ?>" value="<?php echo $productr->sd_id; ?>" /></td>
								<td><input type="text" id="sales_detail" value="<?php echo $productr->pr_name; ?>" name="product_name[]" style="width:120px;" readonly/></td>
								<td><textarea style="width:100px;" value="<?php echo $productr->p_desc; ?>" name="discription[]" id="product_desc_sales" readonly> <?php echo $productr->p_desc; ?></textarea></td>
								<td><input type="text" id="sales_detail" value="<?php echo $productr->unit; ?>" name="unit[]" style="width:120px;" readonly/></td>
								<td><input type="text" style="width:70px;" name="quntity[]" class="<?php echo $c; ?>" value="<?php echo $productr->qty; ?>" id="sales_total<?php echo $c; ?>_quentity" /></td>
								<td><input type="text" style="width:70px;" name="price[]" value="<?php echo $productr->rate; ?>" id="sales_total<?php echo $c; ?>"/></td>
								<td><input type="text" style="width:70px;" name="total_price[]" value="<?php echo $productr->amt; ?>" id="sales_total<?php echo $c; ?>_Toprice" readonly/></td>
								<td><textarea style="width:70px;" name="remarks_detail[]"></textarea></td>
								<td><a href="javascript:;" id="remove<?php echo $c ?>">Remove</a></td>
							</tr>
							
							
				
							<script>
								$(function(){
									
									$('#remove<?php echo $c ?>').click(function(){
										var r = confirm("Are You Sure You Want To Delete This Row ? ");
											if (r == true) {
												var ida = $('#table tbody>tr:last').attr('id');
												if( ida != '1' )
												{
													$('#<?php echo $c; ?>').remove();
													
													totalPriceAll( ida );
													return false;
												}else
												{
													alert('Mininum One Row Required');
												}
											
									}	else {
										return false;
										}
									});
							
								$('#sales_total<?php echo $c; ?>').keyup( Toprice );
								$('#sales_total<?php echo $c; ?>_quentity').keyup( Toprice1 );
								});
							</script>
							
							
							
							
							
							
							
						<?php $subtotal += $productr->amt; } ?>
						</tbody>
						<tfoot>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th>Total :></th>
								<th></th>
								<th></th>
								<th id="allPrice"><?php echo $subtotal; ?></th>
								<th colspan="2"></th>
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
						  <label for="">Against Form</label>
						  <input type="text" class="form-control" id="sales_re_agnst" placeholder="Against Form" name="Against_Form">
						</div>
						
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Freight</label>
								<input type="number" min="0" class="form-control" id="freight" name="freight" placeholder="Enter Freight" value="0">
						</div>
					</div>
					<div class="col-md-6">
					<div class="form-group">
						  <label for="">Good Dispatch From</label>
						  <input type="text" class="form-control" id="" name="good_dispatch_from" placeholder="Good Dispatch From">
						</div>
						
					</div>	
					<div class="col-md-6">
							<div class="form-group">
						  <label for="">Total Amount</label>
						  <input type="text" class="form-control" id="totalpricewith_tax_sales" value="<?php echo $subtotal; ?>" autocomplete="off" spellcheck="false" name="total_amount" placeholder="Total Amount" readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Good Dispatch To</label>
						  <input type="text" class="form-control" id="" name="good_dispatch_to" placeholder="Good Dispatch To">
						</div>
					</div>

					
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">GSTIN</label>
						  <input type="text" class="form-control" value="<?php echo $se_com_vat->gst; ?>" id="" name="com_vat_no" placeholder="VAT NO." readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							  <label for="">Remarks</label>
							  <textarea type="text" name="remarks" class="form-control" id="" placeholder="Remarks"></textarea>
						</div>
					</div>
					
					
						<div class="col-md-6">
						<div class="form-group">
							<label>Due Date </label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control" name="due_date" placeholder="Select Due Date" autocomplete="off" spellcheck="false" id="returnsales_due_date" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
								</div>
																<script> 
								$(function()
								{
								$('#returnsales_due_date').datepicker({
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
							<button type="submit" onclick="return auth()" class="btn btn-primary">Submit</button>
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
		function Toprice(){
			
		var que = parseFloat( $('#'+this.id+'_quentity').val() );
		var price = parseFloat( $(this).val() );
		
		if(price && que){
			$('#'+this.id+'_Toprice').val( que * price );
			var ida = $('#table tbody>tr:last').attr('id');
			totalPriceAll( ida );
		}
	};
	
	

	
	function Toprice1(){
		var que = parseFloat( $('#sales_total'+this.className).val() );
		var price = parseFloat( $('#sales_total'+this.className+'_quentity').val());
		if(price && que){
			$('#sales_total'+this.className+'_Toprice').val( que * price );
			var ida = $('#table tbody>tr:last').attr('id');
			totalPriceAll( ida );
		}
	};
	
function totalPriceAll( ida ) {
		var out = 0;
		var av = 0;
		var totaltax = 0;
		while(out < ida){
			out++;
			var total = parseFloat($('#sales_total'+out+'_Toprice').val());
			if(!total)
			{
				total = 0;
			}
			var av = av + total;
		}
		$('#allPrice').html( av );
		$('#t_price_without_tax_sales').val( av );
		$('#totalpricewith_tax_sales').val( av );
		
}
</script>
<script>
function auth()
{
		tab = $('#table tbody>tr:last').attr('id');
		
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
}
</script>

<?php include_once('footer.php'); ?>