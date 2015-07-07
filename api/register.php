<?php
require_once('../phpInclude/db_connection.php');
require_once('../classes/AllClasses.php');

$username = $_REQUEST['username']; //unique user name//
$email = $_REQUEST['email'];
$password	  = $_REQUEST['password'];
$gender		 = $_REQUEST['gender'];
$dob	  = $_REQUEST['dob'];
$location = $_REQUEST['location'];
$lat = $_REQUEST['lat']?$_REQUEST['lat']:'';
$lng = $_REQUEST['lng']?$_REQUEST['lng']:'';

//if empty lat/lng try to fetch from google

$profile = '';
$facebook_id = $_REQUEST['facebook_id'];
$google_id	 = $_REQUEST['google_id'];
$full_name	= $_REQUEST['full_name']?$_REQUEST['full_name']:'full_name';
$level		= $_REQUEST['level']?$_REQUEST['level']:1;
$user = new Users;

if($facebook_id){
	$success='1';
	if(!empty($username)){
		if($user->isUserNameExists($username)){
			$success='0';$msg='Username not available';
		}
	}
	if($success){
		$user_id = $user->createUserByFacebookId($facebook_id,$username,$gender,$dob,$location,$lat,$lng);
		if(!$user_id){
			$success='0';$msg='Error!';
		}else{

			//successfully created user return user data//
				//create default entry for user details
				$user->createDefaultUserDeatailsAndSetting($user_id);
				//create user default setting//
				$user->createDefaultUserSetting($user_id);
				//set default partner pref
				$user->createDefaultPartnerPref($user_id);
				//set default ID verificaiton
				$user->createDefaultIDVerificationSetting($user_id);
				$success='1';$msg='Registration Successfull';
		}
	}
}elseif($google_id){
	$success='1';
	if(!empty($username)){
		if($user->isUserNameExists($username)){
			$success='0';$msg='Username not available';
		}
	}
	if($success){
		$user_id = $user->createUserByGoogleId($google_id,$username,$gender,$dob,$location,$lat,$lng);
		if(!$user_id){
			$success='0';$msg='Error!';
		}else{

			//successfully created user return user data//
				//create default entry for user details
				$user->createDefaultUserDeatailsAndSetting($user_id);
				//create user default setting//
				$user->createDefaultUserSetting($user_id);
				//set default partner pref
				$user->createDefaultPartnerPref($user_id);
				//set default ID verificaiton
				$user->createDefaultIDVerificationSetting($user_id);
				$success='1';$msg='Registration Successfull';
		}
	}
}elseif(!empty($username) && !empty($password) && !empty($email) && !empty($gender) && !empty($dob) && !empty($location)){
	if(!$user->isUserNameExists($username)){
		if(!$user->isUserEmailExists($email)){
			$password = md5($password);
			if($user_id=$user->createUserByEmail($username,$email,$password,$gender,$dob,$location,$lat,$lng)){
				//successfully created user return user data//
				//create default entry for user details
				$user->createDefaultUserDeatailsAndSetting($user_id);
				//create user default setting//
				$user->createDefaultUserSetting($user_id);
				//set default partner pref
				$user->createDefaultPartnerPref($user_id);
				//set default ID verificaiton
				$user->createDefaultIDVerificationSetting($user_id);

				$success='1';$msg='Registration Successfull';
			}else{
				$success='0';$msg='Registration Failed';
			}
		}else{
			$success='0';$msg='Email already registered';
		}
	}else{
		$success='0';$msg='Username not available';
	}
}else{
	$success='0';$msg='Incomplete Parameters';
}

if($user_id){
	echo json_encode(array('success'=>$success,'msg'=>$msg,'user_id'=>$user_id));
}else{
	echo json_encode(array('success'=>$success,'msg'=>$msg));
}
?>