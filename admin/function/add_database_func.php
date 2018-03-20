<?php 
function create_financial_year($fine_year,$host,$user,$pass){
	$con = new mysqli($host,$user,$pass);
	$db = $con->query("CREATE DATABASE IF NOT EXISTS ".$fine_year."");
	if($db)
	{
		$con->select_db($fine_year);
		$array = array(
				"CREATE TABLE IF NOT EXISTS `1` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `2` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `3` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `4` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `5` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `6` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `7` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `8` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `9` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `10` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `11` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `12` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `13` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `14` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `15` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `16` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `17` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `18` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `19` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `20` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `21` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `22` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `23` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `24` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `25` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `26` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `27` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `28` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `29` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `30` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `31` ( `id` int(11) NOT NULL AUTO_INCREMENT, `gl_code` varchar(100) NOT NULL, `debit_name` varchar(100) NOT NULL, `credit_name` varchar(100) NOT NULL, `debit_amt` decimal(18,2) NOT NULL, `credit_amt` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL, `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL, `l_date` varchar(20) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `expn_mst` ( `id` int(11) NOT NULL AUTO_INCREMENT,   `act_id` int(11) NOT NULL, `a_date` varchar(20) NOT NULL,   `amt` decimal(18,2) NOT NULL,  `payment_mode` varchar(50) NOT NULL,   `bank_name` varchar(100) NOT NULL,   `chk_no` varchar(100) NOT NULL,   `remark` varchar(500) NOT NULL,   `prj_id` int(11) NOT NULL,   `u_id` int(11) NOT NULL,   `c_id` int(11) NOT NULL,  PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `journal_mst` ( `id` int(11) NOT NULL AUTO_INCREMENT,  `j_date` varchar(20) NOT NULL, `d1` varchar(100) NOT NULL,  `d2` varchar(100) NOT NULL, `d3` varchar(100) NOT NULL, `d4` varchar(100) NOT NULL, `d5` varchar(100) NOT NULL,  `d6` varchar(100) NOT NULL, `d7` varchar(100) NOT NULL,  `d8` varchar(100) NOT NULL, `d9` varchar(100) NOT NULL,  `d10` varchar(100) NOT NULL,`db1` decimal(18,2) NOT NULL,  `db2` decimal(18,2) NOT NULL,`db3` decimal(18,2) NOT NULL,   `db4` decimal(18,2) NOT NULL, `db5` decimal(18,2) NOT NULL, `db6` decimal(18,2) NOT NULL, `db7` decimal(18,2) NOT NULL,  `db8` decimal(18,2) NOT NULL, `db9` decimal(18,2) NOT NULL,  `db10` decimal(18,2) NOT NULL,  `c1` varchar(100) NOT NULL,  `c2` varchar(100) NOT NULL, `c3` varchar(100) NOT NULL,  `c4` varchar(100) NOT NULL,  `c5` varchar(100) NOT NULL,  `c6` varchar(100) NOT NULL, `c7` varchar(100) NOT NULL,  `c8` varchar(100) NOT NULL, `c9` varchar(100) NOT NULL,  `c10` varchar(100) NOT NULL, `cr1` decimal(18,2) NOT NULL,  `cr2` decimal(18,2) NOT NULL, `cr3` decimal(18,2) NOT NULL,  `cr4` decimal(18,2) NOT NULL, `cr5` decimal(18,2) NOT NULL,  `cr6` decimal(18,2) NOT NULL, `cr7` decimal(18,2) NOT NULL,  `cr8` decimal(18,2) NOT NULL, `cr9` decimal(18,2) NOT NULL,  `cr10` decimal(18,2) NOT NULL, `inv_id` varchar(50) NOT NULL,  `u_id` int(11) NOT NULL, `c_id` int(11) NOT NULL,  `remark` varchar(500) NOT NULL,  `prj_id` int(11) NOT NULL,  PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `ledger_mst` ( `id` int(11) NOT NULL AUTO_INCREMENT,  `ac_id` varchar(20) NOT NULL,   `inv_id` varchar(20) NOT NULL,  `date` varchar(20) NOT NULL,  `detail` varchar(200) NOT NULL,`debit` decimal(18,2) NOT NULL,  `crdetail` varchar(200) NOT NULL,  `credit` decimal(18,2) NOT NULL,  PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `n_quat_detail_mst` (  `sd_id` int(11) NOT NULL AUTO_INCREMENT,`p_name` varchar(200) NOT NULL,`pr_name` varchar(500) NOT NULL,`HSN` varchar(200) NOT NULL,`grate` int(11) NOT NULL,`p_desc` varchar(500) NOT NULL,`unit` varchar(100) NOT NULL,`qty` int(11) NOT NULL,`rate` decimal(18,2) NOT NULL,`amt` decimal(18,2) NOT NULL,`remark` varchar(500) NOT NULL,`s_id` int(11) NOT NULL,  PRIMARY KEY (`sd_id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `n_quat_mst` (`s_id` int(11) NOT NULL AUTO_INCREMENT, `s_numner` varchar(20) NOT NULL,`act_no` int(11) NOT NULL,`prj_id` int(11) NOT NULL,`s_date` varchar(20) NOT NULL,`po_no` varchar(20) NOT NULL,`po_date` varchar(20) NOT NULL,`transport` varchar(500) NOT NULL,`lr_no` varchar(20) NOT NULL,`lr_date` varchar(20) NOT NULL,`vat_no` varchar(20) NOT NULL,`cst_no` varchar(20) NOT NULL,`due_date` varchar(20) NOT NULL,`from` varchar(50) NOT NULL,`to` varchar(50) NOT NULL,`cgst` decimal(18,2) NOT NULL,`sgst` decimal(18,2) NOT NULL,`igst` decimal(18,2) NOT NULL,`add_tax` decimal(18,2) NOT NULL,`freight` decimal(18,2) NOT NULL,`total_amt` decimal(18,2) NOT NULL,`remark` varchar(500) NOT NULL,`agnst` varchar(500) NOT NULL,`tax_type` varchar(200) NOT NULL,`cut_amt` decimal(18,2) NOT NULL,`billbookno` int(11) NOT NULL,`serial_id` int(11) NOT NULL,`usage_flag` int(11) NOT NULL,`u_id` int(11) NOT NULL,`c_id` int(11) NOT NULL,  PRIMARY KEY (`s_id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `payment_mst` ( `id` int(11) NOT NULL AUTO_INCREMENT,  `p_number` varchar(50) NOT NULL,`p_date` varchar(20) NOT NULL,`act_id` int(11) NOT NULL,`act_name` varchar(100) NOT NULL,`amount` decimal(18,2) NOT NULL,`mode` varchar(50) NOT NULL,`bank_name` varchar(100) NOT NULL,`chk_no` varchar(50) NOT NULL,`prj_id` int(11) NOT NULL,`tds` decimal(18,2) NOT NULL,`rd` decimal(18,2) NOT NULL,`total` decimal(18,2) NOT NULL,`remark` varchar(500) NOT NULL,`left_amt` decimal(18,2) NOT NULL,`u_id` int(11) NOT NULL,`c_id` int(11) NOT NULL,`df` int(11) NOT NULL,  PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `purchase_detail_mst` (`sd_id` int(11) NOT NULL AUTO_INCREMENT,  `p_name` varchar(200) NOT NULL,`pr_name` varchar(500) NOT NULL,`HSN` varchar(200) NOT NULL,`grate` int(11) NOT NULL,`p_desc` varchar(500) NOT NULL,`unit` varchar(100) NOT NULL,`qty` int(11) NOT NULL,`rate` decimal(18,2) NOT NULL,`amt` decimal(18,2) NOT NULL,`remark` varchar(500) NOT NULL,`s_id` int(11) NOT NULL,  PRIMARY KEY (`sd_id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `purchase_mst` (  `s_id` int(11) NOT NULL AUTO_INCREMENT,  `s_numner` varchar(20) NOT NULL,`act_no` int(11) NOT NULL,`prj_id` int(11) NOT NULL,`s_date` varchar(20) NOT NULL,`ch_no` varchar(20) NOT NULL,`ch_date` varchar(20) NOT NULL,`transport` varchar(500) NOT NULL,`lr_no` varchar(20) NOT NULL,`lr_date` varchar(20) NOT NULL,`vat_no` varchar(20) NOT NULL,`cst_no` varchar(20) NOT NULL,`due_date` varchar(20) NOT NULL,`from` varchar(50) NOT NULL,`to` varchar(50) NOT NULL,`cgst` decimal(18,2) NOT NULL,`sgst` decimal(18,2) NOT NULL,`igst` decimal(18,2) NOT NULL,`add_tax` decimal(18,2) NOT NULL,`freight` decimal(18,2) NOT NULL,`total_amt` decimal(18,2) NOT NULL,`remark` varchar(500) NOT NULL,`agnst` varchar(500) NOT NULL,`tax_type` varchar(200) NOT NULL,`cut_amt` decimal(18,2) NOT NULL,`billbookno` int(11) NOT NULL,`serial_id` int(11) NOT NULL,`usage_flag` int(11) NOT NULL,`u_id` int(11) NOT NULL,`c_id` int(11) NOT NULL,  PRIMARY KEY (`s_id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `purchase_return_detail_mst` (  `sd_id` int(11) NOT NULL AUTO_INCREMENT,  `p_name` varchar(200) NOT NULL,`p_desc` varchar(500) NOT NULL,`unit` varchar(100) NOT NULL,`qty` decimal(18,2) NOT NULL,`rate` decimal(18,2) NOT NULL,`amt` decimal(18,2) NOT NULL,`remark` varchar(500) NOT NULL,`s_id` int(11) NOT NULL,  PRIMARY KEY (`sd_id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `purchase_return_mst` (  `id` int(11) NOT NULL AUTO_INCREMENT,  `act_no` int(11) NOT NULL, `pr_no` varchar(50) NOT NULL,`purchase_inv_no` varchar(100) NOT NULL,`pr_date` varchar(20) NOT NULL,`ch_no` varchar(50) NOT NULL,`ch_date` varchar(20) NOT NULL,`transport` varchar(500) NOT NULL,`prj_id` int(11) NOT NULL,`agnst` varchar(200) NOT NULL,`from` varchar(200) NOT NULL,`to` varchar(200) NOT NULL,`remark` varchar(500) NOT NULL,`freight` decimal(18,2) NOT NULL,`total` decimal(18,2) NOT NULL,`vat` varchar(50) NOT NULL,`cst` varchar(50) NOT NULL,`due_date` varchar(20) NOT NULL,`c_id` int(11) NOT NULL,`u_id` int(11) NOT NULL,`flag` int(1) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `quatation_detail_mst` (`sd_id` int(11) NOT NULL AUTO_INCREMENT,`p_name` varchar(200) NOT NULL,`pr_name` varchar(500) NOT NULL,`HSN` varchar(200) NOT NULL,`grate` int(11) NOT NULL,`p_desc` varchar(500) NOT NULL,`unit` varchar(100) NOT NULL,`qty` int(11) NOT NULL,`rate` decimal(18,2) NOT NULL,`amt` decimal(18,2) NOT NULL,`remark` varchar(500) NOT NULL,`s_id` int(11) NOT NULL ,PRIMARY KEY (`sd_id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `quatation_mst` (`s_id` int(11) NOT NULL AUTO_INCREMENT, `s_numner` varchar(20) NOT NULL, `act_no` int(11) NOT NULL,`prj_id` int(11) NOT NULL,`s_date` varchar(20) NOT NULL,`po_no` varchar(20) NOT NULL,`po_date` varchar(20) NOT NULL,`transport` varchar(500) NOT NULL,`lr_no` varchar(20) NOT NULL,`lr_date` varchar(20) NOT NULL,`vat_no` varchar(20) NOT NULL,`cst_no` varchar(20) NOT NULL,`due_date` varchar(20) NOT NULL,`from` varchar(50) NOT NULL,`to` varchar(50) NOT NULL,`cgst` decimal(18,2) NOT NULL,`sgst` decimal(18,2) NOT NULL,`igst` decimal(18,2) NOT NULL,`add_tax` decimal(18,2) NOT NULL,`freight` decimal(18,2) NOT NULL,`total_amt` decimal(18,2) NOT NULL,`remark` varchar(500) NOT NULL,`agnst` varchar(500) NOT NULL,`tax_type` varchar(200) NOT NULL,`cut_amt` decimal(18,2) NOT NULL,`billbookno` int(11) NOT NULL,`serial_id` int(11) NOT NULL,`usage_flag` int(11) NOT NULL,`u_id` int(11) NOT NULL,`c_id` int(11) NOT NULL,   PRIMARY KEY (`s_id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `reciept_mst` (  `id` int(11) NOT NULL AUTO_INCREMENT,  `p_number` varchar(50) NOT NULL,`p_date` varchar(20) NOT NULL,`act_id` int(11) NOT NULL,`act_name` varchar(100) NOT NULL,`amount` decimal(18,2) NOT NULL,`mode` varchar(50) NOT NULL,`bank_name` varchar(100) NOT NULL,`chk_no` varchar(50) NOT NULL,`prj_id` int(11) NOT NULL,`tds` decimal(18,2) NOT NULL,`rd` decimal(18,2) NOT NULL,`total` decimal(18,2) NOT NULL,`remark` varchar(500) NOT NULL,`left_amt` decimal(18,2) NOT NULL,`u_id` int(11) NOT NULL,`c_id` int(11) NOT NULL,`df` int(11) NOT NULL,  PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `sales_detail_mst` ( `sd_id` int(11) NOT NULL AUTO_INCREMENT, `p_name` varchar(200) NOT NULL,`pr_name` varchar(500) NOT NULL,`HSN` varchar(200) NOT NULL,`grate` int(11) NOT NULL,`p_desc` varchar(500) NOT NULL,`unit` varchar(100) NOT NULL,`qty` int(11) NOT NULL,`rate` decimal(18,2) NOT NULL,`amt` decimal(18,2) NOT NULL,`remark` varchar(500) NOT NULL,`s_id` int(11) NOT NULL ,PRIMARY KEY (`sd_id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `sales_mst` (  `s_id` int(11) NOT NULL AUTO_INCREMENT, `s_numner` varchar(20) NOT NULL,`act_no` int(11) NOT NULL,`prj_id` int(11) NOT NULL,`s_date` varchar(20) NOT NULL,`ch_no` varchar(20) NOT NULL,`ch_date` varchar(20) NOT NULL,`po_no` varchar(20) NOT NULL,`po_date` varchar(20) NOT NULL,`transport` varchar(500) NOT NULL,`lr_no` varchar(20) NOT NULL,`lr_date` varchar(20) NOT NULL,`vat_no` varchar(20) NOT NULL,`cst_no` varchar(20) NOT NULL,`due_date` varchar(20) NOT NULL,`from` varchar(50) NOT NULL,`to` varchar(50) NOT NULL,`cgst` decimal(18,2) NOT NULL,`sgst` decimal(18,2) NOT NULL,`igst` decimal(18,2) NOT NULL,`add_tax` decimal(18,2) NOT NULL,`freight` decimal(18,2) NOT NULL,`total_amt` decimal(18,2) NOT NULL,`remark` varchar(500) NOT NULL,`agnst` varchar(500) NOT NULL,`tax_type` varchar(200) NOT NULL,`cut_amt` decimal(18,2) NOT NULL,`billbookno` int(11) NOT NULL,`serial_id` int(11) NOT NULL,`u_id` int(11) NOT NULL,`c_id` int(11) NOT NULL,`df` int(11) NOT NULL,  PRIMARY KEY (`s_id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `sales_return_detail_mst` (  `sd_id` int(11) NOT NULL AUTO_INCREMENT,  `p_name` varchar(200) NOT NULL, `p_desc` varchar(500) NOT NULL,`unit` varchar(100) NOT NULL,`qty` decimal(18,2) NOT NULL,`rate` decimal(18,2) NOT NULL,`amt` decimal(18,2) NOT NULL,`remark` varchar(500) NOT NULL,`s_id` int(11) NOT NULL,  PRIMARY KEY (`sd_id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `sales_return_mst` (  `id` int(11) NOT NULL AUTO_INCREMENT,  `act_no` int(11) NOT NULL,`pr_no` varchar(50) NOT NULL,`purchase_inv_no` varchar(100) NOT NULL,`pr_date` varchar(20) NOT NULL,`ch_no` varchar(50) NOT NULL,`ch_date` varchar(20) NOT NULL,`transport` varchar(500) NOT NULL,`prj_id` int(11) NOT NULL,`agnst` varchar(200) NOT NULL,`from` varchar(200) NOT NULL,`to` varchar(200) NOT NULL,`remark` varchar(500) NOT NULL,`freight` decimal(18,2) NOT NULL,`total` decimal(18,2) NOT NULL,`vat` varchar(50) NOT NULL,`cst` varchar(50) NOT NULL,`due_date` varchar(20) NOT NULL,`c_id` int(11) NOT NULL,`u_id` int(11) NOT NULL,`df` int(11) NOT NULL,  PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1",
				"CREATE TABLE IF NOT EXISTS `ver_detail_mst` (  `id` int(11) NOT NULL AUTO_INCREMENT,  `vdate` varchar(20) NOT NULL,`remark` varchar(500) NOT NULL,`product` varchar(500) NOT NULL,`desc` varchar(500) NOT NULL,`side` varchar(100) NOT NULL,`chanage` varchar(100) NOT NULL,`qty` decimal(18,2) NOT NULL,`ver_id` int(11) NOT NULL,  PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ",
				"CREATE TABLE IF NOT EXISTS `ver_mst` (  `id` int(11) NOT NULL AUTO_INCREMENT,  `email` varchar(10000) NOT NULL,  `project_name` varchar(500) NOT NULL,  `c_date` varchar(20) NOT NULL,  `u_id` int(11) NOT NULL,  `c_id` int(11) NOT NULL,`toa` varchar(500) NOT NULL,  PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1"
		);
		
		foreach($array as $query)
		{
			$ok = $con->query($query);
		}
	}
}
?>