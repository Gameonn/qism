<?php
require_once('../phpInclude/db_connection.php');
require_once('../classes/AllClasses.php');
/*
	IN : user_id
		age range
		city
		exclude matches
	OUT
		:profile_pic
		:username
		:location
		:compatibility %
		:staus if y from other side
		fb,phone,email satus
*/
/*
multiple select for
	sect :
	age  : min,max
	grew_up :
	residency_Status :
	education :
Array
(
    [ancestral_origin] => id
    [rel_sect] => unknown id
    [marital_status] => unknown str comp
    [age] => 12	range
    [marriage_plan] => 2015-01-01 match year
    [grew_up] => asdf match str
    [lives_in] => ddd mat str
    [local_res_status] => dfjjd match str
    [occupation] =>  id
    [education] =>   id
)
*/

$user_id = $_REQUEST['user_id'];
$min_age = $_REQUEST['min_age'];
$max_age = $_REQUEST['max_age'];
$gender	 = $_REQUEST['gender'] == 'm'? 'f' : 'm';  //store in app pref so send from dev
$location 	 = $_REQUEST['location'];   //required id ot string
$id 	 = $_REQUEST['id']?$_REQUEST['id']:MAX_ID;  //for paging 10 results at a time

//include partner pref 

$user = new Users;
$search_result=array();

if(!empty($user_id) && !empty($min_age) && !empty($max_age) && !empty($gender) && !empty($location)){
	$exclude = $user->excludeUsersFromSearchFor($user_id);
	$search_result  = $user->getSearchResultForUser($user_id,$gender,$exclude,$location,$id,$min_age,$max_age);

	//calculate compatibility %//
	$partner_pref = $user->getPartnerPref($user_id);

	//print_r($search_result[0]);
	//print_r($partner_pref);die;
	foreach ($search_result as $key => $value) {
		$compatibility = '0';
		if($partner_pref['ancestral_origin'] == $value['fam_anct_origin'])
			$compatibility+= 10;
		if($partner_pref['rel_sect'] == $value['rel_sect'])
			$compatibility+= 10;
		if($partner_pref['marital_status'] == $value['marital_status'])
			$compatibility+= 10;
		if($partner_pref['age'] == $value['age'])
			$compatibility+= 10;
		if($partner_pref['marriage_plan'] == $value['marriage_plan'])
			$compatibility+= 10;
		if($partner_pref['grew_up'] == $value['grew_up'])
			$compatibility+= 10;
		if($partner_pref['lives_in'] == $value['lives_in'])
			$compatibility+= 10;
		if($partner_pref['local_res_status'] == $value['loc_res_status'])
			$compatibility+= 10;
		if($partner_pref['occupation'] == $value['occupation'])
			$compatibility+= 10;
		if($partner_pref['education'] == $value['edu_education'])
			$compatibility+= 10;

		$value['compatibility'] = (string)$compatibility;
		$search_result[$key]=$value;
	}
	$success='1';$msg='success';
}else{
	$success='0';$msg='Incomplete Parameters';
}
echo json_encode(array('success'=>$success,'msg'=>$msg,'users'=>$search_result));
?>