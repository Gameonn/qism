<?php
require_once('../phpInclude/db_connection.php');
//error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$facebook_id = $_REQUEST['facebook_id'];

$user = new Users;
$match = new Matches;
$message = new Messages;

$facebook_id = $_REQUEST['facebook_id'];
$goolge_id = $_REQUEST['google_id'];

$user_id = 0;

if(!empty($google_id) && $user_id==0){
	$user_id = $user->getUserIdByGoogleId($google_id);
} 

if(!empty($facebook_id) && $user_id==0){
	$user_id = $user->getUserIdByFacebookId($facebook_id);
}

if($user_id){
	$success='1';
}

echo json_encode(array('success'=>$success))
?>
