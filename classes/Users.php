<?php
class Users{

	public static function isUserNameExists($username){
		global $conn;
		$sql	= "Select count(*) as count from user WHERE username LIKE :username LIMIT 1";
		$sth	= $conn->prepare($sql);
		$sth->bindParam(':username',$username,PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		$count	= $result[0]['count'];
		return $count;
	}

	public static function isUserEmailExists($email){
		global $conn;
		$sql	= "Select count(*) as count from user WHERE email LIKE :email LIMIT 1";
		$sth	= $conn->prepare($sql);
		$sth->bindParam(':email',$email,PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		$count	= $result[0]['count'];
		return $count;
	}

	public static function createUserByEmail($username,$email,$password,$gender,$dob,$location,$lat,$lng){
		global $conn;
		$facebook_id = $twitter_id = NULL;
		$approved	 = 'n';
		$token 		 = '';
		$sql	= "INSERT INTO user (username,email,password,gender,dob,location,lat,lng) VALUES(:username,:email,:password,:gender,:dob,:location,:lat,:lng)";
		$sth	= $conn->prepare($sql);
		$sth->bindParam(':username',$username);
		$sth->bindParam(':email',$email);
		$sth->bindParam(':password',$password);
		$sth->bindParam(':gender',$gender);
		$sth->bindParam(':dob',$dob);
		$sth->bindParam(':location',$location);
		$sth->bindParam(':lat',$lat);
		$sth->bindParam(':lng',$lng);
		try{
			$sth->execute();
			$insertid	= $conn->lastInsertId();
		}catch(Exception $e){
			echo $e->getMessage();
			$insertid 	= 0;
		}
		return $insertid;
	}

	public static function createUserByFacebookId($facebook_id,$username,$gender,$dob,$location,$lat,$lng){
		global $conn;

		$user_id=Users::getUserIdByFacebookId($facebook_id);
		if($user_id){
			return $user_id;
		}else{
			$approved	 = 'n';
			$token 		 = '';
			$sql	= "INSERT INTO user (username,gender,dob,location,lat,lng,facebook_id) VALUES(:username,:gender,:dob,:location,:lat,:lng,:facebook_id)";
			$sth	= $conn->prepare($sql);
			$sth->bindParam(':username',$username);
			$sth->bindParam(':gender',$gender);
			$sth->bindParam(':dob',$dob);
			$sth->bindParam(':location',$location);
			$sth->bindParam(':lat',$lat);
			$sth->bindParam(':lng',$lng);
			$sth->bindParam(':facebook_id',$facebook_id);
			try{
				$sth->execute();
				$insertid	= $conn->lastInsertId();
			}catch(Exception $e){
				echo $e->getMessage();
				$insertid 	= 0;
			}
			return $insertid;
		}
	}

	public static function createUserByGoogleId($google_id,$username,$gender,$dob,$location,$lat,$lng){
		global $conn;

		$user_id=Users::getUserIdByGoogleId($google_id);
		if($user_id){
			return $user_id;
		}else{
			$approved	 = 'n';
			$token 		 = '';
			$sql	= "INSERT INTO user (username,gender,dob,location,lat,lng,google_id) VALUES(:username,:gender,:dob,:location,:lat,:lng,:google_id)";
			$sth	= $conn->prepare($sql);
			$sth->bindParam(':username',$username);
			$sth->bindParam(':gender',$gender);
			$sth->bindParam(':dob',$dob);
			$sth->bindParam(':location',$location);
			$sth->bindParam(':lat',$lat);
			$sth->bindParam(':lng',$lng);
			$sth->bindParam(':google_id',$google_id);
			try{
				$sth->execute();
				$insertid	= $conn->lastInsertId();
			}catch(Exception $e){
				echo $e->getMessage();
				$insertid 	= 0;
			}
			return $insertid;
		}
	}

	public static function getUserProfileById($user_id){
		global $conn;
		$sql	= "SELECT id,email,nickname,username,gender,dob,location,phone,about,profile_image,cover_image,google_id,facebook_id,twitter_id,instagram_id FROM user WHERE id=:user_id";
		$sth 	= $conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $result[0];
	}

	public static function generateToken($user_id){
		global $conn;
		return md5('makeup_'.$user_id.'_'.md5(rand(1,1000000)));
	}

	public static function setToken($user_id,$token){
		global $conn;
		$sql = "UPDATE user SET token=:token WHERE id=:user_id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':token',$token);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
		}catch(Exception $e){}
		return true;
	}

	public static function getUserIdByFacebookId($facebook_id){
		global $conn;
		$sql = "SELECT id FROM user WHERE facebook_id=:facebook_id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':facebook_id',$facebook_id);
		$sth->execute();
		$result=$sth->fetchAll(PDO::FETCH_ASSOC);
		return $result[0][id] ? $result[0][id] : 0;
	}

	public static function getUserIdByGoogleId($google_id){
		global $conn;
		$sql = "SELECT id FROM user WHERE google_id=:google_id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':google_id',$google_id);
		$sth->execute();
		$result=$sth->fetchAll(PDO::FETCH_ASSOC);
		return $result[0][id] ? $result[0][id] : 0;
	}


	public static function isTokenValid($user_id,$token){
		global $conn;
		$sql = "SELECT count(*) as count FROM user WHERE id=:id AND token=:token";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':id',$user_id);
		$sth->bindParam(':token',$token);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $result[0]['count'];
	}


	public static function isUserNamePasswordValid($username,$password){
		global $conn;
		$user_id = 0;
		$password = md5($password);
		$sql = "SELECT id FROM user WHERE username=:username AND password=:password";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':username',$username);
		$sth->bindParam(':password',$password);
		try{
			$sth->execute();
			$result=$sth->execute();
			$result=$sth->fetchAll(PDO::FETCH_ASSOC);
			$user_id = $result[0]['id'];
		}catch(Exception $e){}
		return $user_id;
	}


	public static function isEmailPasswordValid($email,$password){
		global $conn;
		$user_id = 0;
		$password = md5($password);
		$sql = "SELECT id FROM user WHERE email=:email AND password=:password";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':email',$email);
		$sth->bindParam(':password',$password);
		try{
			$sth->execute();
			$result=$sth->execute();
			$result=$sth->fetchAll(PDO::FETCH_ASSOC);
			$user_id = $result[0]['id'];
		}catch(Exception $e){}
		return $user_id;
	}

	public static function registerStep2($user_id,$ethnic_origin,$sect,$marital_status,$marriage_plan,$grew_up,$lives_in,$residency_status,$occupation,$education,$height,$emp_status,$body_type,$first_lang,$spoken_lang,$smoker){
		global $conn;
		$insertid=0;
		$sql="SELECT id FROM user_detail WHERE user_id=:user_id";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
			$result=$sth->fetchAll(PDO::FETCH_ASSOC);
			if(!empty($result)){
				$id=$result[0]['id'];
			}else{}
		}catch(Exception $e){}
		if($id){

			//update user details//
			$sql="UPDATE  user_detail SET 
			fam_anct_origin=:ethnic_origin,
			rel_sect=:sect,
			marital_status=:marital_status,
			marriage_plan=:marriage_plan,
			grew_up=:grew_up,
			lives_in=:lives_in,
			loc_res_status=:residency_status,
			edu_job_title=:occupation,
			edu_education=:education,
			app_height=:height,
			emp_status=:emp_status,
			app_body_type=:body_type,
			first_lang=:first_lang,
			spoken_lang=:spoken_lang,
			hea_smoker=:smoker WHERE user_id=:user_id";
			$sth=$conn->prepare($sql);
			$sth->bindParam(':user_id',$user_id);
			$sth->bindParam(':ethnic_origin',$ethnic_origin);
			$sth->bindParam(':sect',$sect);
			$sth->bindParam(':marital_status',$marital_status);
			$sth->bindParam(':marriage_plan',$marriage_plan);
			$sth->bindParam(':grew_up',$grew_up);
			$sth->bindParam(':lives_in',$lives_in);
			$sth->bindParam(':residency_status',$residency_status);
			$sth->bindParam(':occupation',$occupation);
			$sth->bindParam(':education',$education);
			$sth->bindParam(':height',$height);
			$sth->bindParam(':emp_status',$emp_status);
			$sth->bindParam(':body_type',$body_type);
			$sth->bindParam(':first_lang',$first_lang);
			$sth->bindParam(':spoken_lang',$spoken_lang);
			$sth->bindParam(':smoker',$smoker);
			try{
				$sth->execute();	
			}catch(Exception $e){
				json_encode(array('success'=>'0','msg'=>$e->getMessage()));die;
			}
			return $id;
		}else{
			//insert//
			$sql="INSERT INTO user_detail (user_id,fam_anct_origin,rel_sect,marital_status,marriage_plan,grew_up,lives_in,loc_res_status,edu_job_title,edu_education,app_height,emp_status,app_body_type,first_lang,spoken_lang,hea_smoker) VALUES (:user_id,:ethnic_origin,:sect,:marital_status,:marriage_plan,:grew_up,:lives_in,:residency_status,:occupation,:education,:height,:emp_status,:body_type,:first_lang,:spoken_lang,:smoker)";
			$sth=$conn->prepare($sql);
			$sth->bindParam(':user_id',$user_id);
			$sth->bindParam(':ethnic_origin',$ethnic_origin);
			$sth->bindParam(':sect',$sect);
			$sth->bindParam(':marital_status',$marital_status);
			$sth->bindParam(':marriage_plan',$marriage_plan);
			$sth->bindParam(':grew_up',$grew_up);
			$sth->bindParam(':lives_in',$lives_in);
			$sth->bindParam(':residency_status',$residency_status);
			$sth->bindParam(':occupation',$occupation);
			$sth->bindParam(':education',$education);
			$sth->bindParam(':height',$height);
			$sth->bindParam(':emp_status',$emp_status);
			$sth->bindParam(':body_type',$body_type);
			$sth->bindParam(':first_lang',$first_lang);
			$sth->bindParam(':spoken_lang',$spoken_lang);
			$sth->bindParam(':smoker',$smoker);
			try{
				$sth->execute();
				$insertid = $conn->lastInsertId();
			}catch(Exception $e){
				json_encode(array('success'=>'0','msg'=>$e->getMessage()));die;
			}
		}
		return $insertid;
	}

	public static function savePartnerPreferences($user_id,$eth_origin,$sect,$marital_status,$age,$max_age,$marriage_plan,$grew_up,$lives_in,$res_status,$occupation,$education){
		global $conn;
		$id=null;
		//check if preferences already exits//
		$sql = "SELECT id FROM partner_pref WHERE user_id=:user_id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
			$result=$sth->fetchAll(PDO::FETCH_ASSOC);
			if(count($result)){
				$id = $result['0']['id'];
			}
		}catch(Exception $e){}

		if($id){
			//update//
			$sql="UPDATE partner_pref SET 
				fam_anct_origin=:fam_anct_origin,
				rel_sect=:rel_sect,
				marital_status=:marital_status,
				age=:age,
				max_age=:max_age,
				marriage_plan=:marriage_plan,
				grew_up=:grew_up,
				lives_in=:lives_in,
				local_res_status=:local_res_status,
				occupation=:occupation,
				education=:education
				WHERE user_id=:user_id
				";
			$sth=$conn->prepare($sql);
			$sth->bindParam(':user_id',$user_id);
			$sth->bindParam(':fam_anct_origin',$eth_origin);
			$sth->bindParam(':rel_sect',$sect);
			$sth->bindParam(':marital_status',$marital_status);
			$sth->bindParam(':age',$age);
			$sth->bindParam(':max_age',$max_age);
			$sth->bindParam(':marriage_plan',$marriage_plan);
			$sth->bindParam(':grew_up',$grew_up);
			$sth->bindParam(':lives_in',$lives_in);
			$sth->bindParam(':local_res_status',$res_status);
			$sth->bindParam(':occupation',$occupation);
			$sth->bindParam(':education',$education);
			try{
				$sth->execute();
			}catch(Exeception $e){}
		}else{
			//insert//
			$sql="INSERT INTO partner_pref VALUES (DEFAULT,:user_id,:fam_anct_origin,:rel_sect,:marital_status,:age,:marriage_plan,:grew_up,:lives_in,:local_res_status,:occupation,:education,NOW())";
			$sth=$conn->prepare($sql);
			$sth->bindParam(':user_id',$user_id);
			$sth->bindParam(':fam_anct_origin',$eth_origin);
			$sth->bindParam(':rel_sect',$sect);
			$sth->bindParam(':marital_status',$marital_status);
			$sth->bindParam(':age',$age);
			$sth->bindParam(':marriage_plan',$marriage_plan);
			$sth->bindParam(':grew_up',$grew_up);
			$sth->bindParam(':lives_in',$lives_in);
			$sth->bindParam(':local_res_status',$res_status);
			$sth->bindParam(':occupation',$occupation);
			$sth->bindParam(':education',$education);
			try{
				$sth->execute();
				$id=$conn->lastInsertId();
			}catch(Exception $e){
				echo $e->getMessage();
			}
		}

		return $id;
	}

	public static function getPartnerPref($user_id){
		global $conn;
		$partner_pref='';
		$sql="SELECT ifnull((ancestral_origins.ancestral_origin),'') as ancestral_origin,
		ifnull(sects.sect,'') as rel_sect,
		partner_pref.marital_status,
		partner_pref.age,
		partner_pref.max_age,
		partner_pref.marriage_plan,
		partner_pref.grew_up,
		partner_pref.lives_in,
		partner_pref.local_res_status,
		ifnull((occupations.occupation),'') as occupation,
		ifnull((educations.education),'') as education FROM partner_pref 

		LEFT JOIN ancestral_origins ON ancestral_origins.id=partner_pref.fam_anct_origin
		LEFT JOIN occupations ON occupations.id=partner_pref.occupation
		LEFT JOIN educations ON educations.id=partner_pref.education
		LEFT JOIN sects ON sects.id=partner_pref.rel_sect
		WHERE partner_pref.user_id=:user_id";

		$sth=$conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
			$result=$sth->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $key => $value) {
				$partner_pref=$result[0];
			}
		}catch(Exception $e){
			echo $e->getMessage();
		}
		return $partner_pref;
	}

	public static function savePassportVerificationProof($user_id,$image_path){
		global $conn;
		$sql="UPDATE ID_verification SET passport=:image_path WHERE user_id=:user_id";
		$sth= $conn->prepare($sql);
		$sth->bindParam(':image_path',$image_path);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();	
		}catch(Exception $e){}
		return true;
	}

	public static function saveIdVerificationProof($user_id,$image_path){
		global $conn;
		$sql="UPDATE ID_verification SET id_card=:image_path WHERE user_id=:user_id";
		$sth= $conn->prepare($sql);
		$sth->bindParam(':image_path',$image_path);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();	
		}catch(Exception $e){}
		return true;
	}

	public static function saveLicenseVerificationProof($user_id,$image_path){
		global $conn;
		$sql="UPDATE ID_verification SET license=:image_path WHERE user_id=:user_id";
		$sth= $conn->prepare($sql);
		$sth->bindParam(':image_path',$image_path);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();	
		}catch(Exception $e){}
		return true;
	}

	public static function getUserIdVerificationStatus($user_id){
		global $conn;
		$verification_status = '';
		$sql="SELECT passport_verified,id_card_verified,license_verified FROM ID_verification WHERE user_id=:user_id";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
			$result =$sth->fetchAll(PDO::FETCH_ASSOC);
			$verification_status = $result[0];
		}catch(Exception $e){}
		return $verification_status;
	}

	public static function reportIssue($user_id,$title,$description){
		global $conn;
		$insertid=0;
		$sql="INSERT INTO reports VALUES(DEFAULT,:user_id,:title,:description,NOW())";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		$sth->bindParam(':title',$title);
		$sth->bindParam(':description',$description);
		try{
			$sth->execute();
			$insertid=$conn->lastInsertId();
		}catch(Exception $e){}
		return $insertid;
	}

	public static function makeSuggestion($user_id,$title,$description){
		global $conn;
		$insertid=0;
		$sql="INSERT INTO suggestions VALUES(DEFAULT,:user_id,:title,:description,NOW())";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		$sth->bindParam(':title',$title);
		$sth->bindParam(':description',$description);
		try{
			$sth->execute();
			$insertid=$conn->lastInsertId();
		}catch(Exception $e){}
		return $insertid;
	}

	public static function contactUs($user_id,$title,$description){
		global $conn;
		$insertid=0;
		$sql="INSERT INTO contact_us VALUES(DEFAULT,:user_id,:title,:description,NOW())";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		$sth->bindParam(':title',$title);
		$sth->bindParam(':description',$description);
		try{
			$sth->execute();
			$insertid=$conn->lastInsertId();
		}catch(Exception $e){}
		return $insertid;
	}

	public static function saveUserAppearance($user_id,$height,$weight,$body,$eyes,$hair){
		global $conn;
		$sql="UPDATE user_detail SET app_height=:height,
		app_weight=:weight,
		app_body_type=:body,
		app_eyes=:eyes,
		app_hair=:hair WHERE user_id=:user_id";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':height',$height);
		$sth->bindParam(':weight',$weight);
		$sth->bindParam(':body',$body);
		$sth->bindParam(':eyes',$eyes);
		$sth->bindParam(':hair',$hair);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
		}catch(Exception $e){
			echo $e->getMessage();
		}
		return true;
	}

	public static function getUserAppearance($user_id){
		global $conn;
		$appearance='';
		$sql="SELECT app_height,app_weight,app_body_type,app_eyes,app_hair FROM user_detail WHERE user_id =:user_id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
			$result=$sth->fetchAll(PDO::FETCH_ASSOC);
			$appearance=$result[0];
		}catch(Exception $e){}
		return $appearance;
	}

	public static function saveUserBasicInfo($user_id,$eth_origin,$sect,$marital_status,$profile_by,$marriage_plan,$grew_up,$lives_in,$res_status,$occupation,$education,$dob,$compatibility){
		global $conn;
		$sql = "UPDATE user_detail SET fam_anct_origin=:eth_origin,
		rel_sect=:sect,
		marital_status=:marital_status,
		profile_by=:profile_by,
		marriage_plan=:marriage_plan,
		grew_up=:grew_up,
		lives_in=:lives_in,
		loc_res_status=:res_status,
		occupation=:occupation,
		edu_education=:education,
		compatibility=:compatibility WHERE user_id=:user_id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		$sth->bindParam(':eth_origin',$eth_origin);
		$sth->bindParam(':sect',$sect);
		$sth->bindParam(':marital_status',$marital_status);
		$sth->bindParam(':profile_by',$profile_by);
		$sth->bindParam(':marriage_plan',$marriage_plan);
		$sth->bindParam(':grew_up',$grew_up);
		$sth->bindParam(':lives_in',$lives_in);
		$sth->bindParam(':res_status',$res_status);
		$sth->bindParam(':occupation',$occupation);
		$sth->bindParam(':education',$education);
		$sth->bindParam(':compatibility',$compatibility);
		try{
			$sth->execute();
		}catch(Exception $e){}
		return true;
	}

	public static function updateUserDob($user_id,$dob){
		global $conn;
		$sql = "UPDATE user SET dob=:dob WHERE id=:user_id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':dob',$dob);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
		}catch(Exception $e){
			echo $e->getMessage();die;
			}
		return true;
	}	

	public static function getUserBasicInfo($user_id){
		global $conn;
		$basic_info='';
		$sql="SELECT 
		ifnull(ancestral_origins.ancestral_origin,'') as fam_anct_origin,
		ifnull(sects.sect,'') as rel_sect,
		UD.marital_status,
		UD.profile_by,
		UD.marriage_plan,
		UD.grew_up,
		UD.lives_in,
		UD.loc_res_status,
		ifnull(occupations.occupation,'') as occupation,
		ifnull(educations.education,'') as edu_education,
		U.dob,
		(YEAR(NOW()) - YEAR(dob)) as age,
		UD.compatibility
		FROM user U 
		JOIN user_detail UD ON U.id=UD.user_id
		LEFT JOIN ancestral_origins ON ancestral_origins.id=UD.fam_anct_origin
		LEFT JOIN sects ON sects.id=UD.rel_sect
		LEFT JOIN occupations ON occupations.id=UD.occupation
		LEFT JOIN educations ON educations.id=UD.edu_education
		WHERE U.id=:user_id";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
			$result=$sth->fetchAll(PDO::FETCH_ASSOC);
			$basic_info=$result[0];
		}catch(Exception $e){}
		return $basic_info;
	}

	public static function saveUserHealthInfo($user_id,$exercise_habbit,$smoker,$pets,$food_choice,$hiv,$health_problem){
		global $conn;
		$sql = "UPDATE user_detail SET 
		hea_exercise=:exercise_habbit,
		hea_smoker=:smoker,
		hea_pets=:pets,
		hea_food=:food_choice,
		hea_hiv=:hiv,
		hea_problem=:health_problem WHERE user_id=:user_id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':exercise_habbit',$exercise_habbit);
		$sth->bindParam(':smoker',$smoker);
		$sth->bindParam(':pets',$pets);
		$sth->bindParam(':food_choice',$food_choice);
		$sth->bindParam(':hiv',$hiv);
		$sth->bindParam(':health_problem',$health_problem);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
		}catch(Exeception $e){}
		return true;
	}

	public static function getUserHealthInfo($user_id){
		global $conn;
		$health_info='';
		$sql="SELECT hea_exercise,hea_smoker,hea_pets,hea_food,hea_hiv,hea_problem FROM user_detail WHERE user_id=:user_id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			$health_info = $result[0];
		}catch(Exception $e){}
		return $health_info;
	}

	public static function saveUserHobby($user_id,$sports,$common_int,$movies,$cuisine,$personalities,$books,$music,$desert){
		global $conn;
		$sql="UPDATE user_detail SET hob_sports=:sports,hob_common_int=:common_int,hob_movies=:movies,hob_cuisine=:cuisine,hob_personalities=:personalities,hob_books=:books,hob_music=:music,hob_desert=:desert WHERE user_id=:user_id";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':sports',$sports);
		$sth->bindParam(':common_int',$common_int);
		$sth->bindParam(':movies',$movies);
		$sth->bindParam(':cuisine',$cuisine);
		$sth->bindParam(':personalities',$personalities);
		$sth->bindParam(':books',$books);
		$sth->bindParam(':music',$music);
		$sth->bindParam(':desert',$desert);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
		}catch(Exception $e){}
		return true;
	}

	public static function getUserHobby($user_id){
		global $conn;
		$hobby='';
		$sql="SELECT hob_sports,hob_common_int,hob_movies,hob_cuisine,hob_personalities,hob_books,hob_music,hob_desert FROM user_detail WHERE user_id=:user_id";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
			$result=$sth->fetchAll(PDO::FETCH_ASSOC);
			$hobby=$result[0];
		}catch(Exception $e){}
		return $hobby;
	}


	public static function saveUserFamilyInfo($user_id,$ancest_origin,$community,$sub_community,$mother_tounge,$family_value,$sibling,$father_status,$mother_status){
		global $conn;
		$sql="UPDATE user_detail SET fam_anct_origin=:ancest_origin,fam_community=:community,fam_sub_community=:sub_community,fam_mother_tounge=:mother_tounge,fam_values=:family_value,fam_siblings=:sibling,fam_father=:father_status,fam_mother=:mother_status WHERE user_id=:user_id";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':ancest_origin',$ancest_origin);
		$sth->bindParam(':community',$community);
		$sth->bindParam(':sub_community',$sub_community);
		$sth->bindParam(':mother_tounge',$mother_tounge);
		$sth->bindParam(':family_value',$family_value);
		$sth->bindParam(':sibling',$sibling);
		$sth->bindParam(':father_status',$father_status);
		$sth->bindParam(':mother_status',$mother_status);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
		}catch(Exception $e){}
		return true;
	}

	public static function getUserFamilyInfo($user_id){
		global $conn;
		$family_info='';
		$sql="SELECT ifnull((SELECT ancestral_origin FROM ancestral_origins WHERE ancestral_origins.id=user_detail.fam_anct_origin),'') as fam_anct_origin,ifnull((SELECT community FROM communities WHERE communities.id=user_detail.fam_community),'') as fam_community,ifnull((SELECT sub_community FROM sub_communities WHERE sub_communities.id=user_detail.fam_sub_community),'') as fam_sub_community ,ifnull((SELECT language FROM languages WHERE languages.id=user_detail.fam_mother_tounge),'') as fam_mother_tounge,fam_values,fam_siblings,fam_father,fam_mother FROM user_detail WHERE user_id = :user_id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
			$result=$sth->fetchAll(PDO::FETCH_ASSOC);
			$family_info = $result[0];
		}catch(Exception $e){
			echo $e->getMessage();
		}
		return $family_info;
	}

	public static function saveUserProfile($user_id,$image_path,$about,$image_id){
		global $conn;
		
		if($image_id){
			$sql = "SELECT image FROM gallery WHERE id=:image_id";
			$sth = $conn->prepare($sql);
			$sth->bindParam(':image_id',$image_id);
			try{
				$sth->execute();
				$result = $sth->fetchAll(PDO::FETCH_ASSOC);
				$image_path = $result[0]['image'];
			}catch(Exception $e){}	
		}
		
		$sql = "UPDATE user SET about=:about ";
		if($image_path){
			$sql.=" ,profile_image=:image_path ";
		}
		$sql.=" WHERE id=:user_id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':about',$about);
		$sth->bindParam(':user_id',$user_id);
		if($image_path){
			$sth->bindParam(':image_path',$image_path);
		}
		try{
			$sth->execute();
		}catch(Exception $e){}
		
		
		
		return true;
	}

	public static function getUserProfile($user_id){
		global $conn;
		$profile_info='';
		$sql="SELECT id,nickname,location,about,cover_image,google_id,facebook_id,twitter_id,instagram_id,profile_image,about,phone,email,username,gender,location,(YEAR(NOW()) - YEAR(dob)) as age FROM user WHERE id=:user_id";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
			$result=$sth->fetchAll(PDO::FETCH_ASSOC);
			$profile_info=$result['0'];
		}catch(Exception $e){}
		return $profile_info;
	}

	public static function saveUserReligion($user_id,$sect,$halal,$fasting,$zakat,$salah,$religiousness){
		global $conn;
		$sql="UPDATE user_detail SET rel_sect=:sect,rel_halal=:halal,rel_fasting=:fasting,rel_zakat=:zakat,rel_salah=:salah,rel_religiousness=:religiousness WHERE user_id=:user_id";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':sect',$sect);
		$sth->bindParam(':halal',$halal);
		$sth->bindParam(':fasting',$fasting);
		$sth->bindParam(':zakat',$zakat);
		$sth->bindParam(':salah',$salah);
		$sth->bindParam(':religiousness',$religiousness);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
		}catch(Exeception $e){}
		return true;
	}

	public static function getUserReligion($user_id){
		global $conn;
		$user_religion='';
		$sql="SELECT sects.sect as rel_sect,rel_halal,rel_fasting,rel_zakat,rel_salah,rel_religiousness FROM user_detail JOIN sects ON sects.id=user_detail.rel_sect WHERE user_id=:user_id";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
			$result=$sth->fetchAll(PDO::FETCH_ASSOC);
			$user_religion=$result[0];
		}catch(Exeception $e){}
		return $user_religion;
	}

	public static function saveUserEducation($user_id,$education,$job_title,$income,$industry){
		global $conn;
		$sql="UPDATE user_detail SET edu_education=:education,edu_job_title=:job_title,edu_income=:income,edu_industry=:industry WHERE user_id=:user_id";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':education',$education);
		$sth->bindParam(':job_title',$job_title);
		$sth->bindParam(':income',$income);
		$sth->bindParam(':industry',$industry);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
		}catch(Exeception $e){}
		return true;
	}

	public static function getUserEducation($user_id){
		global $conn;
		$user_edu='';
		$sql="SELECT ifnull((SELECT education FROM educations WHERE educations.id=user_detail.edu_education),'') as education ,ifnull((SELECT job_title FROM jobs WHERE jobs.id=user_detail.edu_job_title),'') as job_title,edu_income,ifnull((SELECT industry FROM industries WHERE industries.id=user_detail.edu_industry),'') as industry FROM user_detail WHERE user_id=:user_id";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
			$result=$sth->fetchAll(PDO::FETCH_ASSOC);
			$user_edu=$result[0];
		}catch(Exeception $e){}
		return $user_edu;
	}

	public static function saveUserLocationInfo($user_id,$current_location,$res_status,$citizenship,$relocation_intention,$living_arrangement){
		global $conn;
		$user_loc='';
		$sql="UPDATE user_detail SET loc_current=:current_location,loc_res_status=:res_status,loc_reloc_intension=:relocation_intention,loc_living_arrange=:living_arrangement,citizenship=:citizenship  WHERE user_id=:user_id";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		$sth->bindParam(':current_location',$current_location);
		$sth->bindParam(':res_status',$res_status);
		$sth->bindParam(':citizenship',$citizenship);
		$sth->bindParam(':relocation_intention',$relocation_intention);
		$sth->bindParam(':living_arrangement',$living_arrangement);
		try{
			$sth->execute();
		}catch(Exeception $e){
		//	echo $e->getMessage();
			}
		return true;
	}
	
	
	public static function getUserLocationInfo($user_id){
		global $conn;
		$user_loc='';
		$sql="SELECT loc_current,loc_res_status,loc_reloc_intension,loc_living_arrange,citizenship FROM user_detail WHERE user_id=:user_id";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
			$result=$sth->fetchAll(PDO::FETCH_ASSOC);
			$user_loc=$result[0];
		}catch(Exeception $e){}
		return $user_loc;
	}

	public static function getUserHobbyAndInterest($user_id){
		global $conn;
		$user_hobby='';
		$sql="SELECT hob_sports,hob_common_int,hob_movies,hob_cuisine,hob_personalities,hob_books,hob_music,hob_desert FROM user_detail WHERE user_id=:user_id";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
			$result=$sth->fetchAll(PDO::FETCH_ASSOC);
			$user_hobby=$result[0];
		}catch(Exeception $e){}
		return $user_hobby;
	}


	public static function verifyPhone($user_id,$code){
		global $conn;
		
		$count=0;
		$sql = "UPDATE phone_verification SET verified='y' WHERE user_id=:user_id AND verification_code=:code";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		$sth->bindParam(':code',$code);
		try{
			$sth->execute();
			$count = $sth->rowCount();
		}catch(Exeception $e){
			//echo $e->getMessage();
		}
		return $count;
		
	}

	public static function getUserSetting($user_id){
		global $conn;
		$setting='';
		$sql="SELECT * FROM user_setting WHERE user_id=:user_id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute;
			$result->fetchAll(PDO::FETCH_ASSOC);
			$setting=$result[0];
		}catch(Exception $e){}
		return $setting;
	}

	public static function excludeUsersFromSearchFor($user_id){
		global $conn;
		$users=array();
		$sql="SELECT user_id2 as uid  FROM blocked_user WHERE user_id2=:user_id
			UNION
			SELECT user_id1 as uid FROM  blocked_user WHERE user_id1=:user_id
			UNION 
			SELECT user_id1 as uid FROM matches WHERE user_id2=:user_id AND status='m'
			UNION
			SELECT user_id2 as uid FROM matches WHERE user_id1=:user_id AND (status='y' OR status='m')";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
			$result=$sth->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $key => $value) {
				$users[]=$value['uid'];
			}
		}catch(Exception $e){}
		return $users;
	}

	public static function getSearchResultForUser($user_id,$gender,$exclude,$location,$id,$min_age,$max_age){
		global $conn;
		$users=array();
		$exclude[]=0;

		$sql =" SELECT U.*,D.fam_anct_origin,D.rel_sect,D.marital_status,D.marriage_plan,D.grew_up,D.lives_in,D.loc_res_status,D.occupation,D.edu_education,(YEAR(NOW())-YEAR(U.dob)) as age,ifnull((SELECT M.status FROM matches M WHERE M.user_id1=U.id AND M.user_id2=:user_id),'') as match_status FROM user U JOIN user_detail D ON U.id=D.user_id JOIN user_setting S ON S.user_id=U.id WHERE U.id NOT IN(".implode(',', $exclude).") AND U.location=:location AND U.gender=:gender AND U.id < :id AND (YEAR(U.dob) < YEAR(NOW()) - :min_age) AND (YEAR(U.dob) > YEAR(NOW()) - :max_age) AND S.profile_hide=0 AND S.profile_disable=0 ORDER BY U.id DESC LIMIT 0,10";
		//echo $sql;die;
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		$sth->bindParam(':gender',$gender);
		$sth->bindParam(':location',$location);
		$sth->bindParam(':id',$id);
		$sth->bindParam(':min_age',$min_age);
		$sth->bindParam(':max_age',$max_age);
		try{
			$sth->execute();
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $key => $value) {
				$users[]=$value;
			}
		}catch(Exception $e){
			echo $e->getMessage();
		}
		return $users;
	}

	public static function getUserGallery($user_id1,$user_id2){
		global $conn;
		$images=array();
		$can_view = false;
		$can_view = $user_id1==$user_id2 ? true : false;

		if(!$can_view){

			if(Users::isMatch($user_id1,$user_id2)){
				$match = true;	
			}

			$pic_setting = Users::getUserPictureSetting($user_id);

			if($pic_setting == 0){
				$can_view = true;
			}elseif($pic_setting == 1 && $match){
				$can_view = true;
			}else{

			}
		}

		if($can_view){
			$images=array();
			$sql="SELECT id,image,is_main FROM gallery WHERE user_id=:user_id AND is_deleted='n'";
			$sth = $conn->prepare($sql);
			$sth->bindParam(':user_id',$user_id2);
			try{
				$sth->execute();
				$result = $sth->fetchAll(PDO::FETCH_ASSOC);
				foreach ($result as $key => $value) {
					$images[]=$value;
				}
			}catch(Exception $e){
				//echo $e->getMessage();
				}

		}
		return $images;
	}

	public static function getUserPictureSetting($user_id){
		global $conn;
		$sql = "SELECT picture_setting FROM user_setting WHERE user_id=:user_id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			$pic_set = $result['picture_setting'];
		}catch(Exception $e){}
		return $pic_set;
	}

	public static function isMatch($user_id1,$user_id2){
		global $conn;
		$isMatch=0;
		$sql = "SELECT count(*) as count FROM matches WHERE user_id1=:user_id1 AND user_id2=:user_id2 AND status='m' ";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id1',$user_id1);
		$sth->bindParam(':user_id2',$user_id2);
		try{
			$sth->execute();
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			$isMatch=$result[0]['count'];
		}catch(Exception $e){}
		return $isMatch;
	}

	public static function saveUserNotificationSetting($user_id,$message,$matches){
		global $conn;
		$sql = "UPDATE user_setting SET notification_message=:message,notification_match=:matches WHERE user_id=:user_id";
		$sth= $conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		$sth->bindParam(':matches',$matches);
		$sth->bindParam(':message',$message);
		try{
			$sth->execute();
		}catch(Exception $e){
			echo $e->getMessage();
		}
		return true;
	}

	public static function getUserNotificationSetting($user_id){
		global $conn;
		$not_set = '';
		$sql = "SELECT notification_message,notification_match FROM user_setting WHERE user_id=:user_id";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			$not_set = $result[0];
		}catch(Exception $e){
			echo $e->getMessage();
		}
		return $not_set;
	}

	public static function saveUserPictureVisibiltySetting($user_id,$value){
		global $conn;
		$sql = "UPDATE user_setting SET picture_setting=:value WHERE user_id=:user_id";
		$sth= $conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		$sth->bindParam(':value',$value);
		try{
			$sth->execute();
		}catch(Exception $e){
			echo $e->getMessage();
		}
		return true;
	}

	public static function getUserPictureVisibiltySetting($user_id){
		global $conn;
		$pic_visibility='';
		$sql = "SELECT picture_setting FROM user_setting WHERE user_id=:user_id";
		$sth= $conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			$pic_visibility = $result[0];
		}catch(Exception $e){
			echo $e->getMessage();
		}
		return $pic_visibility;
	}

	public static function reportUser($user_id1,$user_id2,$reason){
		global $conn;
		$sql=" INSERT INTO reported_user VALUES(DEFAULT,:user_id1,:user_id2,:reason,NOW())";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id1',$user_id1);
		$sth->bindParam(':user_id2',$user_id2);
		$sth->bindParam(':reason',$reason);
		try{
			$sth->execute();
		}catch(Exception $e){}
		return true;
	}	

	public static function spamUser($user_id1,$user_id2){
		global $conn;
		$sql=" INSERT INTO spammed_user VALUES(DEFAULT,:user_id1,:user_id2,NOW())";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id1',$user_id1);
		$sth->bindParam(':user_id2',$user_id2);
		try{
			$sth->execute();
		}catch(Exception $e){}
		return true;
	}	

	public static function blockUser($user_id1,$user_id2){
		global $conn;
		$sql=" INSERT INTO blocked_user VALUES(DEFAULT,:user_id1,:user_id2,NOW())";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id1',$user_id1);
		$sth->bindParam(':user_id2',$user_id2);
		try{
			$sth->execute();
		}catch(Exception $e){}
		return true;
	}

	public static function createDefaultUserDeatailsAndSetting($user_id){
		global $conn;
		$sql="INSERT INTO user_detail (user_id) VALUES(:user_id)";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
		}catch(Exception $e){}
		return true;
	}

	public static function createDefaultUserSetting($user_id){
		global $conn;
		$sql="INSERT INTO user_setting (user_id,gallery_public_view_on,picture_setting,profile_hide,profile_disable,notification_message,notification_match) VALUES(:user_id,1,'0',0,0,1,1)";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
		}catch(Exception $e){}
		return true;
	}

	public static function createDefaultPartnerPref($user_id){
		global $conn;
		$sql="INSERT INTO partner_pref (user_id,age,max_age) VALUES(:user_id,18,25)";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
		}catch(Exception $e){}
		return true;
	}

	public static function getStep2RegisterData($user_id){
		global $conn;
		$profile='';
		$sql="SELECT fam_anct_origin,ancestral_origins.ancestral_origin,rel_sect,sects.sect,marital_status,marriage_plan,grew_up,lives_in,loc_res_status,user_detail.occupation,ifnull
		(occupations.occupation,'') as occupation_name,edu_education,app_height,emp_status,app_body_type FROM user_detail LEFT JOIN ancestral_origins ON ancestral_origins.id=user_detail.fam_anct_origin LEFT JOIN sects ON sects.id=user_detail.rel_sect LEFT JOIN occupations ON occupations.id=user_detail.occupation WHERE user_id=:user_id";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			$profile=$result[0];
		}catch(Exception $e){}
		return $profile;
	}

	public static function setProfileVisibility($user_id,$hide_profile,$disable_profile){
		global $conn;
		$sql = "UPDATE user_setting SET profile_hide=:hide_profile,profile_disable=:disable_profile WHERE user_id=:user_id";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		$sth->bindParam(':hide_profile',$hide_profile);
		$sth->bindParam(':disable_profile',$disable_profile);
		try{
			$sth->execute();
		}catch(Exception $e){}
		return true;
	}

	public static function getProfileVisibility($user_id){
		global $conn;
		$profile_visibility='';
		$sql = "SELECT profile_hide,profile_disable FROM  user_setting  WHERE user_id=:user_id";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			$profile_visibility=$result[0];
		}catch(Exception $e){}
		return $profile_visibility;
	}

	public static function createDefaultIDVerificationSetting($user_id){
		global $conn;
		$sql = "INSERT IGNORE INTO ID_verification(user_id,passport_verified,id_card_verified,license_verified) VALUES(:user_id,'n','n','n')";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
		}catch(Exception $e){}
		return true;
	}
	
	public static function saveImageToGallery($user_id,$image_path,$is_main){
		global $conn;
		
		if($is_main){
			$sql = "UPDATE user SET profile_image=:image WHERE id=:user_id";
			$sth = $conn->prepare($sql);
			$sth->bindParam(':image',$image_path);
			$sth->bindParam(':user_id',$user_id);
			try{
				$sth->execute();
			}catch(Exception $e){}		
		}
		
		$sql = "UPDATE gallery SET is_main='0' WHERE user_id=:user_id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
		}catch(Exception $e){}
		
		$sql = "INSERT INTO gallery(user_id,image,is_deleted,created_on,is_main) VALUES(:user_id,:image,'n',NOW(),:is_main)";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		$sth->bindParam(':image',$image_path);
		$sth->bindParam(':is_main',$is_main);
		try{
			$sth->execute();
		}catch(Exception $e){}
		return true;
	}
	
	public static function setImageMainGallery($user_id,$image_id){
		global $conn;
		
		$sql = "UPDATE gallery SET is_main='1' WHERE id=:image_id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':image_id',$image_id);
		try{
			$sth->execute();	
		}catch(Exception $e){}
		
		$sql = "UPDATE gallery SET is_main='0' WHERE id!=:image_id AND user_id=:user_id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':image_id',$image_id);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();	
		}catch(Exception $e){}
		
		return true;
	}
	
	public static function deleteImageGallery($user_id,$image_id){
		global $conn;
		$sql = "DELETE FROM gallery WHERE id=:image_id AND user_id=:user_id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':image_id',$image_id);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();	
		}catch(Exception $e){
		//	echo $e->getMessage();
			}
		return true;
	}
	
	public static function setFacebookId($user_id,$fb_id){
		global $conn;
		$sql = "UPDATE user SET facebook_id=:fb_id WHERE id=:user_id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':fb_id',$fb_id);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();	
		}catch(Exception $e){
			//echo $e->getMessage();
			}
		return true;
	}
	
	public static function changePassword($user_id,$password){
		global $conn;
		$sql = "UPDATE user SET password=:password WHERE id=:user_id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':password',$password);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();	
		}catch(Exception $e){
			//echo $e->getMessage();
			}
		return true;
	}

}
?>
