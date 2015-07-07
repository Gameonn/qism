<?php
/*
user profile pic and bio

*/
require_once('../phpInclude/db_connection.php');
//error_reporting(E_ALL);
require_once('../classes/AllClasses.php');

$user_id = $_REQUEST['user_id'];
$image	 = $_FILES['image'];
$is_main = $_REQUEST['is_main']?$_REQUEST['is_main']:0;

$image_path = '';
$user = new Users;

if($image["error"]>0){
    $success="0";
    $msg="Invalid image";
    if($image["error"]==4) $success="1"; //image is not mandatory
}
//upload image
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

if($user_id){
	//save image//
	$user->saveImageToGallery($user_id,$image_path,$is_main);
	$gallery = $user->getUserGallery($user_id,$user_id);
	$profile = $user->getUserProfile($user_id);
    $success="1";
    $msg='success';
}else{
	$success='0';$msg='Incomplete Parameters';
}

echo json_encode(array('success'=>$success,'msg'=>$msg,'gallery'=>$gallery,'profile'=>$profile));
function randomFileNameGenerator($prefix){
    $r=substr(str_replace(".","",uniqid($prefix,true)),0,19);
    if(file_exists("../images/$r")) randomFileNameGenerator($prefix);
    else return $r;
}
?>
