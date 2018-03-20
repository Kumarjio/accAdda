<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>

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
            <form action="add_com_pro.php" method="post" name="" enctype="multipart/form-data">
              <div class="box-body">
			   <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1"> Name</label>
                  <input type="text" class="form-control" name="company_name" id="" placeholder="Enter Name" required>
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Contact Person's Name</label>
                  <input type="text" class="form-control" name="contact_person_name" id="" placeholder="Enter Contact Person Name" required>
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputPassword1">Contact No</label>
                  <input type="text" class="form-control" name="company_contact_no" pattern="[789][0-9]{9}" id="" placeholder="Enter Contact No" required>
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group ">
                  <label for="exampleInputPassword1">Contact Persons's Number</label>
                 <input type="text" class="form-control" name="contact_person_number" pattern="[789][0-9]{9}" id="" placeholder="Enter Contact Person Number" required>
                </div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
                  <label for="exampleInputPassword1">Email ID</label>
                  <input type="text" class="form-control" name="company_email" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" id="" placeholder="Enter Email" required>
                </div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
                  <label for="exampleInputPassword1">Address</label>
                  <textarea class="form-control" name="company_address" id="" placeholder="Enter Address" required></textarea>
                </div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
                  <label for="exampleInputPassword1">GSTIN</label>
                  <input type="text" class="form-control" name="gst_no" id="" placeholder="Enter GSTIN">
                </div>
				</div>
				<div class="col-md-4">
						<div class="form-group">
							<label>State Name</label>
							    <select name="state_code" id="state" class="form-control" required>
									<option value="">-- Select State Name --</option>
									<?php while($stater = $state->fetch_object()){ ?>
										<option value="<?php echo $stater->code; ?>"><?php echo $stater->name; ?></option>
									<?php } ?>
								</select>
						</div>
				</div>
				<div class="col-md-2">
				<div class="form-group">
                  <label for="exampleInputPassword1">State Code</label>
                  <input type="text" class="form-control" name="" id="code" placeholder="State Code" readonly>
                </div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
                  <label for="exampleInputPassword1">V.A.T No</label>
                  <input type="text" class="form-control" name="vat_no" id="" placeholder="Enter V.A.T No">
                </div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
                  <label for="exampleInputPassword1">C.S.T No</label>
                  <input type="text" class="form-control" name="cst_no" id="" placeholder="Enter C.S.T. no">
                </div>
				</div>
				
             
		     
				
				<div class="col-md-6">
				 <div class="form-group ">
                  <label for="exampleInputPassword1">Header Image</label>
                  <input type="file" placeholder="Upload Image Here" name="com_head_image" class="form-control" required>
                </div>
				</div>
				<div class="col-md-6">
				 <div class="form-group ">
                  <label for="exampleInputPassword1">Footer Image</label>
                  <input type="file" placeholder="Upload Image Here" name="com_footer_image" class="form-control" required>
                </div>
				</div>
				<div class="col-md-6">
				 <div class="form-group ">
                  <label for="exampleInputPassword1">Stamp Image</label>
                 <input type="file" placeholder="Upload Image Here" name="com_stamp_image" class="form-control" >
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
		   
			
			
             
		    </form>
		  
		   

         
        
         
      </div>
		
     

    </section>



<script src="admin/plugins/state_select.js"></script>

<?php include_once('footer.php'); ?>
 