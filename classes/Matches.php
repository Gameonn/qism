<?php
class Matches{

	public static function getUserMatches($user_id){
		global $conn;
		$matches = array();
		$sql="SELECT U.id,U.username,U.profile_image,user_detail.lives_in,matches.created_on,(YEAR(DATE(NOW())) - YEAR(DATE(U.dob))) as age,UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(matches.created_on) as time_diff FROM matches JOIN user U ON U.id=matches.user_id2 JOIN user_detail ON U.id=user_detail.user_id WHERE matches.user_id1=:user_id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id',$user_id);
		try{
			$sth->execute();
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $key => $value) {
				
				$diff = $value['time_diff'];
				
				if($diff < 60){
					$response = $diff.' sec ago';
				}elseif($diff < 3600){
					$response = floor($diff / 60).' min ago';	
				}elseif($diff < 86400){
					$response = floor($diff / 3600).' hrs ago';
				}elseif($diff < 2592000){
					$response = floor($diff / 86400).' days ago';
				}elseif($diff < 31104000){
					$response = floor($diff / 2592000).' months ago';
				}else{
					$response = floor($diff / 31104000).' year ago';
				}
				
				$value['created_on']=$response;
				$matches[]=$value;		
			}
		}catch(Exeception $e){
			echo $e->getMessage();
		}
		return $matches;
	}

	public static function removeMatch($user_id,$other_id){
		global $conn;
		$sql = "DELETE FROM matches WHERE (user_id1=:1 AND user_id2=:2) OR (user_id1=:3 AND user_id2=:4)";	
		$sth = $conn->prepare($sql);
		$sth->bindParam(':1',$user_id);
		$sth->bindParam(':2',$other_id);
		$sth->bindParam(':3',$other_id);
		$sth->bindParam(':4',$user_id);
		try{
			$sth->execute();
		}catch(Exception $e){}
		return true;
	}

	public static function actionMatch($user_id1,$user_id2){
		global $conn;
		$sql = "INSERT IGNORE INTO matches VALUES (DEFAULT,:user_id1,:user_id2,'m',NOW())";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id1',$user_id2);
		$sth->bindParam(':user_id2',$user_id1);
		try{
			$sth->execute();
			$success=1;
		}catch(Exception $e){}

		if($success){
			$sql = "UPDATE matches SET staus='m' WHERE user_id1=:user_id1 AND user_id2=:user_id2";
			$sth = $conn->prepare($sql);
			$sth->bindParam(':user_id1',$user_id2);
			$sth->bindParam(':user_id2',$user_id1);
			try{
				$sth->execute();
				return false;
			}catch(Exception $e){}
		}
		
		return true;
	}

	public static function actionYes($user_id1,$user_id2){
		global $conn;
		$sql = "INSERT IGNORE INTO matches VALUES (DEFAULT,:user_id1,:user_id2,'y',NOW())";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id1',$user_id1);
		$sth->bindParam(':user_id2',$user_id2);
		try{
			$sth->execute();
		}catch(Exception $e){
			return false;
		}
		return true;
	}
	
	public static function getMatchStatus($user_id1,$user_id2){
		global $conn;
		$status='';
		$sql = "SELECT ifnull(status,'') as status FROM matches WHERE user_id1=:user_id2 AND user_id2=:user_id1 LIMIT 1";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id1',$user_id1);
		$sth->bindParam(':user_id2',$user_id2);
		try{
			$sth->execute();
			$result=$sth->fetchAll(PDO::FETCH_ASSOC);
			$status=$result[0]['status']?$result[0]['status']:'';
		}catch(Exception $e){}
		return $status;
	}

}
?>
