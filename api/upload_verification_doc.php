<?php
require_once('../phpInclude/db_connection.php');
//error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

/*
user have option to upload 3 docs
passport , ID card , License


*/

$user_id = $_REQUEST['user_id'];
$flag    = (int) $_REQUEST['flag'];    //1,2,3
$image	 = $_FILES['image'];

if(!empty($user_id) && !empty($flag)){
	if($image["error"]>0){
	    $success="0";
	    $msg="Invalid image";
	    if($image["error"]==4) $success="1"; //image is not mandatory
	}

	elseif($image['size'] > 0){
	    $image_name = explode(".",$image['name']);
	    $temp = randomFileNameGenerator("Img_");
	    $extension = end($image_name);

	    $randomFileName=$temp.".".$extension;
	    if(@move_uploaded_file($image['tmp_name'], "../images/$randomFileName")){
	        $success="1";
	        $image_path=$randomFileName;
	    }
	    else{
	        $success="0";
	        $msg="Error in uploading image";
	    }
	}
	else{
	    $success="1";
	    $msg="Invalid Image";
	}

	if($success){
		$user = new Users;
		switch ($flag) {
			case 1:
				$user->savePassportVerificationProof($user_id,$image_path);
				break;
			case 2:
				$user->saveIdVerificationProof($user_id,$image_path);
				break;
			case 3:
				$user->saveLicenseVerificationProof($user_id,$image_path);
				break;
			
			default:
				//do nothing
				break;
		}

	}

	$success='1';$msg='success';

}else{
	$success='0';$msg='Incomplete Parameters';
}

echo json_encode(array('success'=>$success,'msg'=>$msg,'verification_status'=>$user->getUserIdVerificationStatus($user_id)));

function randomFileNameGenerator($prefix){
    $r=substr(str_replace(".","",uniqid($prefix,true)),0,19);
    if(file_exists("../uploads/$r")) randomFileNameGenerator($prefix);
    else return $r;
}

?>
