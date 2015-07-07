<?php
require_once('../phpInclude/db_connection.php');
//error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$user_id = $_REQUEST['user_id'];
$eth_origin = $_REQUEST['ethnic_origin'];
$sect = $_REQUEST['sect']?$_REQUEST['sect']:1;
$marital_status = $_REQUEST['marital_status']?$_REQUEST['marital_status']:'NA';
$age = $_REQUEST['age'];
$max_age = $_REQUEST['max_age'];
$marriage_plan = date('Y-m-d',strtotime($_REQUEST['marriage_plan'])) ;

$grew_up = $_REQUEST['grew_up']?$_REQUEST['grew_up']:'NA';
$lives_in = $_REQUEST['lives_in']?$_REQUEST['lives_in']:'NA';
$res_status = $_REQUEST['res_status']?$_REQUEST['res_status']:'NA';
$occupation = $_REQUEST['occupation']; 
$education = $_REQUEST['education']; 

$user = new Users;
$partner_pref='';
if(!empty($user_id)){
	$saved=$user->savePartnerPreferences($user_id,$eth_origin,$sect,$marital_status,$age,$max_age,$marriage_plan,$grew_up,$lives_in,$res_status,$occupation,$education);
	if($saved){
		$partner_pref= $user->getPartnerPref($user_id);
		$success='1';$msg='Partner preferences saved';
	}else{
		$success='0';$msg='Error saving partner preferences';
	}
}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg,'partner_pref'=>$partner_pref));
?>
