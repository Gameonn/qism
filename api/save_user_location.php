<?php
require_once('../phpInclude/db_connection.php');
//error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$user_id 	= $_REQUEST['user_id'];
$current_location = $_REQUEST['current_location']?$_REQUEST['current_location']:'NA';
$res_status 	  = $_REQUEST['res_status']?$_REQUEST['res_status']:'NA';
$citizenship = $_REQUEST['citizenship']?$_REQUEST['citizenship']:'NA';
$relocation_intention = $_REQUEST['relocation_intention']?$_REQUEST['relocation_intention']:'NA';
$living_arrangement = $_REQUEST['living_arrangement']?$_REQUEST['living_arrangement']:'NA';

$user = new Users;
$location_info='';
if(!empty($user_id)){
	global $conn;
	$success='1';$msg='success';
	$user->saveUserLocationInfo($user_id,$current_location,$res_status,$citizenship,$relocation_intention,$living_arrangement);
	$location_info = $user->getUserLocationInfo($user_id);
}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg,'location_info'=>$location_info));
?>
