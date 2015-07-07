<?php
require_once('../phpInclude/db_connection.php');
error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$user_id = $_REQUEST['user_id'];
$user_id2 = $_REQUEST['user_id2'];
$id = $_REQUEST['id'] ? $_REQUEST['id'] : 0;

$user = new Users;
$message = new Messages;

if(!empty($user_id) && !empty($user_id2)){
	$messages = $message->getUserMessagesAfter($user_id,$user_id2,$id);
	$success='1';$msg='success';
}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg,'messages'=>$messages));

?>