<?php include_once('../config/config.php'); ?>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	<?php if(isset($_SESSION['emsg'])){ ?>
		<div class="alert alert-danger" id="fade">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<?php echo $_SESSION['emsg']; ?>
		</div>
	<?php } unset($_SESSION['emsg']); ?>
	<?php if(isset($_SESSION['msg'])){ ?>
	<div class="alert alert-success" id="fade">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<?php echo $_SESSION['msg']; ?>
	</div>
	<?php } unset($_SESSION['msg']);?>
<form action="pro.php" method="post">
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
			<div class="box-header with-border">
				  <h3 class="box-title">New page</a></h3>
			</div>
				<div class="box-body">
					<div class="col-md-12">
						<div class="col-md-5">
							<div class="form-group">
								<input type="text" class="form-control" autocomplete="off" spellcheck="false" placeholder="Page Name" name="page" required />
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-5">
							<div class="form-group">
								<input type="number" class="form-control" min="0" name="no" autocomplete="off" spellcheck="false" placeholder="Page Number" required />
							</div>
						</div>
					</div>
				</div>
				<div class="box-body">
					<div class="col-md-12">
						<div class="col-md-5">
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box">
					<table id="" class="table table-bordered table-hover" style="margin-bottom:0px;">
						<thead style="background-color:#3c8dbc;">
							<tr>
								<th colspan="">Manage</th>
								<th>Sr_No.</th>
								<th>Page Name</th>
								<th>Page No</th>
							</tr>
						</thead>
						<tbody>
						<?php $da = $con->query("select * from page"); ?>
						<?php while($data = $da->fetch_object()){ ?>
							<tr>
								<td><a href="edit.php?id=<?php echo $data->id; ?>"><button type="button" class="btn btn-info btn-sm">Edit</button></a> &nbsp;<a href="?id=<?php echo $data->id; ?>" onclick="return confirm('Are you sure you want to delete this Page ?');"><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td>
								<td><?php echo $data->id; ?></td>
								<td><?php echo $data->name; ?></td>
								<td><?php echo $data->val; ?></td>
							</tr>
						<?php } ?>
						</tbody>
				</div>
			</div>
		</div>
	</div>
</section>
</form>
</div>
</body>



<?php 
if(isset($_GET['id']))
{
	$qu = $con->query("DELETE FROM `page` WHERE id = '".$_GET['id']."'");
	if($qu)
	{
		$_SESSION['msg'] = 'Successfully Deleted';
		header('location:index.php');
		exit;
	}
}
?>