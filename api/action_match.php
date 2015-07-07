<?php
require_once('../phpInclude/db_connection.php');
//error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$user_id1 = $_REQUEST['user_id1'];
$user_id2 = $_REQUEST['user_id2'];
$action	  = $_REQUEST['action'];  //possible values (y,n,m)

$match = new Matches;

if(!empty($user_id1) && !empty($user_id2) && !empty($action)){
	switch ($action) {
		case 'y':
			$match->actionYes($user_id1,$user_id2);
			break;
		case 'm':
			$match->actionMatch($user_id1,$user_id2);
			break;
		default:
			# code...
			break;
	}
	$success='1';$msg='action performed';
}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg));
?>
