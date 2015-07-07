<?php
require_once('../phpInclude/db_connection.php');
//error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$my_id   = $_REQUEST['my_id'];
$user_id = $_REQUEST['user_id'];
$user = new Users;
$match = new Matches;

$profile=$basic_info=$partner_pref=$user_appearance=$education=$religion=$family=$health=$location=$hobbies='';
if(!empty($user_id)){
	$profile = $user->getUserProfile($user_id);
	$basic_info = $user->getUserBasicInfo($user_id);
	$partner_pref = $user->getPartnerPref($my_id);
	$partner_pref_1 = $user->getPartnerPref($user_id);
	$profile_2 = $user->getStep2RegisterData($user_id);
	$user_appearance = $user->getUserAppearance($user_id);
	$education	= $user->getUserEducation($user_id);
	$religion	= $user->getUserReligion($user_id);
	$family		= $user->getUserFamilyInfo($user_id);
	$health		= $user->getUserHealthInfo($user_id);
	$location	= $user->getUserLocationInfo($user_id);
	$hobbies	= $user->getUserHobbyAndInterest($user_id);
	$status 	= $match->getMatchStatus($my_id,$user_id);

	//calculate match criteria//
	$match_criteria=array();

	strpos($partner_pref['ancestral_origin'],$family['fam_anct_origin']) ? $match_criteria[]='y' : $match_criteria[]='n';
	strpos($partner_pref['rel_sect'],$religion['rel_sect']) ? $match_criteria[]='y' : $match_criteria[]='n';
	strpos($partner_pref['marital_status'],$basic_info['marital_status']) ? $match_criteria[]='y' : $match_criteria[]='n';
	($partner_pref['age'] <= $profile['age'] && $partner_pref['max_age'] >= $profile['age']) ? $match_criteria[]='y' : $match_criteria[]='n';
	strpos($partner_pref['marriage_plan'],$basic_info['marriage_plan']) ? $match_criteria[]='y' : $match_criteria[]='n';
	strpos($partner_pref['grew_up'],$basic_info['grew_up']) ? $match_criteria[]='y' : $match_criteria[]='n';
	strpos($partner_pref['lives_in'], $basic_info['lives_in']) ? $match_criteria[]='y' : $match_criteria[]='n';
	strpos($partner_pref['local_res_status'], $location['local_res_status']) ? $match_criteria[]='y' : $match_criteria[]='n';
	strpos($partner_pref['occupation'], $basic_info['occupation']) ? $match_criteria[]='y' : $match_criteria[]='n';
	strpos($partner_pref['education'], $basic_info['edu_education']) ? $match_criteria[]='y' : $match_criteria[]='n';

	$count=0;
	foreach($match_criteria as $key=>$value){
		if($value=='y'){
			$count++;	
		}		
	}
	
	$comp = $count.'/10';
	
	$success='1';$msg='pubic profile';
}else{
	$success='0';$msg='Incomplete Parameters';
}

echo json_encode(array(
	'user_id'=>$user_id,
	'profile'=>$profile,
	'register2'=>$profile_2,
	'basic_info'=>$basic_info,
	'partner_pref'=>$partner_pref,
	'user_appearance'=>$user_appearance,
	'education'=>$education,
	'religion'=>$religion,
	'family'=>$family,
	'health'=>$health,
	'location'=>$location,
	'hobbies'=>$hobbies,
	'match_criteria'=>$match_criteria,
	'comp'=>$comp,
	'status'=>$status,
	'success'=>$success,
	'msg'=>$msg
	));
?>
