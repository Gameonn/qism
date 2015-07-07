<?php
require_once('../phpInclude/db_connection.php');
require_once('../classes/AllClasses.php');
require_once('../PHPMailer_5.2.4/class.phpmailer.php');

$email= $_REQUEST['email'];
$regex = "^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$"; 
if ( preg_match( $regex, $email ) ) {
    $email_valid=true;
} else { 
	$email_valid=false;
}

if($email_valid){

// +-----------------------------------+
// + STEP 3: perform operations		   +
// +-----------------------------------+
	$pass_reset_key=uniqid(5,true);
	$sql="update user set pass_reset_key=:pass_reset_key where email=:email";
	$sth=$conn->prepare($sql);
	$sth->bindValue("email",$email);
	$sth->bindValue("pass_reset_key",md5($pass_reset_key));
	$count=0;
	try{$count=$sth->execute();}catch(Exception $e){}
	if($count){
		$success="1";
		//send email
		$url=BASE_PATH."/resetPassword.php?token=".$pass_reset_key;
		$msg="Email sent"." $url";
		
			$smtp_username = SMTP_USER;
			$smtp_email = SMTP_EMAIL;
			$smtp_password = SMTP_PASSWORD;
			$smtp_name = SMTP_NAME;
			$subjectMail = 'Verify Email';
			$mail = new PHPMailer(true); 
			$mail->IsSMTP(); 
			try {
			  $mail->Host       = SMTP_HOST; 
			  $mail->SMTPDebug  = 1;                    
			  $mail->SMTPAuth   = true;                  
			  $mail->Host       = SMTP_HOST; 
			  $mail->Port       = SMTP_PORT;                   
			  $mail->Username   = $smtp_username; 
			  $mail->Password   = $smtp_password;       
			  $mail->AddAddress($email, '');     
			  $mail->SetFrom($smtp_email, $smtp_name);
			  $mail->AddReplyTo($smtp_email, $smtp_name);
			  $mail->Subject = $subjectMail;
			  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; 
			  $mail->MsgHTML('Please click the following link to reset your password<br>'.$url) ;
			  if(!$mail->Send()){
			  }else{
				  $mail_send=1;
					
			  }
			} catch (phpmailerException $e) {
			  
			} catch (Exception $e) {
			 
			}
			
		$data=array();
	}
	else{
		$success="0";
		$msg="Error occurred";
	}
}


}else{
	$success='0';$msg='Not valid Email';
}

echo json_encode(array('success'=>$success,'msg'=>$msg));
?>