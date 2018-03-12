<?php

session_start();

include_once("parts/head.php");

//if(empty($_SESSION["UserID"])){
//	include_once("app/login.php");	
//}else{
	include_once("parts/mainmenu.php");
    $app = isset($_REQUEST['app'])?$_REQUEST['app']:0;
    
    if($app){
    	switch ($app) {
    		case 'pos':
    			include_once("app/pos.php");	
    			break;
    		case 'listmenu':
    			include_once("app/listmenu.php");	
    			break;
    		case 'listtransaksi':
    			include_once("app/listtransaksi.php");
    			break;
    		default:
    			include_once("app/pos.php");	
    			break;
    	}
    }else{
    	include_once("app/pos.php");	
    }
	
//}

include_once("parts/foot.php");
?>