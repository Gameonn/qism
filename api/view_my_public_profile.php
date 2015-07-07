<?php
require_once('../phpInclude/db_connection.php');
error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$user_id = $_REQUEST['user_id'];
$user = new Users;

$basic_info=$partner_pref=$user_appearance=$education=$religion=$family=$health=$location=$hobbies='';
if(!empty($user_id)){
	$profile = $user->getUserProfile($user_id);
	$basic_info = $user->getUserBasicInfo($user_id);
	$partner_pref = $user->getPartnerPref($user_id);
	$user_appearance = $user->getUserAppearance($user_id);
	$education	= $user->getUserEducation($user_id);
	$religion	= $user->getUserReligion($user_id);
	$family		= $user->getUserFamilyInfo($user_id);
	$health		= $user->getUserHealthInfo($user_id);
	$location	= $user->getUserLocationInfo($user_id);
	$hobbies	= $user->getUserHobbyAndInterest($user_id);
	$success='1';$msg='pubic profile';
}else{
	$success='0';$msg='Incomplete Parameters';
}

echo json_encode(array(
	'profile'=>$profile,
	'basic_info'=>$basic_info,
	'partner_pref'=>$partner_pref,
	'user_appearance'=>$user_appearance,
	'education'=>$education,
	'religion'=>$religion,
	'family'=>$family,
	'health'=>$health,
	'location'=>$location,
	'hobbies'=>$hobbies,
	'success'=>$success,
	'msg'=>$msg
	));
?>