<?php
require_once('../phpInclude/db_connection.php');
error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$user_id = $_REQUEST['user_id'];
$password   = $_REQUEST['password'];

$user = new Users;

if(!empty($user_id) && !empty($password)){
	$a=$user->changePassword($user_id,md5($password));
	$success='1';$msg='updated';
}else{
	$success='0';$msg='Incomplete Parameters';
}

echo json_encode(array('success'=>$success,'msg'=>$msg));
