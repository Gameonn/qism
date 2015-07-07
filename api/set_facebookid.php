<?php
require_once('../phpInclude/db_connection.php');
require_once('../classes/AllClasses.php');

$user_id = $_REQUEST['user_id'];
$fb_id   = $_REQUEST['fb_id'];

$user = new Users;

if(!empty($user_id) && !empty($fb_id)){
	$user->setFacebookId($user_id,$fb_id);
	$profile = $user->getUserProfile($user_id);
	$success='1';$msg='Saved';
}else{
	$success='0';$msg='Incomplete Parameters';
}

echo json_encode(array('success'=>$success,'msg'=>$msg,'profile'=>$profile));
