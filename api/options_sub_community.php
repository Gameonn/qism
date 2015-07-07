<?php
require_once('../phpInclude/db_connection.php');
require_once('../classes/AllClasses.php');

/*
store to suggestions table
sending mail ??
*/



$option = new Options;
$community_id = $_REQUEST['community_id'];
$sub_community=array();

if($community_id){
	$sub_community=$option->getSubCommunity($community_id);
	$success='1';$msg='success';
}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg,'options'=>$sub_community));
?>