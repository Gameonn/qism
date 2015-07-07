<?php
require_once('../phpInclude/db_connection.php');
error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$user_id = $_REQUEST['user_id'];
$value	= $_REQUEST['value'];   // 0,1,2 (all,match,none)
$user = new Users;

if(!empty($user_id)){
	$user->saveUserPictureVisibiltySetting($user_id,$value);
	$picture_setting = $user->getUserPictureVisibiltySetting($user_id);
	$success='1';$msg='success';
}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg,'picture_setting'=>$picture_setting));

?>