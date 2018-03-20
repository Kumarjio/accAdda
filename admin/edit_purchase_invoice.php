<?php include_once('header.php'); ?>
<?php include_once('sidebar.php');?>
<?php $sel_pur_no = $conn->query("SELECT * FROM purchase_mst where s_id = '".$_GET['edit_purchase_invoice_id']."'")->fetch_object(); ?>
<?php $sel_data_via = $con->query("Select * from client_master where client_id = '".$sel_pur_no->act_no."'")->fetch_object(); ?>
    <section class="content-header">
      <h1>
	  
        Edit Purchase Invoice 
       </h1>
      
    </section>
<form action="Process/add_purchase_invoice_process.php" id="form_full" enctype="multipart/form-data" method="post">
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
						  <input type="text" class="form-control" id="account_name" value="<?php echo $sel_data_via->client_name; ?>" name="client_name" autocomplete="off" spellcheck="false" placeholder="Account Name" readonly>
						</div>
					</div>
					<input type="hidden" name="client_id" value="<?php echo $sel_pur_no->act_no; ?>" id="client_id" />
					<div class="col-md-6">
						<div class="form-group">
							<label>Date :</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" id="edit_pur_id_date" name="today_date" value="<?php echo $sel_pur_no->s_date; ?>" class="form-control">	
								</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
								  <label for="">Account Address</label>
								  <textarea type="text" name="client_address" value="" class="form-control" id="client_address" placeholder="" readonly><?php echo $sel_data_via->client_address; ?></textarea>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label for="">CH NO.</label>
								  <input type="text" class="form-control" id="" value="<?php echo $sel_pur_no->ch_no; ?>" name="chalan_no" placeholder="Enter Ch No.">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Party's T.I.N No</label>
						  <input type="text" class="form-control" value="<?php echo $sel_data_via->client_tin; ?>" id="client_tin" name="client_tin" placeholder="" readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>CH. Date </label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" placeholder="Select Chalan Date" value="<?php echo $sel_pur_no->ch_date; ?>" name="chalan_date" id="product_chalan_date" class="form-control" >
								</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Party's C.S.T No.</label>
						  <input type="text" class="form-control" value="<?php echo $sel_data_via->client_tin; ?>" id="client_cst" name="client_cst" placeholder="" readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Transport</label>
						  <input type="text" class="form-control" id="" value="<?php echo $sel_pur_no->transport; ?>" name="transport_name" placeholder="Transport">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">PI NO.</label>
							<input type="text" class="form-control" value="<?php echo $sel_pur_no->s_numner; ?>" id="" name="pi_no" placeholder="P I No." readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Project Name</label>
							    <select id="" name="project_name" class="form-control">
									<option >-- Select Project Name --</option>
									<?php while($sel_projectsr = $sel_projects->fetch_object()){ ?>
										<option value="<?php echo $sel_projectsr->project_id; ?>" <?php if($sel_projectsr->project_id == $sel_pur_no->prj_id){ echo "selected"; } ?>><?php echo $sel_projectsr->project_name; ?></option>
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
					<h3 class="box-title" id="click2"> Purchase detail</h3>
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
						
						<tbody class="input_fields_wrap">
						<?php $sel_purchase_detail = $conn->query('select * from purchase_detail_mst where s_id = "'.$_GET['edit_purchase_invoice_id'].'"'); $i=0; ?>
						<?php while($sel_purchase_detailr = $sel_purchase_detail->fetch_object()){ $i++;?>
							<tr id="<?php echo $i; ?>">
								<td><?php echo $i; ?></td>
								<td><input type="text" id="purchase_detail<?php echo $i; ?>" name="product_name[]" value="<?php echo $sel_purchase_detailr->p_name; ?>" style="width:120px;" readonly /></td>
								<td><textarea style="width:100px;" name="discription[]" id="product_desc<?php echo $i; ?>" readonly><?php echo $sel_purchase_detailr->p_desc; ?></textarea></td>
								<td><input type="text" name='product_unit[]' value="<?php echo $sel_purchase_detailr->unit; ?>" style="width:100px;" readonly /></td>
								<td><input type="text" style="width:70px;" name="quntity[]" value="<?php echo $sel_purchase_detailr->qty; ?>" id="purchase_total1_quentity"/></td>
								<td><input type="text" style="width:70px;" name="price[]" value="<?php echo $sel_purchase_detailr->rate; ?>" id="purchase_total1"/></td>
								<td><input type="text" style="width:70px;" name="total_price[]" value="<?php echo $sel_purchase_detailr->amt; ?>" id="purchase_total1_Toprice" readonly/></td>
								<td><textarea style="width:70px;" name="remarks_detail[]"></textarea></td>
								<td></td>
							</tr>
						<?php } ?>
						</tbody>
					<?php $acd =  $sel_pur_no->st_tax + $sel_pur_no->vat_tax + $sel_pur_no->cst_tax + $sel_pur_no->add_tax; $total_amo_without_tax = $sel_pur_no->total_amt - $acd;?>
						<tfoot>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th>Total :></th>
								<th></th>
								<th></th>
								<th id="allPrice"><?php echo $total_amo_without_tax; ?></th>
								<th colspan="2"><button type="button" class="btn btn-primary" id="add_field_button">Add New Row</button></th>
							</tr>
						</tfoot>
				</table>
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
								<input type="text" class="form-control" id="" value="<?php echo $sel_pur_no->freight; ?>" name="freight" placeholder="Enter Freight">
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
						  <label for="">TAX TYPE</label>
						  <input type="text" class="form-control" value="<?php echo $sel_pur_no->tax_type; ?>" id="tax_select" name="tax_type" autocomplete="off" spellcheck="false" placeholder="TAX TYPE">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Good Dispatch From</label>
						  <input type="text" class="form-control" id="" value="<?php echo $sel_pur_no->from; ?>" name="good_dispatch_from" placeholder="Good Dispatch From">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Good Dispatch To</label>
						  <input type="text" class="form-control" id="" value="<?php echo $sel_pur_no->to; ?>" name="good_dispatch_to" placeholder="Good Dispatch To">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Against Form</label>
						  <input type="text" class="form-control" value="<?php echo $sel_pur_no->agnst; ?>" placeholder="Against Form" id="" name="Against_Form" placeholder="">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">Total Amount</label>
						  <input type="text" class="form-control" value="<?php echo $sel_pur_no->total_amt; ?>" id="totalpricewith_tax" name="total_amount" placeholder="Total Amount">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							  <label for="">Remarks</label>
							  <textarea type="text" name="remarks" class="form-control" id="" placeholder="Remarks"><?php echo $sel_pur_no->remark; ?></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Due Date </label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control" value="<?php echo $sel_pur_no->due_date; ?>" name="due_date" placeholder="Select Due Date" id="product_due_date" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
								</div>
						</div>
					</div>
					<?php $tax_invoice = $con->query("select * from tax_master where tax_name = '".$sel_pur_no->tax_type."'")->fetch_object(); ?>
					<div class="col-md-12">
						<style>
							th{padding:0 55px 0 0;}
						</style>
						<div class="form-group">
							<label for=""></label>
								<table>
									<tr>
										<th><label>S.T. (<span id="st_persent"><?php echo $tax_invoice->st; ?></span> %) :  </label>  <br/></th>
										<td><span id="st_price"><?php echo $sel_pur_no->st_tax; ?></span><br/></td>
									</tr>
									<tr>
										<th><label>V.A.T. (<span id="vat_persent"><?php echo $tax_invoice->vat; ?></span> %) :  </label>  <br/></th>
										<td><span id="vat_price"><?php echo $sel_pur_no->vat_tax; ?></span><br/></td>
									</tr>
									<tr>
										<th><label>C.S.T (<span id="cst_persent"><?php echo $tax_invoice->cst; ?></span> %) :  </label>  <br /></th>
										<td><span id="cst_price"><?php echo $sel_pur_no->cst_tax; ?></span><br/></td>
									</tr>
									<tr>
										<th><label>G.S.T (<span id="gst_persent"></span> %) :  </label>  <br /></th>
										<td><span id="gst_price">0</span><br/></td>
									</tr>
									<tr>
										<th><label>Add.Tax (<span id="add_tax_persent"><?php echo $tax_invoice->add_tax; ?></span> %) : </label> <br/></th>
										<td><span id="add_tax_price"><?php echo $sel_pur_no->add_tax; ?></span><br/></td>
									</tr>
									<tr>
										<th><label>Round Off. : </label> <br/></th>
										<td><span id="ContentPlaceHolder1_lblrndf">0</span><br/></td>
									</tr>
								</table>
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
					<input type="hidden" name="st_tax" id="st_tax_tax" /> 
					<input type="hidden" name="vat_tax_tax" id="vat_tax_tax" /> 
					<input type="hidden" name="cst_tax_tax" id="cst_tax_tax" /> 
					<input type="hidden" name="add_tax_tax" id="add_tax_tax" /> 
</section>
</form>
<script src="plugins/dynamicadd/edit_dynamic.js"></script>
<script>
$(document).ready(function(){
	$('#edit_pur_id_date').datepicker({
				autoclose: true,
				format: 'dd/mm/yyyy',
    });
});
</script>

<?php include_once('footer.php'); ?>