<?php include_once('config/config.php'); ?>
<?php if(!isset($_GET['id'])){ header("location:manage_purchase_invoice.php"); exit; } ?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>

<?php $query = $conn->query("SELECT * FROM sales_return_mst where id = '".$_GET['id']."'")->fetch_object(); ?>
<?php $account = $con->query("select * from company_mas where company_id = '".$query->c_id."'")->fetch_object(); ?>
<?php $account1 = $con->query("select * from client_master where client_id = '".$query->act_no."'")->fetch_object(); ?>
<?php $query2 = $conn->query("SELECT * FROM sales_return_detail_mst where s_id = '".$query->id."'"); ?>
<?php $project = $con->query("select * from project_master where project_id = '".$query->prj_id."'")->fetch_object(); ?>


<section class="content-header">
    <h1>Sales Return Invoice - <?php echo $query->pr_no; ?></h1>
</section>
    <section class="content invoice">
      <div class="row" id="HTMLtoPDF">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe">
			</i><?php echo $account->company_name; ?>
		   <small class="pull-right">Date: 
		   <?php echo $query->pr_date; ?></small>
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
          <b>Invoice No:  <?php echo $query->purchase_inv_no; ?> </b><br>
          <b>Return Invoice No:  <?php echo $query->pr_no; ?> </b><br>
          <b>Project Name:  <?php if(!empty($query->prj_id)){ echo $project->project_name; } ?> </b><br>
          <b>Chalan No.:  <?php echo $query->ch_no; ?> </b><br>
          <b>Chalan Date:  <?php echo $query->ch_date; ?> </b><br>
        </div>
		 <div class="col-sm-4 invoice-col pill-right">
		  <strong>Good Dispatch:</strong><br>
          <b>From:</b>  <?php echo $query->from; ?><br>
          <b>To:</b>  <?php echo $query->to; ?><br>
          <b>Remark:</b>  <?php echo $query->remark; ?><br>
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
				  <td> <?php echo $query1->p_name; ?></td>
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
					<th colspan="4" style="text-align:right;">Total</th>
					<th colspan=""><?php echo $q." nos"; ?></th>
					<th colspan=""></th>
					<th colspan=""><?php echo $subtotal; ?></th>
				</tr>
			</tfoot>
          </table>
        </div>
      </div>
     <?php $det_tax = $conn->query("SELECT * FROM sales_return_detail_mst where s_id = '".$query->id."'"); ?>
	
      <div class="row">

	 
        <div class="col-xs-3 pull-right pull-bottom table-responsive">
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
              <tr>
                <th>Freight:</th>
                <td> <?php echo $query->freight; ?></td>
              </tr>
              <tr>
                <th>Total:</th>
                <td><?php echo $query->total; ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      
	  <div class="row no-print">
        <div class="col-xs-12">
		
			 <a href="fpdf/sreturn.php?id=<?php echo $_GET['id']; ?>"> <button type="submit" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button></a>
		
		</div>
		</div>
	  
	  
    </section>
<div class="clearfix"></div>
<?php include_once('footer.php'); ?>