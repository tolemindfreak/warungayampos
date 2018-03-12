<?php

/**
 * @author 
 * @copyright 2013
 */
include_once('Module/login.php'); 
$login =  new login(true); 
$action = isset($_REQUEST['action'])?$_REQUEST['action']:0; 

if ($action){

		 switch ($action){
		 	
				case 'getListUser':
		        	$login->getListUser();
		        	break; 
		        case 'login':
		        	$login->login($_POST);
		        	break; 
	        	case 'logout':
		        	$login->logout();
		        	break; 
		 }
}
else
{
	//header('HTTP/1.0 404 Not Found');
	$result = array();
	$result['success'] = false;
    $result['message'] = "Missing parameter Pelayaran";
	
	echo json_encode($result);
}



?>