<?php
require_once('../phpInclude/db_connection.php');
//error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$user_id = $_REQUEST['user_id'];
$sect	 = $_REQUEST['sect'];
$halal  = $_REQUEST['halal']?$_REQUEST['halal']:'NA';
$fasting    = $_REQUEST['fasting']?$_REQUEST['fasting']:'NA';
$zakat    = $_REQUEST['zakat']?$_REQUEST['zakat']:'NA';
$salah    = $_REQUEST['salah']?$_REQUEST['salah']:'NA';
$religiousness = $_REQUEST['religiousness']?$_REQUEST['religiousness']:'NA';

$user = new Users;
$user_religion_info='';

if(!empty($user_id)){
	$user->saveUserReligion($user_id,$sect,$halal,$fasting,$zakat,$salah,$religiousness);
	$user_religion_info = $user->getUserReligion($user_id);
	$success='1';$msg='success';
}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg,'user_religion_info'=>$user_religion_info));

?>
