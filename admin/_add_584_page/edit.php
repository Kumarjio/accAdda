<?php include_once('../config/config.php'); $query = $con->query("select * from page where id = '".$_GET['id']."' ")->fetch_object();?>
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
<form action="epro.php" method="post">
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
								<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
								<input type="text" class="form-control" autocomplete="off" spellcheck="false" value="<?php echo $query->name; ?>" placeholder="Page Name" name="page" required />
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-5">
							<div class="form-group">
								<input type="number" class="form-control" min="0" name="no" autocomplete="off" value="<?php echo $query->val; ?>" spellcheck="false" placeholder="Page Number" required />
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
	
	</div>
</section>
</form>
</div>
</body>