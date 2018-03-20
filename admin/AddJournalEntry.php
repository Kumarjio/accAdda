<?php include_once('header.php'); ?>
<?php include_once('sidebar.php');
?>


   <section class="content-header">
      <h1>
        Custom Journal Entry
      </h1>
    </section>
<form action="Process/add_custom_jurnal.php" method="post">
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
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Fillup Information</h3>
					</div>
					
						<div class="box-body">
							<div class="col-md-6">
							<div class="form-group">
							<label>Date :</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" id="today" name="today_date" name="today_date" class="form-control" autocomplete="off" spellcheck="false" required>	
								</div>
						        </div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
								  <label for="">Remarks</label>
								  <textarea type="text" name="remark" class="form-control" id="" placeholder="" ></textarea>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
								<label>Project Name</label>
							    <select name="client_ac_type" id="project" onchange="return auth()" class="form-control" required>
									<option value="">-- Select Project Name --</option>
									<?php while($sel_projectsr = $sel_projects->fetch_object()){ ?>
										<option value="<?php echo $sel_projectsr->project_id; ?>"><?php echo $sel_projectsr->project_name; ?></option>
									<?php } ?>
								</select>
								<p id="per" style="display:none; color:red;" ></p>
						
					</div>
					</div>
						</div>
						
				
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box">
				
					<table id="table" class="table table-bordered table-hover">
						<thead style="background-color:#3c8dbc;">
							<tr>
							  <th>SR. No</th>
							  <th>Type</th>
							  <th>Particulars</th>
							  <th>Debit</th>
							  <th>Credit</th>
							  <th>Manage</th>
							</tr>
						</thead>
						
						<tbody class="input_fields_wrap">
							<tr id="1">
								<td>1</td>
								<td><select id="type1" name='type[]' style="width:50px;">
										<option value="By">By</option>
										<option value="Cr">Cr</option>
									</select></td>
								<td><input type="text" id="particular1" name="particular[]" style="width:200px;"/><input type="hidden" id="particular1h" name="hiddenId[]" /></td>
								<td><input type="text" id="type1debit" name="debit[]" style="width:120px;"/></td>
								<td><input type="text" id="type1credit" name="credit[]" style="width:120px; display:none;"/></td>
								
								<td></td>
							</tr>
							
							
						</tbody>
						
						<tfoot>
						<tr>
							<td id=""></td>
							<td id="pr_name" style="color:red;" colspan="5"></td>
						</tr>
						<tr>
							<th colspan="5"></th>
							<th><button type="button" class="btn btn-primary" id="add_field_button">Add New Row</button></th>
						</tr>
						</tfoot>
						
					</table>
					
				</div>
			</div>
		</div>
			<div class="row">
			<div class="col-md-12">
				<div class="box">
						  <div class="box-footer">
							<button type="submit" onclick="return auth()" name="submit" class="btn btn-primary">Submit</button>
							<button type="reset" class="btn btn-primary btn-danger">Reset</button>
						  </div>
					 	 <p id="errall" style="display:none; color: red; font-weight: 900; padding: 0 0 8px 12px;"></p>
				</div>
				</div>
				</div>
    </section>
    <!-- /.content -->	</form>

<script>
								$(document).ready(function(){
									$('#particular1').autocomplete({
										source: 'search/auto_jurnal_custom.php',
											select:function(e, ui){
												e.preventDefault();
												$(this).val(ui.item.label);
												$('#'+this.id+'h').val(ui.item.client_id);
											},
				change: function( event, ui ) {
					if(ui.item==null)
					{
						this.value='';
					}
				}
									});
									$('#type1').change(function(){
									if($(this).val() == 'By')
									{
										$('#type1credit').fadeOut();
										$('#type1credit').val('');
										$('#type1debit').show();
									}
									else
									{
										$('#type1debit').val('');
										$('#type1debit').fadeOut();
										$('#type1credit').show();
									}
								});
								});
							</script>
<script>
function auth()
{	
	if( $('#project').val() != '' )
	{
		$('#per').fadeOut("slow");
		$('#errall').fadeOut("slow");
		tab = $('#table tbody>tr:last').attr('id');
		debit = 0; credit = 0;
		for( i = 1; i <= tab; i++ )
		{
			a = $('#particular'+i).val();
			if(a == '')
			{
				$('#errall').fadeIn("slow");
				$('#errall').html("Please Fill Particular Fields");
				$('#pr_name').html("Please Fill Particular Fields");
				return false;
			}
			else
			{
				if( $('#type'+i).val() == 'By' )
				{
					as = $('#type'+i+'debit').val();
					if(as == '')
					{
						$('#errall').fadeIn("slow");
						$('#errall').html("Please Fill Debit Or Credit Amount");
						$('#pr_name').html("Please Fill Debit Or Credit Amount");
						return false;
					}else
					{
						debit += parseFloat(as);
						$('#errall').fadeOut("slow");
						$('#errall').html("");
						$('#pr_name').html("");
					}
				}
				else if( $('#type'+i).val() == 'Cr' )
				{
					cr = $('#type'+i+'credit').val();
					if(cr == '')
					{
						$('#errall').fadeIn("slow");
						$('#errall').html("Please Fill Debit Or Credit Amount");
						$('#pr_name').html("Please Fill Debit Or Credit Amount");
						return false;
					}else
					{
						credit += parseFloat(cr);
						$('#errall').fadeOut("slow");
						$('#errall').html("");
						$('#pr_name').html("");
					}
				}
			}
		}
		if( debit === credit )
		{
						$('#errall').fadeOut("slow");
						$('#errall').html("");
						$('#pr_name').html("");
			return true;
		}
		else
		{
						$('#errall').fadeIn("slow");
						$('#errall').html("Debit And Credit Amount Must Be Same");
						$('#pr_name').html("Debit And Credit Amount Must Be Same");
			return false;
		}
	}
	else
	{
		$('#errall').fadeIn("slow");
		$('#per').fadeIn("slow");
		$('#per').html("Project Name Is Required");
		$('#errall').html("Project Name Is Required");
		return false;
	}
}
</script>

<script src="plugins/dynamicadd/dynamic_jurnal.js"></script>
<?php include_once('footer.php'); ?>