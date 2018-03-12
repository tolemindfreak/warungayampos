<?php

/**
 * @author 
 * @copyright 2013
 */
include_once('Module/menu.php'); 
$menu =  new menu(true); 
$action = isset($_REQUEST['action'])?$_REQUEST['action']:0; 

if ($action){

		 switch ($action){
		 	
				case 'getKategori':
		        	$menu->getKategori($_REQUEST);
		        	break; 
		        case 'getMenu':
		        	$menu->getMenu($_REQUEST);
		        	break;
		        case 'getNextTransactionID':
		        	$menu->getNextTransactionID();
		        	break;
		        case 'addNewTransaction':
		        	$menu->addNewTransaction($_POST);
		        	break;
		        case 'addNewTransactionDetails':
		        	$menu->addNewTransactionDetails($_POST);
		        	break;
	        	case 'getTransactionList':
		        	$menu->getTransactionList();
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