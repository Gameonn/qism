<?php
require_once('../phpInclude/db_connection.php');
//error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$user_id 		= $_REQUEST['user_id'];
$exercise_habbit = $_REQUEST['exercise_habbit']?$_REQUEST['exercise_habbit']:'NA';
$smoker 		= $_REQUEST['smoker']?$_REQUEST['smoker']:'NA';
$pets = $_REQUEST['pets']?$_REQUEST['pets']:'NA';
$food_choice = $_REQUEST['food_choice']?$_REQUEST['food_choice']:'NA';
$hiv = $_REQUEST['hiv']?$_REQUEST['hiv']:'NA';
$health_problem 	= $_REQUEST['health_problem']?$_REQUEST['health_problem']:'NA';

$user = new Users;
$health_info='';
if(!empty($user_id)){
	global $conn;
	$user->saveUserHealthInfo($user_id,$exercise_habbit,$smoker,$pets,$food_choice,$hiv,$health_problem);
	$health_info = $user->getUserHealthInfo($user_id);
	$success='1';$msg='success';
}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg,'health_info'=>$health_info));
?>
