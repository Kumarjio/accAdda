<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php $view_company = $con->query('SELECT * FROM `company_mas` WHERE company_id = "'.$_GET['view_company_id'].'"')->fetch_object(); ?>
<section class="content-header">
      <h1>
        Add New Company
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
        <!-- left column -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h4>Fill Information</a></h4>
            </div>
            <form action="Process/add_com_pro.php" method="post" name="" enctype="multipart/form-data">
              <div class="box-body">
			   <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1"> Name</label>
                  <input type="text" class="form-control" name="company_name" value="<?php echo $view_company->company_name; ?>" id="" readonly>
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Contact Person's Name</label>
                 <input type="text" class="form-control" name="contact_person_name" id="" value="<?php echo $view_company->contact_person_name; ?>" readonly>
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputPassword1">Contact No</label>
                  <input type="text" class="form-control" name="company_contact_no" value="<?php echo $view_company->contact_no; ?>" id="" readonly>
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group ">
                  <label for="exampleInputPassword1">Contact Persons's Number</label>
                 <input type="text" class="form-control" name="contact_person_number" id="" value="<?php echo $view_company->contact_person_no; ?>" readonly>
                </div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
                  <label for="exampleInputPassword1">Email ID</label>
                  <input type="text" class="form-control" name="company_email" value="<?php echo $view_company->comp_email; ?>" id="" readonly>
                </div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
                  <label for="exampleInputPassword1">Address</label>
                  <textarea class="form-control" name="company_address" id="" placeholder="Enter Address" readonly><?php echo $view_company->comp_address; ?></textarea>
                </div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
                  <label for="exampleInputPassword1">GSTIN</label>
                  <input type="text" class="form-control" name="gst_no" id="" value="<?php echo $view_company->gst; ?>" placeholder="Enter GSTIN" readonly>
                </div>
				</div>
				<div class="col-md-4">
						<div class="form-group">
							<label>State Name</label>
							    <select name="state_code" id="state" class="form-control" disabled >
									<option value="">-- Select State Name --</option>
									<?php while($stater = $state->fetch_object()){ ?>
										<option <?php if($view_company->state ==  $stater->code ){ echo "selected"; } ?> value="<?php echo $stater->code; ?>"><?php echo $stater->name; ?></option>
									<?php } ?>
								</select>
						</div>
				</div>
				<div class="col-md-2">
				<div class="form-group">
                  <label for="exampleInputPassword1">State Code</label>
                  <input type="text" class="form-control" name="" value="<?php echo $view_company->state; ?>" id="code" placeholder="State Code" readonly>
                </div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
                  <label for="exampleInputPassword1">V.A.T No</label>
                  <input type="text" class="form-control" name="vat_no" id="" value="<?php echo $view_company->comp_vat_no; ?>" readonly>
                </div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
                  <label for="exampleInputPassword1">C.S.T No</label>
                   <input type="text" class="form-control" name="cst_no" id="" value="<?php echo $view_company->comp_cst_no; ?>" readonly>
                </div>
				</div>  
          </div>
		  </div>
            
        
		  </div>
		   
			
			
             
		    </form>
		  
		   

         
        
         
      </div>
		<div class="row">
			<div class="col-md-12">
			<div class="box box-primary">
			<div class="box-body">
				<div class="form-group ">
				 <label for="exampleInputPassword1">Header Image</label><br>
                  <img src="<?php echo $view_company->header_img; ?>" style="height:150px; width:100%;" />
                </div>
				<div class="form-group ">
				 <label for="exampleInputPassword1">Footer Image</label><br>
                  <img src="<?php echo $view_company->footer_img; ?>" style="height:150px; width:100%; " />
                </div>
				<div class="form-group ">
				 <label for="exampleInputPassword1">Stamp Image</label><br>
                  <img src="<?php echo $view_company->stamp_img; ?>" style="height:150px" />
                </div>
			</div>
			</div>
			</div>
		</div>
    </section>



<script src="plugins/state_select.js"></script>

<?php include_once('footer.php'); ?>
 