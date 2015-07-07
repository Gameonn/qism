<?php
require_once('../phpInclude/db_connection.php');
//error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$user_id = $_REQUEST['user_id'];
$height	 = $_REQUEST['height']?$_REQUEST['height']:'NA';
$weight  = $_REQUEST['weight']?$_REQUEST['weight']:'NA';
$body    = $_REQUEST['body']?$_REQUEST['body']:'NA';
$eyes    = $_REQUEST['eyes']?$_REQUEST['eyes']:'NA';
$hair    = $_REQUEST['hair']?$_REQUEST['hair']:'NA';

$user = new Users;

if(!empty($user_id)){
	$user->saveUserAppearance($user_id,$height,$weight,$body,$eyes,$hair);
	$appearance = $user->getUserAppearance($user_id);
	$success='1';$msg='success';
}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg,'appearance'=>$appearance));

?>
