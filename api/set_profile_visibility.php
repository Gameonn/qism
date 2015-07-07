<?php
require_once('../phpInclude/db_connection.php');
//error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$user_id = $_REQUEST['user_id'];
$hide_profile = $_REQUEST['hide_profile']?$_REQUEST['hide_profile']:0;
$disable_profile = $_REQUEST['disable_profile']?$_REQUEST['disable_profile']:0;

$user = new Users;
$profile_visibility='';
if(!empty($user_id)){
	$user->setProfileVisibility($user_id,$hide_profile,$disable_profile);
	$profile_visibility=$user->getProfileVisibility($user_id);
	$success='1';$msg='success';
}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg,'profile_visibility'=>$profile_visibility));
?>
