<?php session_start();
//this page is to handle all the admin events occured at client side
require_once("../phpInclude/db_connection.php"); 
require_once('../PHPMailer_5.2.4/class.phpmailer.php');
function randomFileNameGenerator($prefix){
	$r=substr(str_replace(".","",uniqid($prefix,true)),0,20);
	if(file_exists("../uploads/$r")) randomFileNameGenerator($prefix);
	else return $r;
}
 function sendEmail($email,$subjectMail,$bodyMail,$email_back){

        $mail = new PHPMailer(true); 
        $mail->IsSMTP(); // telling the class to use SMTP
        try {
          //$mail->Host       = SMTP_HOST; // SMTP server
          $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
          $mail->SMTPAuth   = true;                  // enable SMTP authentication
          $mail->Host       = SMTP_HOST; // sets the SMTP server
          $mail->Port       = SMTP_PORT;                    // set the SMTP port for the GMAIL server
          $mail->Username   = SMTP_USER; // SMTP account username
          $mail->Password   = SMTP_PASSWORD;        // SMTP account password
          $mail->AddAddress($email, '');     // SMTP account password
          $mail->SetFrom(SMTP_EMAIL, SMTP_NAME);
          $mail->AddReplyTo($email_back, SMTP_NAME);
          $mail->Subject = $subjectMail;
          $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automaticall//y
          $mail->MsgHTML($bodyMail) ;
          if(!$mail->Send()){
           $success='0';
           $msg="Error in sending mail";
         }else{
           $success='1';
         }
       } catch (phpmailerException $e) {
          $msg=$e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
          $msg=$e->getMessage(); //Boring error messages from anything else!
        }
        //echo $msg;
      }

$success=0;
$msg="";
session_start();
//switch case to handle different events
switch($_REQUEST['event']){
	case "signin":     
	//print_r($_REQUEST);die;
		$success=0;
		$user=$_REQUEST['username'];
		$password=$_REQUEST['password'];
		$redirect=$_REQUEST['redirect'];
		$sth=$conn->prepare("select * from admin where (username=:name or email=:email)");
		$sth->bindValue("name",$user);
		$sth->bindValue("email",$user);
		try{$sth->execute();}catch(Exception $e){
		//echo $e->getMessage();
		}
		$result=$sth->fetchAll(PDO::FETCH_ASSOC);
		$type=$result[0]['admin_type'];
		$uname=$result[0]['username'];
		$email=$result[0]['email'];
		$id=$result[0]['id'];
		/*if($type==2){
		
		}*/
		if(count($result)){
			foreach($result as $row){
		
				if($row['password']==md5($password)){
					
					$success=1;
					
					$_SESSION['admin']['id']=$id;
					$_SESSION['admin']['username']=$uname;
					$_SESSION['admin']['email']=$email;
					$_SESSION['admin']['type']=$type;
					
				}
			}
		}
		if(!$success){
			$redirect="index.php";
			$msg="Invalid Username/Password";
		}
		header("Location: $redirect?success=$success&msg=$msg");
		break;
	
	case "signout":
		unset($_SESSION);
		session_destroy();
		header("Location: index.php?success=1&msg=Signout Successful!");
		break;
		
	case "add_community":
	
	   $community=$_REQUEST['community'];
	    $sth=$conn->prepare("insert into communities values(DEFAULT,:community,'n')");
          $sth->bindValue("community",$community);
          $count=0;
          try{$count=$sth->execute();}
          catch(Exception $e){
           // echo $e->getMessage();
          }
          if($count){
           $success=1;
           $msg='Community Added';
          }
		header("Location: community.php?success=$success&msg=$msg");
	break;
	
	case "block_user":
	
	   $user_id=$_REQUEST['uid'];
	   $bl=$_REQUEST['bl'];
	    $sth=$conn->prepare("update user set is_blocked=:bl where user.id=:user_id");
          $sth->bindValue("user_id",$user_id);
          $sth->bindValue('bl',$bl);
          $count=0;
          try{$count=$sth->execute();}
          catch(Exception $e){
           // echo $e->getMessage();
          }
          if($count){
           $success=1;
           $msg='User Blocked';
          }
		header("Location: users.php?success=$success&msg=$msg");
	break;
	
		case "update_verification_status":
	//print_r($_REQUEST);die;
	   $user_id=$_REQUEST['uid'];
	   $cid=$_REQUEST['cid'];
	   $bl='y';
	   if($cid==1)
	    $sth=$conn->prepare("update ID_verification set passport_verified=:bl where user_id=:user_id");
		elseif($cid==2)
		$sth=$conn->prepare("update ID_verification set id_card_verified=:bl where user_id=:user_id");
		elseif($cid==3)
		$sth=$conn->prepare("update ID_verification set license_verified=:bl where user_id=:user_id");
		
          $sth->bindValue("user_id",$user_id);
          $sth->bindValue('bl',$bl);
          $count=0;
          try{$count=$sth->execute();}
          catch(Exception $e){
           echo $e->getMessage();
          }
          if($count){
           $success=1;
           $msg='User Verified';
          }
		  else
		  $msg="Connection Failed during process";
		//header("Location: verify_user.php?success=$success&msg=$msg");
	break;
	
		case "create_user":
		//print_r($_POST);die;
		$redirect=$_REQUEST['redirect'];
		$username=$_REQUEST['username'];
		$email=$_REQUEST['email'];
		$password=$_REQUEST['password'];
			
		$sth=$conn->prepare("select * from admin where username=:username or email=:email");
	$sth->bindValue("username",$username);
	$sth->bindValue("email",$email);
	
	try{$sth->execute();}catch(Exception $e){}
	$result=$sth->fetchAll(PDO::FETCH_ASSOC);
	if(count($result)){
		$success="0";
		if($username==$result[0]['username'])
			$msg="Username is already taken";
		else
			$msg="Email is already registered";
		
		}
		else{
		$success="0";
		$code=md5($username . rand(1,9999999));
		$sql="insert into admin values(DEFAULT,:username,:email,:password,2)";
		$sth=$conn->prepare($sql);
		$sth->bindValue("username",$username);
		$sth->bindValue("email",$email);
		$sth->bindValue("password",md5($password));
		
		$count1=0;
		try{$count1=$sth->execute();}catch(Exception $e){
		echo $e->getMessage();
		}
		
		if($count1){
		$success='1';
		$msg="Invitation link sent to Sub admin";
		
		
		//mail
			$smtp_username = SMTP_USER;
			$smtp_email = SMTP_EMAIL;
			$smtp_password = SMTP_PASSWORD;
			$smtp_name = SMTP_NAME;
			$subjectMail = 'Welcome to Qisma - Verify your email';
			$mail = new PHPMailer(true); 
			$mail->IsSMTP(); // telling the class to use SMTP
			try {
			  $mail->Host       = SMTP_HOST; // SMTP server
			  $mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
			  $mail->SMTPAuth   = true;                  // enable SMTP authentication
			  $mail->Host       = SMTP_HOST; // sets the SMTP server
			  $mail->Port       = SMTP_PORT;                    // set the SMTP port for the GMAIL server
			  $mail->Username   = $smtp_username; // SMTP account username
			  $mail->Password   = $smtp_password;        // SMTP account password
			  $mail->AddAddress($email);     // SMTP account password
			  $mail->SetFrom($smtp_email, $smtp_name);
			  $mail->AddReplyTo($smtp_email, $smtp_name);
			  $mail->Subject = $subjectMail;
			  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
			  $mail->MsgHTML('Welcome to Qisma! You are registered to the Qisma system. Login with '.BASE_PATH.'admin/ with following credentials<br>
			  Email=>'.$email.
			  '<br>Username=>'.$username.
			  '<br>Password=>'.$password) ;
			  
			  
			  if(!$mail->Send()){
				//echo json_encode(array('success'=>'0','msg'=>'Error while sending Mail'));
			  }else{
				// echo json_encode(array('success'=>'1','msg'=>'Signup Complete Verify Email'));
			  }
			} catch (phpmailerException $e) {
			  //echo $e->errorMessage(); //Pretty error messages from PHPMailer
			} catch (Exception $e) {
			 // echo $e->getMessage(); //Boring error messages from anything else!
			}
		}	
		}		
		header("Location: $redirect?success=$success&msg=$msg");
		break;
	
	case "add_subcommunity":
	
	   $subcommunity=$_REQUEST['subcommunity'];
	   $cid=$_REQUEST['community_id'];
	   
	    $sth=$conn->prepare("insert into sub_communities values(DEFAULT,:community_id,:subcommunity,'n')");
          $sth->bindValue("subcommunity",$subcommunity);
          $sth->bindValue('community_id',$cid);
          $count=0;
          try{$count=$sth->execute();}
          catch(Exception $e){
           // echo $e->getMessage();
          }
          if($count){
           $success=1;
           $msg='SubCommunity Added';
          }
		header("Location: community.php?success=$success&msg=$msg");
	break;
		
	case "add_occupation":
	   $occupation=$_REQUEST['occupation'];
	    $sth=$conn->prepare("insert into occupations values(DEFAULT,:occupation,NOW())");
          $sth->bindValue("occupation",$occupation);
          $count=0;
          try{$count=$sth->execute();}
          catch(Exception $e){
            echo $e->getMessage();
          }
          if($count){
           $success=1;
           $msg='Occupation Added';
          }
		header("Location: occupation.php?success=$success&msg=$msg");
	break;
	
	case "add_origin":
	   $origins=$_REQUEST['origins'];
	    $sth=$conn->prepare("insert into ancestral_origins values(DEFAULT,:origins,'n')");
          $sth->bindValue("origins",$origins);
          $count=0;
          try{$count=$sth->execute();}
          catch(Exception $e){
           // echo $e->getMessage();
          }
          if($count){
           $success=1;
           $msg='Ethnic Origin Added';
          }
		header("Location: ethnic_origins.php?success=$success&msg=$msg");
	break;
	
	case "add_education":
	   $education=$_REQUEST['education'];
	    $sth=$conn->prepare("insert into educations values(DEFAULT,:education)");
          $sth->bindValue("education",$education);
          $count=0;
          try{$count=$sth->execute();}
          catch(Exception $e){
            echo $e->getMessage();
          }
          if($count){
           $success=1;
           $msg='Education Level Added';
          }
		header("Location: education.php?success=$success&msg=$msg");
	break;
	
	case "add_industry":
	   $industry=$_REQUEST['industry'];
	    $sth=$conn->prepare("insert into industries values(DEFAULT,:industry,NOW())");
          $sth->bindValue("industry",$industry);
          $count=0;
          try{$count=$sth->execute();}
          catch(Exception $e){
            //echo $e->getMessage();
          }
          if($count){
           $success=1;
           $msg='Industry Added';
          }
		header("Location: industry.php?success=$success&msg=$msg");
	break;
	
	case "add_sects":
	   $sect=$_REQUEST['sect'];
	    $sth=$conn->prepare("insert into sects values(DEFAULT,:sect,'n')");
          $sth->bindValue("sect",$sect);
          $count=0;
          try{$count=$sth->execute();}
          catch(Exception $e){
            //echo $e->getMessage();
          }
          if($count){
           $success=1;
           $msg='Sect Added';
          }
		header("Location: sects.php?success=$success&msg=$msg");
	break;
	
	case 'get-community':
	$cid=$_REQUEST['cid'];
	$sth=$conn->prepare("select * from communities where id=:id");
	$sth->bindValue('id',$cid);
	try{$sth->execute();}
	catch(Exception $e){echo $e->getMessage();}
	$result=$sth->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($result);
	break;
	
	case 'edit_community':
	$cid=$_REQUEST['cid'];
	$community=$_REQUEST['community'];
	$sth=$conn->prepare("update communities set community=:community where id=:id");
	$sth->bindValue('id',$cid);
	$sth->bindValue("community",$community);
	$count=0;
	try{$count=$sth->execute();}
	catch(Exception $e){
	//echo $e->getMessage();
	}
	 if($count){
           $success=1;
           $msg='Community Name Updated';
          }
		header("Location: community.php?success=$success&msg=$msg");
	break;
	
	case 'get-subcommunity':
	$sid=$_REQUEST['sid'];
	$sth=$conn->prepare("select * from sub_communities where id=:id");
	$sth->bindValue('id',$sid);
	try{$sth->execute();}
	catch(Exception $e){echo $e->getMessage();}
	$result=$sth->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($result);
	break;
	
	case 'get-reported-user':
	$uid=$_REQUEST['cid'];
	$sth=$conn->prepare("select reported_user.reason,(select user.username from user where user.id=reported_user.user_id1) as username, (select user.profile_image from user where user.id=reported_user.user_id1) as profile_image from reported_user where reported_user.user_id2=:id");
	$sth->bindValue('id',$uid);
	try{$sth->execute();}
	catch(Exception $e){echo $e->getMessage();}
	$result=$sth->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($result);
	break;
	
	case 'edit_subcommunity':
	$sid=$_REQUEST['sid'];
	$subcommunity=$_REQUEST['subcommunity'];
	$sth=$conn->prepare("update sub_communities set sub_community=:sub_community where id=:id");
	$sth->bindValue('id',$sid);
	$sth->bindValue("sub_community",$subcommunity);
	$count=0;
	try{$count=$sth->execute();}
	catch(Exception $e){
	//echo $e->getMessage();
	}
	 if($count){
           $success=1;
           $msg='Sub Community Name Updated';
          }
		header("Location: community.php?success=$success&msg=$msg");
	break;
	
	case 'get-occupation':
	$ocid=$_REQUEST['ocid'];
	$sth=$conn->prepare("select * from occupations where id=:id");
	$sth->bindValue('id',$ocid);
	try{$sth->execute();}
	catch(Exception $e){echo $e->getMessage();}
	$result=$sth->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($result);
	break;
	
	case 'edit_occupation':
	$ocid=$_REQUEST['ocid'];
	$occupation=$_REQUEST['occupation'];
	$sth=$conn->prepare("update occupations set occupation=:occupation where id=:id");
	$sth->bindValue('id',$ocid);
	$sth->bindValue("occupation",$occupation);
	$count=0;
	try{$count=$sth->execute();}
	catch(Exception $e){
	//echo $e->getMessage();
	}
	 if($count){
           $success=1;
           $msg='Occupation Updated';
          }
		header("Location: occupation.php?success=$success&msg=$msg");
	break;
	
	case 'get-industry':
	$did=$_REQUEST['did'];
	$sth=$conn->prepare("select * from industries where id=:id");
	$sth->bindValue('id',$did);
	try{$sth->execute();}
	catch(Exception $e){echo $e->getMessage();}
	$result=$sth->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($result);
	break;
	
	case 'edit_industry':
	$did=$_REQUEST['did'];
	$industry=$_REQUEST['industry'];
	$sth=$conn->prepare("update industries set industry=:industry where id=:id");
	$sth->bindValue('id',$did);
	$sth->bindValue("industry",$industry);
	$count=0;
	try{$count=$sth->execute();}
	catch(Exception $e){
	//echo $e->getMessage();
	}
	 if($count){
           $success=1;
           $msg='Industry Updated';
          }
		header("Location: industry.php?success=$success&msg=$msg");
	break;
	
	case 'get-origin':
	$cid=$_REQUEST['cid'];
	$sth=$conn->prepare("select * from ancestral_origins where id=:id");
	$sth->bindValue('id',$cid);
	try{$sth->execute();}
	catch(Exception $e){echo $e->getMessage();}
	$result=$sth->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($result);
	break;
	
	case 'edit_origin':
	$cid=$_REQUEST['cid'];
	$origin=$_REQUEST['origin'];
	$sth=$conn->prepare("update ancestral_origins set ancestral_origin=:ancestral_origin where id=:id");
	$sth->bindValue('id',$cid);
	$sth->bindValue("ancestral_origin",$origin);
	$count=0;
	try{$count=$sth->execute();}
	catch(Exception $e){
	//echo $e->getMessage();
	}
	 if($count){
           $success=1;
           $msg='Ethnic Origin Updated';
          }
		header("Location: ethnic_origins.php?success=$success&msg=$msg");
	break;

	case 'get-education':
	$cid=$_REQUEST['cid'];
	$sth=$conn->prepare("select * from educations where id=:id");
	$sth->bindValue('id',$cid);
	try{$sth->execute();}
	catch(Exception $e){echo $e->getMessage();}
	$result=$sth->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($result);
	break;
	
	case 'edit_education':
	$cid=$_REQUEST['cid'];
	$education=$_REQUEST['education'];
	$sth=$conn->prepare("update educations set education=:education where id=:id");
	$sth->bindValue('id',$cid);
	$sth->bindValue("education",$education);
	$count=0;
	try{$count=$sth->execute();}
	catch(Exception $e){
	//echo $e->getMessage();
	}
	 if($count){
           $success=1;
           $msg='Education Level Updated';
          }
		header("Location: education.php?success=$success&msg=$msg");
	break;
	
	case 'get-sect':
	$cid=$_REQUEST['cid'];
	$sth=$conn->prepare("select * from sects where id=:id");
	$sth->bindValue('id',$cid);
	try{$sth->execute();}
	catch(Exception $e){echo $e->getMessage();}
	$result=$sth->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($result);
	break;
	
	case 'edit_sect':
	$cid=$_REQUEST['cid'];
	$sect=$_REQUEST['sect'];
	$sth=$conn->prepare("update sects set sect=:sect where id=:id");
	$sth->bindValue('id',$cid);
	$sth->bindValue("sect",$sect);
	$count=0;
	try{$count=$sth->execute();}
	catch(Exception $e){
	//echo $e->getMessage();
	}
	 if($count){
           $success=1;
           $msg='Sect Updated';
          }
		header("Location: sects.php?success=$success&msg=$msg");
	break;
	
	case 'forgot_password':
	  
          $email=$_REQUEST['email'];
          $redirect='forgot_password.php';
          if(!($email)){
           $success="0";
           $msg="Incomplete Parameters";
         }
         else{
           $sql="select * from admin where email=:email";
           $sth=$conn->prepare($sql);
           $sth->bindValue("email",$email);
           try{$sth->execute();}catch(Exception $e){
        	echo $e->getMessage();
           }
           $res=$sth->fetchAll();
           if(count($res)){ 
                        
              $success="1";
              $msg="An email is sent to you";
              
             sendEmail($email,"Qisma - Recover Password",
			"<div style='font-size:20px;line-height:1.6;'>
				<p>Dear Admin,</p>
				<br>
				<p>We have received your password Qisma reset request.</p>
				<p>Please follow the link below to set a new password:</p>
				<p><a href='".BASE_PATH."reset-password.php'>".BASE_PATH."reset-password.php</a></p>
				<p>For questions or technical assistance, please email Qisma technical support: info@socialchange.media</p>
		                <br>
		                <p>Thank you,</p>
		                <p>Qisma</p>
		                <p><a href='http:// www.qisma.media '> www.qisma.media </a></p>
		              </div>"
		,SMTP_EMAIL);
          
          }
          else{
            $success="0";
            $msg="Invalid Email ";
          }
        }
        header("Location: $redirect?success=$success&msg=$msg");
        break;
		
	case "reset-password":
		$token=$_REQUEST["token"];
		$password=$_REQUEST["password"];
		$confirm=$_REQUEST["confirm"];
		//$base="http://www.code-brew.com/projects/gambay/thank_you.php";
		$base="http://www.code-brew.com/projects/gambay/reset-password.php";
		if($password==$confirm){
				$sth=$conn->prepare("update users set password=:password where token=:token");
				$sth->bindValue("token",$token);
				$sth->bindValue("password",md5($password));
				$count=0;
				try{$count=$sth->execute();}catch(Exception $e){echo $e;}
				if($count){
					$success=1;
					$msg="Password changed successfully";
				}
			}else{
				$success=0;
				$msg="Passwords didn't match";
			}
	header("Location: $base?success=1&msg=$msg");
	break;
	
	case "change-password":
	
		$success=$msg=null;
		$redirect=$_REQUEST['redirect'];
		$oldpass=$_REQUEST['oldpass'];
		$newpass=$_REQUEST['newpass'];
		
		$sth=$conn->prepare("select * from admin where password=:password");
		$sth->bindValue("password",md5($oldpass));
		
		try{$sth->execute();}
		catch(Exception $e){
		//echo $e->getMessage();
		}
		$result=$sth->fetchAll(PDO::FETCH_ASSOC);
		
		if(count($result) && $newpass && ($newpass==$_REQUEST['confirm'])){
			$newpass=md5($newpass);
			$sth=$conn->prepare("update admin set password=:password where name=:username");
			$sth->bindValue("username",'admin');
			$sth->bindValue("password",$newpass);
			$count=0;
			try{$count=$sth->execute();}catch(Exception $e){
			echo $e->getMessage();
			}
			if($count){
				$success=1;
				$msg="Password Updated!";
			}
			else{
				$success=0;
				$msg="Invalid Request! Try Again Later!";
				$redirect="changePassword.php";
			}
		}
		else{
			$success=0;
			
			/*if($newpass) $msg="All Fields are required!"; else */
			$msg="Passwords didn't match!";
			$redirect="changePassword.php";
		}
		
		
		header("Location: $redirect?success=$success&msg=$msg");
		break;	
}	
?>