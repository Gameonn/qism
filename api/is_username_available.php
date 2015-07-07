<?php
require_once('../phpInclude/db_connection.php');
error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$username = $_REQUEST['username'];

$user = new Users;
if(!empty($username)){
	global $conn;
	if($user->isUserNameExists($username)){
		$success='0';$msg='username not available';
	}else{
		$success='1';$msg='username available';
	}
}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg));
?>