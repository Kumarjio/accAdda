  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="admin/<?php echo $sel_user->user_photo; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['name']; ?></p>
          <a href="javascript:;"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
    <ul class="sidebar-menu">
        <li class="header"></li>
		<li>
          <a href="com_sel.php">
            <i class="fa fa-home"></i> <span>Select Company</span>
          </a>
        </li>
	</ul>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->

    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">