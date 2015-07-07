<?php
require_once('../phpInclude/db_connection.php');
require_once('../classes/AllClasses.php');

/*
store to reports table
sending mail ??
*/

$user_id = $_REQUEST['user_id'];
$title	 = $_REQUEST['title'];
$description = $_REQUEST['description'];

$user = new Users;

if(!empty($user_id) && !empty($title) && !empty($description)){
	$user->reportIssue($user_id,$title,$description);
	$success='1';$msg='success';
}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg));
?>