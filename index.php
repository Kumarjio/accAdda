<?php
include_once('admin/config/config.php');
if(isset($_SESSION['id']))
{
	header('location:com_sel.php');
	exit;
}
if(isset($_POST['username']) && isset($_POST['password']))
{
	$user = trim($_POST['username']);
	$pass = trim($_POST['password']);
	$md5 = md5($pass);
	$query = $con->query("select * from user_master where username = '$user'");
	if($query)
	{
		$row = $query->num_rows;
		if($row == 1)
		{
			$res = $query->fetch_object();
			if($md5 === $res->user_pass)
			{
					$_SESSION['user'] = $res->username;
					$_SESSION['name'] = $res->full_name;
					$_SESSION['id'] = $res->user_master_id;
					$_SESSION['pass'] = $res->user_pass;
					header('location:com_sel.php');
					exit;
			}
			else
			{
				$_SESSION['emsg'] = "Username And Password Not Match.";
				header('location:index.php');
				//echo "<script>window.location='index.php';</script>";
				exit();
			}
		}
		else
		{
			$_SESSION['emsg'] = "Username Not Exists... Try With Different";
			header('location:index.php');
			//echo "<script>window.location='index.php';</script>";
			exit();
		}
	}
	else
	{
		$_SESSION['emsg'] = "Somthing Went Wrong Please Try Again";
		header('location:index.php');
		//echo "<script>window.location='index.php';</script>";
		exit();
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Accounting Adda | Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="admin/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="admin/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="admin/plugins/iCheck/square/blue.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  <a href="index.php"><img src="admin/dist/images/logo.png" /></a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
	<div class="alert alert-danger" style="display:none;" id="fade">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
	</div>
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
    <form method="post" action="" id="form">
		<div id="Panel1" style="">
			  <div class="form-group has-feedback">
				  <input type="text" class="form-control" name="username" autocomplete="off" spellcheck="false" id="user" placeholder="Username"  required/>
				 <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			  </div>
			  <div class="form-group has-feedback">
				  <input type="password" id="pass" name="password" autocomplete="off" spellcheck="false" class="form-control" placeholder="Password" required/>
				 <span class="glyphicon glyphicon-lock form-control-feedback"></span>
			  </div>
			   <div class="row">
					<div class="col-xs-4">
						<input type="submit" name="login" value="Sign In" id="but" class="btn btn-primary btn-block btn-flat" />
					</div>
			  </div>
		</div>
	</form>
</div>
</div>
<script src="admin/plugins/jQuery/jquery-2.2.3.min.js"></script>

<!-- Bootstrap 3.3.6 -->
<script src="admin/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="admin/plugins/iCheck/icheck.min.js"></script>
</body>
</html>

