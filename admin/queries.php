<?php



// -- -- select user 
$sel_user = $con->query('select * from user_master where user_master_id = "'.$_SESSION["id"].'"')->fetch_object();
// -- -- select user 

// count user
$sel_all_user = $con->query("select count(*) as no from `user_master`")->fetch_object();
// count user

//  count product
$count_product = $con->query("select count(*) as product_no from product_master")->fetch_object(); 
//  count product 

//  count clients
$count_clients = $con->query("select count(*) as client_no from client_master")->fetch_object();
//  count clients

//  count projects
$count_projects = $con->query("select count(*) as project_no from project_master")->fetch_object();
//  count projects


//   ----  select company name  -------  //
$sel_company = $con->query('select * from company_mas');
//   ----  select company name  -------  //

//   ----  select database  -------  //
$sel_date = $con->query('SELECT * FROM `financial_year_master` order by financial_id DESC');
//   ----  select database  -------  //

// -----   select account type --- //
$sel_account_type = $con->query('select * FROM account_type'); 
// -----   select account type --- // 

//  -------  select prefix  -----  //
$sel_prefix = $con->query('select * from prefix_master');
//  -------  select prefix  -----  //

//  -------  select tax_master  -----  //
$sel_tax = $con->query('select * from tax_master');
//  -------  select tax_master  -----  //

//  -------  select unit_master  -----  //
$sel_unit = $con->query('select * from unit_master');
//  -------  select unit_master  -----  //

//  -------  select catogory  -----  //
$sel_catagory = $con->query('select * from catagory_master');
//  -------  select catogory  -----  //

//  -------  select Projects ------  //
$sel_projects = $con->query('select * from project_master');
//  -------  select Projects ------  //

$se_com_vat = $con->query("select * from company_mas where company_id = '".$_SESSION['company_id']."'")->fetch_object();
// -------  select last id from product invoice -------  //

// -------  select last id from product invoice -------  //
$state = $con->query("select * from state_code");
$sel_type = $con->query("select * from sel_type");
 
?>