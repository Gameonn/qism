<?php
require_once('../phpInclude/db_connection.php');
//error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$user_id 	= $_REQUEST['user_id'];
$eth_origin = $_REQUEST['eth_origin'];
$sect 		= $_REQUEST['sect'];
$marital_status = $_REQUEST['marital_status']?$_REQUEST['marital_status']:'NA';
$profile_by = $_REQUEST['profile_by']?$_REQUEST['profile_by']:'NA';
$marriage_plan = $_REQUEST['marriage_plan'];
$grew_up 	= $_REQUEST['grew_up']?$_REQUEST['grew_up']:'NA';
$lives_in	= $_REQUEST['lives_in']?$_REQUEST['lives_in']:'NA';
$res_status = $_REQUEST['res_status']?$_REQUEST['res_status']:'NA';
$occupation = $_REQUEST['occupation'];
$education 	= $_REQUEST['education'];
$age = $_REQUEST['age'];
$dob = date('Y-m-d',strtotime(' -'.$age.' year'));
//$dob		= $_REQUEST['dob'];
$compatibility = $_REQUEST['compatibility']?$_REQUEST['compatibility']:'';

$user = new Users;
$basic_info='';
if(!empty($user_id) && !empty($education) && !empty($occupation) && !empty($eth_origin) && !empty($sect)){
	global $conn;
	if(!empty($dob)){
		$user->updateUserDob($user_id,$dob);
	}
	$user->saveUserBasicInfo($user_id,$eth_origin,$sect,$marital_status,$profile_by,$marriage_plan,$grew_up,$lives_in,$res_status,$occupation,$education,$dob,$compatibility);
	$basic_info = $user->getUserBasicInfo($user_id);
	$success='1';$msg='success';
}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg,'basic_info'=>$basic_info));
?>
