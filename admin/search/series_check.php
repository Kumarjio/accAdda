<?php
include_once('../config/config2.php');
$ch = str_split($_SESSION['year']);foreach($ch as $chr){	if( preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $chr) )	{		$cut = array_search($chr,$ch);	}}$f = substr($_SESSION['year'],0,$cut);$l = substr($_SESSION['year'],$cut + 1 );if( strlen($f) == 4 ){	$f = ltrim($f,'20');}else{	$f = $f;}if( strlen($l) == 4 ){	$l = ltrim($l,'20');}else{	$l = $l;}$prefix = $f."-".$l;
		$prefix_det = $con->query("select * from prefix_master where prefix_id = '".$_POST['id']."' ")->fetch_object();
		$s_de = $conn->query("select * from sales_mst where s_numner LIKE '".$prefix_det->prefix_code."%' ORDER BY s_id DESC LIMIT 1")->fetch_object();
		if(empty($s_de->s_id)){
			$code = 1;
			$billbookno = 1;
		}
		else 
		{
			$lcode = ltrim($s_de->s_numner,$prefix_det->prefix_code."_"); $code = rtrim($lcode,"_".$prefix);
			if(empty($code))
			{
				$_s = substr($lcode, strpos($lcode, "_") - 1); 
				$code = substr($_s , 0 ,1);
			}
			$code = intval($code) + 1;
			if($s_de->billbookno == '0')
			{
				$s_de->billbookno = 1;
			}
			if( $code - 1  == intval($prefix_det->total_page) * intval($s_de->billbookno))
			{
				$billbookno = intval($s_de->billbookno) + 1;
			}else
			{
				$billbookno = $s_de->billbookno;
			}
		}
		echo json_encode(array('invoice' => $invoice_no = $prefix_det->prefix_code."_".$code."_".$prefix, 'bill' => $billbookno));
		exit;

?>