<?php
include_once('admin/config/config.php');
if(!isset($_SESSION['id']))
{
	$_SESSION['emsg'] = 'Please Login Here';
	header('location:index.php');
	exit;
}
$user = $con->query("select * from user_master where user_master_id = '".$_SESSION['id']."'")->fetch_object();
$comp_auth = explode(",",$user->company_authen);
$co = count($comp_auth); $c = 0;
$year_auth = explode(",",$user->year_authen);
$coy = count($year_auth); $cy = 0;
$yquery = '';
$cquery = '';
foreach($comp_auth as $c_auth)
{
	$c++;
	if( $co == $c )
	{		
		$cquery .= "`company_id` = '".$c_auth ."'";
	}
	else
	{
		$cquery .= "`company_id` = '".$c_auth ."' OR ";
	}
}
foreach($year_auth as $year)
{
	$cy++;
	if( $cy == $coy )
	{
		$yquery .= "`financial_id` = '".$year."'";
	}else
	{
		$yquery .= "`financial_id` = '".$year."' OR ";
	}
}

$sel_company = $con->query('select * from company_mas where '.$cquery );
$sel_date = $con->query('SELECT * FROM `financial_year_master` where '.$yquery.' order by financial_id DESC');
if(isset($_POST['Button2']))
{
	$_SESSION['company_id'] = $_POST['company'];
	$_SESSION['year'] = $_POST['year'];
	header('location:admin/');
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Accounting Adda | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="admin/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="admin/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="admin/plugins/iCheck/square/blue.css">
	<script src="admin/plugins/jQuery/jQuery-2.2.3.min.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  <a href="index.php"><img src="admin/dist/images/logo.png" /></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
	<?php if(isset($_SESSION['msg'])){ ?>
	<div class="alert alert-success" id="fade">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<?php echo $_SESSION['msg']; ?>
	</div>
	<?php } unset($_SESSION['msg']);?>
    <form method="post" action="" id="">
	<div id="Panel2">
        <div class="form-group has-feedback">
			<select name="company" id="" class="form-control" required>
					<?php while($sel_companyr = $sel_company->fetch_object()){ ?>
						<option value="<?php echo $sel_companyr->company_id; ?>"><?php echo $sel_companyr->company_name; ?></option>
					<?php } ?>
			</select>
        </div>
        <div class="form-group has-feedback">
            <select name="year" id="" class="form-control" required>
				<?php while($sel_dater = $sel_date->fetch_object()){ ?>
					<option value="<?php echo $sel_dater->year; ?>"><?php echo $sel_dater->year; ?></option>
				<?php } ?>
			</select>
        </div>
           <div class="row">
            <div class="col-xs-4">
                <input type="submit" name="Button2" value="Continue..." id="" class="btn btn-primary btn-block btn-flat" />
            </div>
          </div>
          <div class="social-auth-links text-center">
            
            <h4><a id="" href="logout.php">Sign Out</a></h4>
          </div>
	</div>
     
    </form>

  
  <!-- /.login-box-body -->
</div>
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.0 -->
<script src="admin/plugins/jQuery/jQuery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="admin/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="admin/plugins/iCheck/icheck.min.js"></script>
</body>
</html>