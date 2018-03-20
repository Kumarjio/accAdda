<?php include_once('config/config.php'); ?>
<?php if(!isset($_GET['sales_invoice_id'])){ header("location:manage_sales_invoice.php"); exit; } ?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>

<?php $query = $conn->query("SELECT * FROM sales_mst where s_id = '".$_GET['sales_invoice_id']."'")->fetch_object(); ?>
<?php $account = $con->query("select * from company_mas where company_id = '".$query->c_id."'")->fetch_object(); ?>
<?php $account1 = $con->query("select * from client_master where client_id = '".$query->act_no."'")->fetch_object(); ?>
<?php $query2 = $conn->query("SELECT * FROM sales_detail_mst where s_id = '".$query->s_id."'"); ?>
<?php $project = $con->query("select * from project_master where project_id = '".$query->prj_id."'")->fetch_object(); ?>


<section class="content-header">
    <h1>Sales Invoice - <?php echo $query->s_numner; ?></h1>
</section>
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
    <section class="content invoice">
      <div class="row" id="HTMLtoPDF">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe">
			</i><?php echo $account->company_name; ?>
		   <small class="pull-right">Date: 
		   <?php echo $query->s_date; ?></small>
          </h2>
        </div>
      </div>
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong><?php echo $account1->client_name; ?></strong><br>
            <?php echo $account1->client_address; ?><br>
            Phone: <?php echo $account1->client_contact_no; ?><br>
            Email: <?php echo $account1->client_email; ?>
          </address>
        </div>
        <div class="col-sm-4 invoice-col pill-right">
          <b>Invoice No:  <?php echo $query->s_numner; ?> </b><br>
          <b>Project Name:  <?php if(!empty($query->prj_id)){ echo $project->project_name; } ?> </b><br>
          <b>Po No:</b>  <?php echo $query->po_no; ?><br>
          <b>Po Date:</b>  <?php echo $query->po_date; ?><br>
          <b>Lr No:</b>  <?php echo $query->lr_no; ?><br>
          <b>Lr Date:</b>  <?php echo $query->lr_date; ?><br>
        </div>
		 <div class="col-sm-4 invoice-col pill-right">
		 <b>Chalan No,:</b>  <?php echo $query->ch_no; ?><br>
		  <strong>Good Dispatch</strong><br>
          <b>From:</b>  <?php echo $query->from; ?><br>
          <b>To:</b>  <?php echo $query->to; ?><br>
          <b>Remark:</b>  <?php echo $query->to; ?><br>
          <b>Payment Due:</b>  <?php echo $query->due_date; ?><br>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
				<tr>
					  <th>Sr.no</th>
					  <th>Product</th>
					  <th>HSN/SAC</th>
					  <th>GST Rate</th>
					  <th>Unit</th>
					  <th>Description</th>
					  <th>Quantity</th>
					  <th>Rate</th>
					  <th>Amount</th>
				</tr>
            </thead>
            <tbody>
			<?php $sr = 0; $q = 0; $subtotal = 0; while($query1 = $query2->fetch_object()){ $sr++;?>
            <tr>
				  <td> <?php echo $sr; ?></td>
				  <td> <?php echo $query1->pr_name; ?></td>
				  <td><?php echo $query1->HSN; ?></td>
				  <td><?php echo $query1->grate." %"; ?></td>
				  <td> <?php echo $query1->unit; ?></td>
				  <td><?php echo $query1->p_desc; ?></td>
				  <td><?php echo $query1->qty; ?></td>
				  <td><?php echo $query1->rate; ?></td>
				  <td><?php echo $query1->amt; ?></td>
            </tr>
			<?php $q += $query1->qty; $subtotal = $subtotal + $query1->amt;} ?>
            </tbody>
			<tfoot>
				<tr>
					<th colspan="6" style="text-align:right;">Total</th>
					<th colspan=""><?php echo $q." nos"; ?></th>
					<th colspan=""></th>
					<th colspan=""><?php echo $subtotal; ?></th>
				</tr>
			</tfoot>
          </table>
        </div>
      </div>
     <?php $det_tax = $conn->query("SELECT * FROM sales_detail_mst where s_id = '".$query->s_id."'"); ?>
	
      <div class="row">
	   <?php if($query->igst === '0.00') { ?>
	   <div class="col-xs-9 table-responsive">
          <table class="table table-striped">
            <thead>
				<tr>
					  <th rowspan="2" style="vertical-align: middle;">HSN/SAC</th>
					  <th rowspan="2" style="vertical-align: middle;">Taxable Value</th>
					  <th colspan="2" style="text-align:center;">Central Tax</th>
					  <th colspan="2" style="text-align:center;">State Tax</th>
				</tr>
				<tr>
					<th>Rate</th>
					<th>Amount</th>
					<th>Rate</th>
					<th>Amount</th>
				</tr>
            </thead>
            <tbody>
			<?php $subto = 0; while($det_taxr = $det_tax->fetch_object()){ $cgst = $det_taxr->amt * $det_taxr->grate / 100;  ?>
            <tr>
				  <td><?php echo $det_taxr->HSN;?></td>
				  <td><?php echo $det_taxr->amt;?></td>
				  <td><?php echo intval($det_taxr->grate) / 2 ." %"; ?></td>
				  <td><?php echo $cgst / 2; ?></td>
				  <td><?php echo intval($det_taxr->grate) / 2 ." %"; ?></td>
				  <td><?php echo $cgst / 2; ?></td>
            </tr>
			<?php  $subto += $det_taxr->amt; } ?>
            </tbody>
			<tfoot>
				<tr>
					<th style="text-align:right;">Total</th>
					<th><?php echo $subto; ?></th>
					<th></th>
					<th><?php echo $query->cgst; ?></th>
					<th></th>
					<th><?php echo $query->sgst; ?></th>
				</tr>
			</tfoot>
          </table>
        </div>
	   <?php }else if ($query->igst != '0.00'){ ?>
	   <div class="col-xs-9 table-responsive">
          <table class="table table-striped">
            <thead>
				<tr>
					  <th rowspan="2" style="vertical-align: middle;">HSN/SAC</th>
					  <th rowspan="2" style="vertical-align: middle;">Taxable Value</th>
					  <th colspan="2" style="text-align:center;">Central Tax</th>
				</tr>
				<tr>
					<th>Rate</th>
					<th>Amount</th>
				</tr>
            </thead>
            <tbody>
			<?php $subto = 0; while($det_taxr = $det_tax->fetch_object()){ $cgst = $det_taxr->amt * $det_taxr->grate / 100;  ?>
            <tr>
				  <td><?php echo $det_taxr->HSN;?></td>
				  <td><?php echo $det_taxr->amt;?></td>
				  <td><?php echo intval($det_taxr->grate) ." %"; ?></td>
				  <td><?php echo $cgst ; ?></td>
            </tr>
			<?php  $subto += $det_taxr->amt; } ?>
            </tbody>
			<tfoot>
				<tr>
					<th style="text-align:right;">Total</th>
					<th><?php echo $subto; ?></th>
					<th></th>
					<th><?php echo $query->igst; ?></th>
				</tr>
			</tfoot>
          </table>
        </div>
	   <?php } ?>
        <div class="col-xs-3 pull-right table-responsive">
          <div class="table-responsive">
            <table class="table table-striped">
			<thead>
			<tr>
                <th style="width:50%"></th>
                <td></td>
              </tr>
			  <tr>
                <th style="width:50%"></th>
                <td></td>
              </tr>
			</thead>
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td><?php echo $subtotal; ?></td>
              </tr>
			  <?php if ($query->igst == '0.00'){ ?>
              <tr>
                <th>CGST</th>
                <td><?php echo $query->cgst; ?></td>
              </tr>
			   <tr>
                <th>SGST</th>
                <td><?php echo $query->sgst; ?></td>
              </tr>
			  <?php } else if($query->igst != '0.00'){ ?>
				<tr>
                <th>IGST</th>
                <td><?php echo $query->igst; ?></td>
              </tr>
			  <?php } ?>
              <tr>
                <th>Freight:</th>
                <td> <?php echo $query->freight; ?></td>
              </tr>
              <tr>
                <th>Total:</th>
                <td><?php echo $query->total_amt; ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="row no-print">
        <div class="col-xs-12">
		<div class="col-md-6">
			<div class="form-group">
				
					<input type="hidden" name="id" value="<?php echo $_GET['sales_invoice_id']; ?>"	/>
						
			</div>
		</div>
           <a href="fpdf/smail.php?id=<?php echo $_GET['sales_invoice_id']; ?>"> <button type="submit" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Send Mail
          </button></a>
         <a href="fpdf/invoice_s.php?id=<?php echo $_GET['sales_invoice_id']; ?>"> <button type="submit" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button></a>
        
        </div>
      </div>
    </section>
<div class="clearfix"></div>
<?php include_once('footer.php'); ?>