  <?php $path = basename($_SERVER['SCRIPT_NAME']);  $pageauth = explode(',', $sel_user->page_authen);  ?>
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $sel_user->user_photo; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $sel_user->full_name; ?></p>
          <a href="javascript:;"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header"></li>
		<li <?php echo ($path == 'index.php') ? 'class="active"' : ''; ?>>
          <a href="index.php">
            <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>
		<?php if(data($pageauth) ==  '1' ){ ?>
		<li class="treeview <?php if($path == 'add_exl_product.php' || $path == 'add_exl_cl.php'){ echo "active"; } ?>">
          <a href="#">
            <i class="fa fa-fw fa-file-excel-o"></i>
            <span >Import Data</span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if(chk_auth(43,$_SESSION['id'],$con) == '1'){ ?><li <?php if($path == 'add_exl_product.php'){ echo "class='active'"; } ?>><a href="add_exl_product.php"><i class="fa fa-circle-o"></i>Product</a></li><?php } ?>
            <?php if(chk_auth(44,$_SESSION['id'],$con) == '1'){ ?><li <?php if($path == 'add_exl_cl.php'){ echo "class='active'"; } ?>><a href="add_exl_cl.php"><i class="fa fa-circle-o"></i>Client</a></li><?php } ?>
          </ul>
        </li>
		<?php } ?>
		<?php if(wid($pageauth) ==  '1' ){ ?>	
		<li class="treeview <?php 
		if($path == 'manage_product.php' || $path == 'add_product.php' || $path == 'edit_s.php' || $path == 'edit_user.php' || $path == 'state_code.php' || $path == 'edit_unit.php' || $path == 'add_user.php' || $path == 'edit_product.php' || $path == 'new_company.php' || $path == 'view_company.php' || $path == 'edit_companny.php' || $path == 'edit_tax.php' || $path == 'edit_prefix.php' || $path == 'manage_project.php' || $path == 'edit_project.php'|| $path == 'new_project.php' || $path == 'manage_category.php' || $path == 'edit_catagory.php' || $path == 'manage_prefix.php' || $path == 'manage_tax.php' || $path == 'manage_company.php' || $path == 'add_database.php' || $path == 'manage_user.php' || $path == 'add_unit.php' ){
			echo 'active';
		}else { echo ''; } ?>" >
          <a href="#">
            <i class="fa fa-th"></i> <span>Widget Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if(chk_auth(1,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'manage_product.php' || $path == 'add_product.php' || $path == 'edit_product.php' ) ? 'class="active"' : ''; ?>><a href="manage_product.php"><i class="fa fa-circle-o"></i>Manage Product </a></li><?php } ?>
            <?php if(chk_auth(2,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'manage_project.php' || $path == 'new_project.php' || $path == 'edit_project.php') ? 'class="active"' : ''; ?>><a href="manage_project.php"><i class="fa fa-circle-o"></i>Manage Project</a></li><?php } ?>
            <?php if(chk_auth(3,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'manage_category.php' || $path == 'edit_catagory.php') ? 'class="active"' : ''; ?>><a href="manage_category.php"><i class="fa fa-circle-o"></i>Manage Category</a></li><?php } ?>
            <?php if(chk_auth(4,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'manage_prefix.php' || $path == 'edit_prefix.php') ? 'class="active"' : ''; ?>><a href="manage_prefix.php"><i class="fa fa-circle-o"></i>Manage Prefix</a></li><?php } ?>
            <?php if(chk_auth(5,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'manage_tax.php' || $path == 'edit_tax.php') ? 'class="active"' : ''; ?>><a href="manage_tax.php"><i class="fa fa-circle-o"></i>Manage Tax</a></li><?php } ?>
            <?php if(chk_auth(6,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'manage_company.php' || $path == 'new_company.php' || $path == 'view_company.php' || $path == 'edit_companny.php') ? 'class="active"' : ''; ?>><a href="manage_company.php"><i class="fa fa-circle-o"></i>Manage Company</a></li><?php } ?>
            <?php if(chk_auth(7,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'add_database.php') ? 'class="active"' : ''; ?>><a href="add_database.php"><i class="fa fa-circle-o"></i>Add Financial Year</a></li><?php } ?>
            <?php if(chk_auth(8,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'manage_user.php' || $path == 'edit_user.php' || $path == 'add_user.php' ) ? 'class="active"' : ''; ?>><a href="manage_user.php"><i class="fa fa-circle-o"></i>Manage User</a></li><?php } ?>
            <?php if(chk_auth(9,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'add_unit.php' || $path == 'edit_unit.php') ? 'class="active"' : ''; ?>><a href="add_unit.php"><i class="fa fa-circle-o"></i>Manage Unit</a></li><?php } ?>
            <?php if(chk_auth(42,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'edit_s.php' || $path == 'state_code.php') ? 'class="active"' : ''; ?>><a href="state_code.php"><i class="fa fa-circle-o"></i>State Code</a></li><?php } ?>
          </ul>
        </li><?php } ?>
		<?php if(client($pageauth) ==  '1' ){ ?><li class="treeview <?php echo ($path == 'add_new_client.php' || $path == 'manage_client.php' || $path == 'view_client_data.php' || $path == 'edit_client.php') ? 'active' : ''; ?>">
          <a href="#">
            <i class="fa fa-odnoklassniki"></i>
            <span>Client</span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if(chk_auth(10,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'add_new_client.php') ? 'class="active"' : ''; ?>><a href="add_new_client.php"><i class="fa fa-circle-o"></i>Add New Client</a></li><?php } ?>
            <?php if(chk_auth(11,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'manage_client.php' || $path == 'view_client_data.php' || $path == 'edit_client.php') ? 'class="active"' : ''; ?>><a href="manage_client.php"><i class="fa fa-circle-o"></i>Manage Client</a></li><?php } ?>
          </ul>
        </li><?php } ?>
		<?php if(chalan($pageauth) ==  '1' ){ ?><li class="treeview <?php echo ($path == 'AddNewChallan.php' || $path == 'AddNewQuatation.php' || $path == 'edit_qu.php' || $path == 'qu_invoice.php' || $path == 'edit_chalan.php'  ||  $path == 'ViewQuatation.php' || $path == 'ViewChallan.php' || $path == 'chalan_invoice.php') ? 'active' : ''; ?>">
          <a href="#">
            <i class="fa fa-file-o"></i>
            <span>Quatation/Challan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if(chk_auth(12,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'AddNewChallan.php') ? 'class="active"' : ''; ?>><a href="AddNewChallan.php"><i class="fa fa-circle-o"></i>Add New Challan</a></li><?php } ?>
            <?php if(chk_auth(13,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'ViewChallan.php' || $path == 'chalan_invoice.php' || $path == 'edit_chalan.php') ? 'class="active"' : ''; ?>><a href="ViewChallan.php"><i class="fa fa-circle-o"></i>Manage Challan</a></li><?php } ?>
            <?php if(chk_auth(14,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'AddNewQuatation.php') ? 'class="active"' : ''; ?>><a href="AddNewQuatation.php"><i class="fa fa-circle-o"></i>Add New Quatation</a></li><?php } ?>
            <?php if(chk_auth(15,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ( $path == 'edit_qu.php' || $path == 'qu_invoice.php' || $path == 'ViewQuatation.php') ? 'class="active"' : '';  ?>><a href="ViewQuatation.php"><i class="fa fa-circle-o"></i>Manage Quatation</a></li><?php } ?>
          </ul>
        </li><?php } ?>
		<?php if(Purchase($pageauth) ==  '1' ){ ?><li class="treeview <?php if( $path == 'add_purchase_invoice.php' || $path == 'view_return_invoice.php' || $path == 'vi_pu_re.php' || $path == 'return_pu_sel.php' || $path == 'purchase_return_invoice.php' || $path == 'edit_pu.php' || $path == 'pu_invoice.php'  || $path == 'manage_purchase_invoice.php' ) { echo "active"; } ?>">
          <a href="#">
            <i class="fa  fa-angle-double-down"></i>
            <span>Purchase Invoice</span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if(chk_auth(16,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'add_purchase_invoice.php') ? 'class="active"' : ''; ?>><a href="add_purchase_invoice.php"><i class="fa fa-circle-o"></i>Add Purchase Invoice</a></li><?php } ?>
             <?php if(chk_auth(18,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'manage_purchase_invoice.php' || $path == 'edit_pu.php' ||  $path == 'pu_invoice.php') ? 'class="active"' : ''; ?>><a href="manage_purchase_invoice.php"><i class="fa fa-circle-o"></i>Manage Invoice</a></li><?php } ?>
			<?php if(chk_auth(17,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'return_pu_sel.php' || $path == 'purchase_return_invoice.php') ? 'class="active"' : ''; ?>><a href="return_pu_sel.php"><i class="fa fa-circle-o"></i>Add Return Invoice</a></li><?php } ?>
            <?php if(chk_auth(19,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'view_return_invoice.php' || $path == 'vi_pu_re.php') ? 'class="active"' : ''; ?>><a href="view_return_invoice.php"><i class="fa fa-circle-o"></i>Manage Return Invoice</a></li><?php } ?>
          </ul>
        </li><?php } ?>
        <?php if(salse($pageauth) ==  '1' ){ ?><li class="treeview <?php if($path == 'add_sales_invoice.php' ||  $path == 'view_salesreturn_invoice.php' || $path == 'sal_re_invoice.php' || $path == 'return_sal_sel.php' || $path == 'add_salesreturn.php' || $path == 'sales_invoice.php' || $path == 'manage_sales_invoice.php' || $path == 'add_sales_chalan.php'){ echo 'active'; } ?>">
          <a href="#">
            <i class="fa  fa-angle-double-up"></i>
            <span>Sales Invoice</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"></span>
			  <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if(chk_auth(20,$_SESSION['id'],$con) == '1'){ ?><li <?php if( $path == 'add_sales_chalan.php' || $path == 'add_sales_invoice.php'){ echo 'class="active"'; } ?>><a href="add_sales_invoice.php"><i class="fa fa-circle-o"></i>Add Sales Invoice </a></li><?php } ?>
			<?php if(chk_auth(22,$_SESSION['id'],$con) == '1'){ ?><li <?php if( $path == 'manage_sales_invoice.php' || $path == 'sales_invoice.php'){ echo 'class="active"'; } ?>><a href="manage_sales_invoice.php"><i class="fa fa-circle-o"></i>Manage Invoice</a></li><?php } ?>
		   <?php if(chk_auth(21,$_SESSION['id'],$con) == '1'){ ?><li <?php if( $path == 'return_sal_sel.php' || $path == 'add_salesreturn.php'){ echo 'class="active"'; } ?>><a href="return_sal_sel.php"><i class="fa fa-circle-o"></i>Add Return Invoice  </a></li><?php } ?>
            <?php if(chk_auth(23,$_SESSION['id'],$con) == '1'){ ?><li <?php if( $path == 'view_salesreturn_invoice.php' || $path == 'sal_re_invoice.php'){ echo 'class="active"'; } ?>><a href="view_salesreturn_invoice.php"><i class="fa fa-circle-o"></i>View Return Invoice</a></li><?php } ?>
          </ul>
        </li><?php } ?>
       
        
		
        <?php if(Payment($pageauth) ==  '1' ){ ?><li class="treeview <?php if($path == 'AddNewPayment.php' || $path == 'view_rec_fi.php' || $path == 'ManageReciept.php' || $path == 'AddNewReciept.php' || $path == 'ManagePayment.php' || $path == 'view_pay_fi.php'){ echo "active"; } ?>">
          <a href="#">
            <i class="fa  fa-inr"></i>
            <span>Payment/Reciept</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if(chk_auth(24,$_SESSION['id'],$con) == '1'){ ?><li <?php if($path == 'AddNewPayment.php'){ echo "class='active'"; } ?>><a href="AddNewPayment.php"><i class="fa fa-circle-o"></i>Add New Payment</a></li><?php } ?>
            <?php if(chk_auth(25,$_SESSION['id'],$con) == '1'){ ?><li <?php if($path == 'ManagePayment.php' || $path == 'view_pay_fi.php'){ echo "class='active'"; } ?>><a href="ManagePayment.php"><i class="fa fa-circle-o"></i>Manage Payment</a></li><?php } ?>
            <?php if(chk_auth(26,$_SESSION['id'],$con) == '1'){ ?><li <?php if($path == 'AddNewReciept.php'){ echo "class='active'"; } ?>><a href="AddNewReciept.php"><i class="fa fa-circle-o"></i>Add New Reciept</a></li><?php } ?>
            <?php if(chk_auth(27,$_SESSION['id'],$con) == '1'){ ?><li <?php if($path == 'ManageReciept.php' || $path == 'view_rec_fi.php'){ echo "class='active'"; } ?>><a href="ManageReciept.php"><i class="fa fa-circle-o"></i>Manage Reciept</a></li><?php } ?>
            
          </ul>
        </li><?php } ?>
        <?php if(Expensess($pageauth) ==  '1' ){ ?><li class="treeview <?php if($path == "add_expencess.php" || $path == "edit_expencess.php" || $path == "view_invoice.php"){ echo "active"; } ?>">
          <a href="#">
            <i class="fa fa-sort-numeric-desc"></i>
            <span>Expensess</span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if(chk_auth(28,$_SESSION['id'],$con) == '1'){ ?><li <?php if($path == "add_expencess.php"){ echo "class='active'"; } ?>><a href="add_expencess.php"><i class="fa fa-circle-o"></i>Add New Expensess</a></li><?php } ?>
            <?php if(chk_auth(29,$_SESSION['id'],$con) == '1'){ ?><li <?php if($path == "view_invoice.php" || $path == "edit_expencess.php"){ echo "class='active'"; } ?>><a href="view_invoice.php"><i class="fa fa-circle-o"></i>View Invoice</a></li><?php } ?>
          </ul>
        </li><?php } ?>
		<?php if(Project($pageauth) ==  '1' ){ ?><li class="treeview <?php if($path == 'new_verification.php' || $path == 'view_verification.php'){ echo "active"; } ?>">
          <a href="#">
            <i class="fa fa-exchange"></i>
            <span>Project Verification</span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if(chk_auth(30,$_SESSION['id'],$con) == '1'){ ?><li <?php if($path == 'new_verification.php'){ echo 'class="active"'; } ?>><a href="new_verification.php"><i class="fa fa-circle-o"></i>New Verification</a></li><?php } ?>
            <?php if(chk_auth(31,$_SESSION['id'],$con) == '1'){ ?><li <?php if($path == 'view_verification.php'){ echo 'class="active"'; } ?>><a href="view_verification.php"><i class="fa fa-circle-o"></i>View Verification</a></li><?php } ?>
          </ul>
        </li><?php } ?>
        <?php if(Reports($pageauth) ==  '1' ){ ?><li class="treeview <?php if($path == 'AddJournalEntry.php' || $path == 'PurchaseVatReport.php' || $path == 'SalesVatReports.php' || $path == 'BalanceSheetReports.php' || $path == 'Profit_LossReports.php' || $path == 'ProjectReports.php' || $path == "TradingReports.php" || $path == 'JournalEntries.php' || $path == 'AccountReports.php' || $path == 'LedgerReports.php' ){ echo 'active'; } ?>">
          <a href="#">
            <i class="fa fa-folder-open-o"></i>
            <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if(chk_auth(32,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'AddJournalEntry.php') ? 'class="active"' : ''; ?>><a href="AddJournalEntry.php"><i class="fa fa-file-o"></i>Add Journal Entery</a></li><?php } ?>
            <?php if(chk_auth(33,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'JournalEntries.php') ? 'class="active"' : ''; ?>><a href="JournalEntries.php"><i class="fa fa-files-o"></i>Journal Enteries</a></li><?php } ?>
            <?php if(chk_auth(34,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'LedgerReports.php') ? 'class="active"' : ''; ?>><a href="LedgerReports.php"><i class="fa fa-files-o"></i>Ledger Reports</a></li><?php } ?>
            <?php if(chk_auth(35,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'AccountReports.php') ? 'class="active"' : ''; ?>><a href="AccountReports.php"><i class="fa fa-files-o"></i>Account Reports</a></li><?php } ?>
            <?php if(chk_auth(36,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'ProjectReports.php') ? 'class="active"' : ''; ?>><a href="ProjectReports.php"><i class="fa fa-files-o"></i>Project Reports</a></li><?php } ?>
            <?php if(chk_auth(37,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'TradingReports.php') ? 'class="active"' : ''; ?>><a href="TradingReports.php"><i class="fa fa-files-o"></i>Trading Reports</a></li><?php } ?>
            <?php if(chk_auth(38,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'Profit_LossReports.php') ? 'class="active"' : ''; ?>><a href="Profit_LossReports.php"><i class="fa fa-files-o"></i>Profit & Loss Reports</a></li><?php } ?>
            <?php if(chk_auth(39,$_SESSION['id'],$con) == '1'){ ?><li <?php echo ($path == 'BalanceSheetReports.php') ? 'class="active"' : ''; ?>><a href="BalanceSheetReports.php"><i class="fa fa-files-o"></i>Balance Sheet Reports</a></li><?php } ?>
            
          </ul>
        </li><?php } ?>
       
      
       
       
           
          </ul>
        </li>
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">