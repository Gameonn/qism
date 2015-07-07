<?php
require_once('../phpInclude/db_connection.php');
error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$user_id = $_REQUEST['user_id'];
$user_matches =array();
$user = new Users;
$matches = new Matches;

if(!empty($user_id)){
	$user_matches = $matches->getUserMatches($user_id);
	$success='1';$msg='success';
}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg,'matches'=>$user_matches));

?>