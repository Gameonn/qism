<?php
require_once('../phpInclude/db_connection.php');
error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$user_id = $_REQUEST['user_id'];
$code	 = $_REQUEST['code'];

$user = new Users;

if(!empty($user_id) && !empty($code)){
	global $conn;
	
	if($user->verifyPhone($user_id,$code)){
		$success='1';$msg='phone verified';
	}else{
		$success='0';$msg='verification fails';
	}
	
}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg));
?>