<?php
  require("../twilio/Services/Twilio.php");
  require("../phpInclude/db_connection.php");
  error_reporting(E_ALL);
  // require POST request
  if ($_SERVER['REQUEST_METHOD'] != "POST") die;
  
//  $phone_number=$_REQUEST['phone_number'];
	$phone_number=$_REQUEST['phone_number'];
	$user_id = $_REQUEST['user_id'];
  if(empty($phone_number)){
	  echo json_encode(array('success'=>'0','msg'=>'Incomplete Parameters'));die;
  }
  $success='0';
  $code=rand(100000,999999);
  $sql="SELECT * FROM phone_verification WHERE phone='{$phone_number}' LIMIT 1";
  $result=$conn->query($sql);
  if($result->rowCount() == 1){
	$row=$result->fetch(PDO::FETCH_ASSOC);  
	if($row['verified']=='n'){
		$sql="DELETE FROM phone_verification WHERE id={$row['id']}";
		if($conn->query($sql)){
			//send verification code//
			$sql="INSERT INTO phone_verification VALUES(NULL,:user_id,:phone,:verification_code,'n',NOW())";
			$stmt=$conn->prepare($sql);
			$stmt->bindParam(':user_id',$user_id);
			$stmt->bindParam(':phone',$phone_number);
			$stmt->bindParam(':verification_code',$code);
			if($stmt->execute()){
				echo json_encode(array('success'=>'1','code'=>$code));
				$success='1';
			}else{
				echo json_encode(array('success'=>'0','msg'=>'Error'));die;
			}
		}else{
			//user already exists //
			echo json_encode(array('success'=>'0','msg'=>'Phone already registered'));die;
		}
	}
  }else{
	$sql="INSERT INTO phone_verification VALUES(NULL,:user_id,:phone,:verification_code,'n',NOW())";
	$stmt=$conn->prepare($sql); 
	$stmt->bindParam(':user_id',$user_id); 
	$stmt->bindParam(':phone',$phone_number);
	$stmt->bindParam(':verification_code',$code);
	if($stmt->execute()){
		echo json_encode(array('success'=>'1','code'=>$code));
		$success='1';
	}else{
		echo json_encode(array('success'=>'0','msg'=>'Error'));die;
	} 
  }
  
  if(!empty($success)){
  	/*
	  $AccountSid = "AC030670541528408491ecbfe5e995ad01";
	  $AuthToken = "0855187bb7df1fb61ef51e31d32c9994";
	  $client = new Services_Twilio($AccountSid, $AuthToken);
	  try {
		// send sms
		
		$sms = $client->account->messages->sendMessage('+19292444447', $phone_number, 'Your Verification Code :'.$code);
		
		//echo $sms;
	  } catch (Exception $e) {
		$error='Error starting phone call: ' . $e->getMessage();
		//echo $error;
	  }
	  */
	}
?>
