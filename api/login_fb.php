<?php
require_once('../phpInclude/db_connection.php');
//error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$facebook_id = $_REQUEST['facebook_id'];

$user = new Users;
$match = new Matches;
$message = new Messages;

$messages = array();
$matches  = array();

$profile=$profile_2=$basic_info=$partner_pref=$user_appearance=$education=$religion=$family=$health=$location=$hobbies=$verification_status='';

if(!empty($facebook_id)){

	$user_id = $user->getUserIdByFacebookId($facebook_id);

	if($user_id){
		$profile = $user->getUserProfile($user_id);
		$messages = $message->getUserMessages($user_id);
		$matches   = $match->getUserMatches($user_id);
		$profile_2 = $user->getStep2RegisterData($user_id);

		$basic_info = $user->getUserBasicInfo($user_id);
		$partner_pref = $user->getPartnerPref($user_id);
		$user_appearance = $user->getUserAppearance($user_id);
		$education	= $user->getUserEducation($user_id);
		$religion	= $user->getUserReligion($user_id);
		$family		= $user->getUserFamilyInfo($user_id);
		$health		= $user->getUserHealthInfo($user_id);
		$location	= $user->getUserLocationInfo($user_id);
		$hobbies	= $user->getUserHobbyAndInterest($user_id);
		$verification_status = $user->getUserIdVerificationStatus($user_id);

		$success='1';$msg='Login success';
	}else{
		$success='2';$msg='Register';
	}

}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg,
	'profile'=>$profile,
	'user_id'=>$user_id,
	'basic_info'=>$basic_info,
	'partner_pref'=>$partner_pref,
	'messages'=>$messages,
	'matches'=>$matches,
	'register2'=>$profile_2,
	'user_appearance'=>$user_appearance,
	'education'=>$education,
	'religion'=>$religion,
	'family'=>$family,
	'health'=>$health,
	'location'=>$location,
	'hobbies'=>$hobbies,
	'verification_status'=>$verification_status));

?>
