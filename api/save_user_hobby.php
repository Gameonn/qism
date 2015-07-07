<?php
require_once('../phpInclude/db_connection.php');
error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$user_id 	= $_REQUEST['user_id'];
$sports = $_REQUEST['sports']?$_REQUEST['sports']:'NA';
$common_int = $_REQUEST['common_int']?$_REQUEST['common_int']:'NA';
$movies = $_REQUEST['movies']?$_REQUEST['movies']:'NA';
$cuisine = $_REQUEST['cuisine']?$_REQUEST['cuisine']:'NA';
$personalities = $_REQUEST['personalities']?$_REQUEST['personalities']:'NA';
$books 	= $_REQUEST['books']?$_REQUEST['books']:'NA';
$music	= $_REQUEST['music']?$_REQUEST['music']:'NA';
$desert = $_REQUEST['desert']?$_REQUEST['desert']:'NA';

$user = new Users;
$hobby='';
if(!empty($user_id)){
	global $conn;
	$user->saveUserHobby($user_id,$sports,$common_int,$movies,$cuisine,$personalities,$books,$music,$desert);
	$hobby = $user->getUserHobby($user_id);
	$success='1';$msg='success';
}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg,'hobby'=>$hobby));
?>