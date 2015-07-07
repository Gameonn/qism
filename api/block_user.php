<?php
require_once('../phpInclude/db_connection.php');
error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$user_id1 = $_REQUEST['user_id1'];
$user_id2 = $_REQUEST['user_id2'];

$user = new Users;
$match = new Matches;
$message = new Messages;

if(!empty($user_id1) && !empty($user_id2)){
	$user->blockUser($user_id1,$user_id2);
	$success='0';$msg='report success';
}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg));

?>