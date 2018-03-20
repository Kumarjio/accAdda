<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>

<section class="content-header">
      <h1>
        Edit Company Details
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
	<?php
	$up_com = $con->query("select * from company_mas where company_id = '".$_GET['edit_com_id']."'")->fetch_object();
	?>
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h4>Fill Information</a></h4>
            </div>
            <form action="Process/edit_com_pro.php" method="post" name="" enctype="multipart/form-data">
			<input type="hidden" value="<?php echo $up_com->company_id; ?>" name="company_id" />
              <div class="box-body">
			   <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1"> Name</label>
                  <input type="text" class="form-control" value="<?php echo $up_com->company_name; ?>" name="company_name" id="" placeholder="Enter Name" required>
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Contact Person's Name</label>
                  <input type="text" class="form-control" value="<?php echo $up_com->contact_person_name; ?>" name="contact_person_name" id="" placeholder="Enter Contact Person Name" required>
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputPassword1">Contact No</label>
                  <input type="text" class="form-control" pattern="[789][0-9]{9}" value="<?php echo $up_com->contact_no; ?>" name="company_contact_no" id="" placeholder="Enter Contact No" required>
                </div>
				</div>
				<div class="col-md-6"> 
				<div class="form-group ">
                  <label for="exampleInputPassword1">Contact Persons's Number</label>
                 <input type="text" class="form-control" pattern="[789][0-9]{9}" value="<?php echo $up_com->contact_person_no; ?>" name="contact_person_number" id="" placeholder="Enter Contact Person Number" required>
                </div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
                  <label for="exampleInputPassword1">Email ID</label>
                  <input type="text" class="form-control" value="<?php echo $up_com->comp_email; ?>" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="company_email" id="" placeholder="Enter Email" required>
                </div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
                  <label for="exampleInputPassword1">Address</label>
                  <textarea class="form-control" value="" name="company_address" id="" placeholder="Enter Address" required><?php echo $up_com->comp_address; ?></textarea>
                </div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
                  <label for="exampleInputPassword1">GSTIN</label>
                  <input type="text" class="form-control" name="gst_no" value="<?php echo $up_com->gst; ?>" id="" placeholder="Enter GSTIN">
                </div>
				</div>
				<div class="col-md-4">
						<div class="form-group">
							<label>State Name</label>
							    <select name="state_code" id="state_up" class="form-control" required>
									<option value="">-- Select State Name --</option>
									<?php while($stater = $state->fetch_object()){ ?>
										<option <?php if($up_com->state ==  $stater->code ){ echo "selected"; } ?> value="<?php echo $stater->code; ?>"><?php echo $stater->name; ?></option>
									<?php } ?>
								</select>
						</div>
				</div>
				<div class="col-md-2">
				<div class="form-group">
                  <label for="exampleInputPassword1">State Code</label>
                  <input type="text" class="form-control" name="" value="<?php echo $up_com->state; ?>" id="code" placeholder="State Code" readonly>
                </div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
                  <label for="exampleInputPassword1">V.A.T No</label>
                  <input type="text" class="form-control" value="<?php echo $up_com->comp_vat_no; ?>" name="vat_no" id="" placeholder="Enter V.A.T No">
                </div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
                  <label for="exampleInputPassword1">C.S.T No</label>
                  <input type="text" class="form-control" value="<?php echo $up_com->comp_cst_no; ?>" name="cst_no" id="" placeholder="Enter C.S.T. no">
                </div>
				</div>
				<div class="col-md-6">
				 <div class="form-group ">
                  <label for="exampleInputPassword1">Header Image</label>
                  <input type="file" placeholder="Upload Image Here" name="com_head_image" class="form-control" >
                </div>
				</div>
				<div class="col-md-6">
				 <div class="form-group ">
                  <label for="exampleInputPassword1">Footer Image</label>
                  <input type="file" placeholder="Upload Image Here" name="com_footer_image" class="form-control" >
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
							<button type="submit" name="submit" class="btn btn-primary">Update Company</button>
							<button type="reset" class="btn btn-primary btn-danger">Reset</button>
						  </div>
					  </div>
		  </div>
            
        
		  </div>
		   
			
			
             
		    </form>
		  
		   

         
        
         
      </div>
		
     
      <!-- /.row -->
    </section> <!-- /.content -->

<script src="plugins/state_select.js"></script>



<?php include_once('footer.php'); ?>
 