<?php
include_once('../config/config2.php');
$query = $con->query("SELECT `username` FROM `user_master` where `username` = '".$_POST['page']."' ");
$row = $query->fetch_object();

if( $row )
{
	if( strtolower($row->username) ==  strtolower($_POST['page']) )
	{
		echo "1";
	}

} else
{
	echo "0";
}

?>