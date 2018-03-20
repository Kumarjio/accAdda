<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>




 <section class="content-header">
      <h1>
        Invoice
        <small>#007612</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Invoice</li>
      </ol>
    </section>

    <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Note:</h4>
        This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
      </div>
    </div>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row" id="HTMLtoPDF">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe">
			</i>
			<?php $query = $conn->query("SELECT * FROM purchase_mst where s_id = '1'")->fetch_object();?>
			<?php $account = $con->query("select * from company_mas where company_id = '".$query->c_id."'")->fetch_object(); ?>
			<?php $account1 = $con->query("select * from client_master where client_id = '".$query->act_no."'")->fetch_object(); ?>
			<?php $query2 = $conn->query("SELECT * FROM purchase_detail_mst where s_id = '1'");?>

				<?php echo $account->company_name; ?>
		   <small class="pull-right">Date: 
		   <?php echo $query->s_date; ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong><?php echo $account->company_name; ?></strong><br>
           <?php echo $account->comp_address; ?><br>
           Phone: <?php echo $account->contact_no; ?><br>
           Email: <?php echo $account->comp_email; ?><br>
            
            
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong><?php echo $account1->client_name; ?></strong><br>
            <?php echo $account1->client_address; ?><br>
            Phone: <?php echo $account1->client_contact_no; ?><br>
            Email: <?php echo $account1->client_email; ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice No:  <?php echo $query->s_numner; ?> </b><br>
          
          <b>Po No:</b>  <?php echo $query->po_no; ?><br>
          <b>Payment Due:</b>  <?php echo $query->due_date; ?><br>
        <?php //  <b>Account:</b> 968-34567 ?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Sr.no</th>
              <th>Product</th>
              <th>Unit</th>
              <th>Description</th>
			  <th>Qty</th>
			  <th>Rate</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
			<?php $sr = 0;?>
			<?php $subtotal = 0; while($query1 = $query2->fetch_object()){ ?>
			<?php $sr++ ?>

            <tr>
			
		
			  <td> <?php echo $sr; ?></td>
              <td> <?php echo $query1->p_name; ?></td>
              <td><?php echo $query1->unit; ?></td>
              <td><?php echo $query1->p_desc; ?></td>
			  <td> <?php echo $query1->qty; ?></td>
              <td><?php echo $query1->rate; ?></td>
              <td><?php echo $query1->amt; ?></td>
            </tr>
			<?php $subtotal = $subtotal + $query1->amt;} ?>
              
            </tbody>
          </table>
        </div>
		<?php $tax = 0; ?>
		<?php $tax = $tax + $query->st_tax + $query->vat_tax + $query->cst_tax ;?>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Payment Methods:</p>
          <img src="../../dist/img/credit/visa.png" alt="Visa">
          <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="../../dist/img/credit/american-express.png" alt="American Express">
          <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount Due <td> <?php echo $query->due_date; ?></td></p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td><?php echo $subtotal; ?></td>
              </tr>
              <tr>
                <th>Tax </th>
                <td><?php echo $tax; ?></td>
              </tr>
			   <tr>
                <th>Add. Tax </th>
                <td><?php echo $query->add_tax; ?></td>
              </tr>
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
        <!-- /.col -->
      </div>
      <!-- /.row -->
	
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice_print.php" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download" onclick="HTMLtoPDF"></i> Generate PDF
          </button>
        </div>
      </div>
    </section>
	
	<!-- these js files are used for making PDF -->
	<script src="js/jspdf.js"></script>
	<script src="js/jquery-2.1.3.js"></script>
	<script src="js/pdfFromHTML.js"></script>

<?php include_once('footer.php'); ?>