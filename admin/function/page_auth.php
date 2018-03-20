<?php
function page($id, $con){
	$query = $con->query("select * from user_master where user_master_id = '".$id."'")->fetch_object();
	return explode(',', $query->page_authen);
}


function chk_auth($auth,$id,$con)
{
		include_once('function/page_auth.php');
			foreach( page($id, $con) as $val )
			{
				if($val == $auth)
				{ 
					$val = 1;  
					break;
				}
				else 
				{ 
					$val = 0;
				} 
			}
	return $val;
}


			function wid($pageauth){
				foreach($pageauth as $val)
				{
					if( $val == '1' || $val == '2' || $val == '3'|| $val == '4'|| $val == '5'|| $val == '6'|| $val == '7'|| $val == '8'|| $val == '9' )
					{
						$val = 1;  
						break;
					}
					else
					{
						$val = 0;
					}
				}
				return $val;
			}

			
			function client($pageauth){
				foreach($pageauth as $val)
				{
					if( $val == '10' || $val == '11'  )
					{
						$val = 1;  
						break;
					}
					else
					{
						$val = 0;
					}
				}
				return $val;
			}
			
			function chalan($pageauth){
				foreach($pageauth as $val)
				{
					if( $val == '12' || $val == '13' || $val == '14' || $val == '15' )
					{
						$val = 1;  
						break;
					}
					else
					{
						$val = 0;
					}
				}
				return $val;
			}
			
			function Purchase($pageauth){
				foreach($pageauth as $val)
				{
					if( $val == '16' || $val == '17' || $val == '18' || $val == '19' )
					{
						$val = 1;  
						break;
					}
					else
					{
						$val = 0;
					}
				}
				return $val;
			}
			
			function salse($pageauth){
				foreach($pageauth as $val)
				{
					if( $val == '20' || $val == '21' || $val == '22' || $val == '23' )
					{
						$val = 1;  
						break;
					}
					else
					{
						$val = 0;
					}
				}
				return $val;
			}
			
			
			function Payment($pageauth){
				foreach($pageauth as $val)
				{
					if( $val == '24' || $val == '25' || $val == '26' || $val == '27' )
					{
						$val = 1;  
						break;
					}
					else
					{
						$val = 0;
					}
				}
				return $val;
			}
			
			function Expensess($pageauth){
				foreach($pageauth as $val)
				{
					if( $val == '29' || $val == '28' )
					{
						$val = 1;  
						break;
					}
					else
					{
						$val = 0;
					}
				}
				return $val;
			}
			
			function Project($pageauth){
				foreach($pageauth as $val)
				{
					if( $val == '31' || $val == '30' )
					{
						$val = 1;  
						break;
					}
					else
					{
						$val = 0;
					}
				}
				return $val;
			}
			
			
			function Reports($pageauth){
				foreach($pageauth as $val)
				{
					if( $val == '32' || $val == '33' || $val == '34' || $val == '35' || $val == '36' || $val == '37' || $val == '38' || $val == '39' || $val == '40' || $val == '41')
					{
						$val = 1;  
						break;
					}
					else
					{
						$val = 0;
					}
				}
				return $val;
			}
			
			function data($pageauth){
				foreach($pageauth as $val)
				{
					if( $val == '43' || $val == '44')
					{
						$val = 1;  
						break;
					}
					else
					{
						$val = 0;
					}
				}
				return $val;
			}
			
?>