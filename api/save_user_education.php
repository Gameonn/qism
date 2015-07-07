<?php
require_once('../phpInclude/db_connection.php');
//error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$user_id = $_REQUEST['user_id'];
$education	 = $_REQUEST['education'];
$job_title  = $_REQUEST['job_title'];
$income    = $_REQUEST['income']?$_REQUEST['income']:'NA';
$industry    = $_REQUEST['industry'];

$user = new Users;
$user_edu_info='';

if(!empty($user_id)){
	$user->saveUserEducation($user_id,$education,$job_title,$income,$industry);
	$user_edu_info = $user->getUserEducation($user_id);
	$success='1';$msg='success';
}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg,'user_edu_info'=>$user_edu_info));

?>
