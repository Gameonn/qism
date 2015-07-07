<?php
/*
user profile pic and bio

*/
require_once('../phpInclude/db_connection.php');
//error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$user_id = $_REQUEST['user_id'];
$user_id2 = $_REQUEST['user_id2'];

$user = new Users;
if($user_id){
	$gallery = $user->getUserGallery($user_id,$user_id2);
    $success="1";
    $msg='success';
}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg,'gallery'=>$gallery));

?>
