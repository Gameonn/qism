<?php
require_once('../phpInclude/db_connection.php');
//error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$user_id 	= $_REQUEST['user_id'];
$ancest_origin = $_REQUEST['ancest_origin'];
$community  = $_REQUEST['community'];
$sub_community = $_REQUEST['sub_community'];
$mother_tounge = $_REQUEST['mother_tounge']?$_REQUEST['mother_tounge']:'NA';
$family_value  = $_REQUEST['family_value']?$_REQUEST['family_value']:'NA';
$sibling 	= $_REQUEST['sibling']?$_REQUEST['sibling']:'NA';
$father_status = $_REQUEST['father_status']?$_REQUEST['father_status']:'NA';
$mother_status = $_REQUEST['mother_status']?$_REQUEST['mother_status']:'NA';

$user = new Users;
$family_info='';
if(!empty($user_id) && !empty($ancest_origin) && !empty($community) && !empty($sub_community)){
	global $conn;
	$user->saveUserFamilyInfo($user_id,$ancest_origin,$community,$sub_community,$mother_tounge,$family_value,$sibling,$father_status,$mother_status);
	$family_info = $user->getUserFamilyInfo($user_id);
	$success='1';$msg='success';
	
}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg,'family_info'=>$family_info));
?>
