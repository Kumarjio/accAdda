<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>

<section class="content-header">
      <h1>
        Manage Tax
      </h1>
      
    </section>

    <!-- Main content -->
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
		<div class="col-md-6">
		<div class="box box-primary">
			<form action="Process/add_tax_pro.php" method="post">
				<div class="box-body">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control input-sm" id="" placeholder="Tax_name" name="tax_name" required />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="number" class="form-control input-sm" id="" placeholder="GST rate" name="st_no" required />
						</div>
					</div>
				</div>
				<div class="box-footer">
				<div class="box-body">
							<button type="submit" name="com_button" class="btn btn-primary">Submit</button>
				</div>
				</div>
			</div>
			
		</form>
		</div>
	
        <div class="col-md-6">
          <div class="box">
            <!-- /.box-header -->
			
			
            
              <table id="example2" class="table table-bordered table-hover">
                <thead style="background-color:#3c8dbc;">
						 <tr>
						  <th>Manage</th>
						  <th>Tax Name</th>
						  <th>G.S.T</th>
						 
						</tr>
                </thead>
                <tbody>
				<?php while($sel_taxr = $sel_tax->fetch_object()){ ?>
						<tr>
						<td><a href="edit_tax.php?edit_tax_id=<?php echo $sel_taxr->tax_id; ?>"><button type="button" class="btn btn-info btn-sm">Edit</button></a> &nbsp;<a onclick="return confirm('Are you sure you want to delete this ?');" href="Process/delete.php?del_tax_id=<?php echo $sel_taxr->tax_id; ?>"><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td>
							  <td><?php echo $sel_taxr->tax_name; ?></td>
							  <td><?php echo $sel_taxr->st; ?> %</td>
							  
						</tr>
				
				<?php } ?>
			     </tr>
                </tbody>
                <tfoot>
               
              </table>
			 
          
          </div>
</div>
         
        
         
            
      </div>
    </section>





<?php include_once('footer.php'); ?>