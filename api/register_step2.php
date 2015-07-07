<?php
require_once('../phpInclude/db_connection.php');
require_once('../classes/AllClasses.php');
//echo json_encode($_POST);die;                                                                                                                                                                                                                                                   
$user_id = $_REQUEST['user_id']; 
$ethnic_origin = $_REQUEST['ethnic_origin'];
$sect	  = $_REQUEST['sect'];
$marital_status		 = $_REQUEST['marital_status']?$_REQUEST['marital_status']:'';
$marriage_plan	  = $_REQUEST['marriage_plan'].'-01-01';
$grew_up = $_REQUEST['grew_up']?$_REQUEST['grew_up']:'';
$lives_in = $_REQUEST['lives_in']? $_REQUEST['lives_in']:'';
$residency_status = $_REQUEST['residency_status']?$_REQUEST['residency_status']:'';
$occupation = $_REQUEST['occupation'];
$education  = $_REQUEST['education'];
$height = $_REQUEST['height']?$_REQUEST['height']:'';
$emp_status = $_REQUEST['emp_status']?$_REQUEST['emp_status']:'';
$body_type = $_REQUEST['body_type']?$_REQUEST['body_type']:'';
$first_lang = $_REQUEST['first_lang']?$_REQUEST['first_lang']:'';
$spoken_lang = $_REQUEST['spoken_lang']?$_REQUEST['spoken_lang']:'';
$smoker = $_REQUEST['smoker']?$_REQUEST['smoker']:'';


$user = new Users;
$match = new Matches;
$message = new Messages;

if($user_id){
	
	$res = $user->registerStep2($user_id,$ethnic_origin,$sect,$marital_status,$marriage_plan,$grew_up,$lives_in,$residency_status,$occupation,$education,$height,$emp_status,$body_type,$first_lang,$spoken_lang,$smoker);
	if($res){
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

		$success='1';$msg='partner prefrences set';
	}else{
		$success='0';$msg='error setting partner prefrences';
	}
}else{
	$success='0';$msg='error';
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
	
function lookup($string)
	{
    
	    $string      = str_replace(" ", "+", urlencode($string));
	    $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . $string . "&sensor=false";
	    
		//echo $details_url;
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $details_url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    $response = json_decode(curl_exec($ch), true);
	    
		//print_r($response);
	    // If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
	    if ($response['status'] != 'OK') {
	        return null;
	    }
    
	    // print_r($response);
	    $geometry = $response['results'][0]['geometry'];
	    
	    $longitude = $geometry['location']['lat'];
	    $latitude  = $geometry['location']['lng'];
	    
	    $array = array(
	        'latitude' => $geometry['location']['lat'],
	        'longitude' => $geometry['location']['lng']
	    );
	    
	    return $array;
		
	}	
?>
