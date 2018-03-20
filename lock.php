<?php
include_once('admin/config/config.php'); 
if(!isset($_SESSION['user']))
{
	$_SESSION['emsg'] = "Please Login First";
	header('location:index.php');
	exit;
}
$sel_user = $con->query('select * from user_master where user_master_id = "'.$_SESSION["id"].'"')->fetch_object();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Accounting Adda| Lockscreen</title>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="javascript:;"><img src="admin/dist/images/logo.png" /></a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name"><?php echo $_SESSION['name']; ?></div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="admin/<?php echo $sel_user->user_photo; ?>" alt="User Image">
    </div>
	
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials" method="post" action="" id="butn">
      <div class="input-group">
        <input type="password" id="Lpass" class="form-control" placeholder="password">

        <div class="input-group-btn">
          <button type="button" id="but" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    <span id="hide">Enter your password to retrieve your session</span><span style="color:red;" id="err"></span>
  </div>
  <div class="text-center">
    <a href="logout.php">Or sign in as a different user</a>
  </div>
  <div class="lockscreen-footer text-center">
    
  </div>
</div>
<!-- /.center -->

<!-- jQuery 2.2.3 -->
<script src="admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="admin/plugins/lock.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="admin/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
