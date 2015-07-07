<?php
require_once('../phpInclude/db_connection.php');
//error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$user_id = $_REQUEST['user_id'];
$user_id1 = $_REQUEST['user_id2'];
$messages  = $_REQUEST['message'];

$message = new Messages;

if(!empty($user_id) && !empty($user_id1) && !empty($messages)){
	if($message->sendMessage($user_id1,$user_id1,$messages)){
		$success='1';$msg='Sent successfully';
	}else{
		$success='0';$msg='Error!';
	}
}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg));
