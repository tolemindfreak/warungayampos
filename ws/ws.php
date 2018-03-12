<?php
include_once("config.php");
include_once(ABSPATH ."Cores/msDB.php");
$app = isset($_REQUEST['app'])?$_REQUEST['app']:0;
if ($app){
		
	$ajax =""; 
	switch ($app) {
			case 'warungnasi': 
			$ajax ='ajax.master.php'; 
		break;		
	}
	if ($ajax){
		if (file_exists("ajax/$ajax")){
			include_once("ajax/$ajax");
		}
	}
}
else
{
	//header('HTTP/1.0 404 Not Found');
	$result = array();
	$result['success']  = false;
    $result['message']  = "Missing parameter Application";
    $result['result'] 	= true;
	
	echo json_encode($result);

}

?>