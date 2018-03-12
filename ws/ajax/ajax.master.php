<?php

/**
 * @author 
 * @copyright 2013
 */
include_once("config.php");
include_once(ABSPATH ."Cores/msDB.php"); 

$module = isset($_REQUEST['module'])?$_REQUEST['module']:0; 

if ($module){
		
	$controller =""; 
	switch ($module) {
		case 'menu': 
			$controller ='menu_c.php'; 
		break;
		case 'login': 
			$controller ='login_c.php'; 
		break;
	}
	if ($controller){
		if (file_exists("Controller/$controller")){
			include_once("Controller/$controller");
		}
	}
	else
	{
		$result = array();
		$result['success'] = false;
	    $result['message'] = "Missing parameter Module";
		
		echo json_encode($result);
	}
}
else
{
	
	$result = array();
	$result['success']  = false;
    $result['message']  = "Missing parameter Applicationp";
    $result['result'] 	= true;
	
	echo json_encode($result);
}


?>