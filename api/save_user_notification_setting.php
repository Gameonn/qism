<?php
require_once('../phpInclude/db_connection.php');
error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$user_id = $_REQUEST['user_id'];
$message	= $_REQUEST['message'];
$matches  = $_REQUEST['matches'];

$user = new Users;

if(!empty($user_id)){
	$user->saveUserNotificationSetting($user_id,$message,$matches);
	$notification_setting = $user->getUserNotificationSetting($user_id);
	$success='1';$msg='success';
}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg,'notification_setting'=>$notification_setting));

?>