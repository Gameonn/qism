<?php
class Messages{

	public static function sendMessage($user_id1,$user_id2,$message){
		global $conn;
		$insertid=0;
		$sql = "INSERT INTO messages VALUES(DEFAULT,:user_id1,:user_id2,:message,'n',NOW())";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id1',$user_id1);
		$sth->bindParam(':user_id2',$user_id2);
		$sth->bindParam(':message',$message);
		try{
			$sth->execute();
			$insertid = $conn->lastInsertId();
		}catch(Exception $e){}
		return $insertid;
	}

	public static function getUserMessages($user_id){
		global $conn;
		$messages=array();
		$sql = "SELECT temp3.* FROM (SELECT temp2.* FROM (SELECT M.id,U.id as uid,M.message,U.profile_image,M.`is_read`,M.created_on FROM messages M JOIN user U ON M.user_id1=U.id WHERE M.user_id2={$user_id}
			UNION 
			SELECT M.id,U.id as uid,M.message,U.profile_image,'y' as is_read,M.created_on FROM messages M JOIN user U ON M.user_id2=U.id WHERE M.user_id1={$user_id}) as temp2 ORDER BY temp2.created_on DESC) as temp3 GROUP BY temp3.uid
		";
		$sth = $conn->prepare($sql);
		try{
			$sth->execute();
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $key=>$value){
				$messages[]=$value;
			}
		}catch(Exception $e){}
		return $messages;
	}

	public static function getUserMessagesAfter($user_id1,$user_id2,$id){
		global $conn;
		$messages=array();
		$sql="SELECT  M.id,U.id as uid,M.message,is_read,M.created_on FROM messages M JOIN user U ON M.user_id1=U.id WHERE M.user_id1=:user_id2 AND M.user_id2=:user_id1 AND M.id > :id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id1',$user_id1);
		$sth->bindParam(':user_id2',$user_id2);
		$sth->bindParam(':id',$id);
		try{
			$sth->execute();
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $key => $value) {
				$messages[]=$value;
			}
		}catch(Exception $e){
			echo $e->getMessage();
		}
		return $messages;
	}

	public static function getUserMessagesBefore($user_id1,$user_id2,$id){
		global $conn;
		$messages=array();
		$sql="SELECT temp.* FROM (SELECT  M.id,U.id as uid,M.message,is_read,M.created_on FROM messages M JOIN user U ON M.user_id1=U.id WHERE M.user_id1=:user_id2 AND M.user_id2=:user_id1 AND M.id < :id ORDER BY M.id DESC LIMIT 0,30) ORDER BY temp.id";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':user_id1',$user_id1);
		$sth->bindParam(':user_id2',$user_id2);
		$sth->bindParam(':id',$id);
		try{
			$sth->execute();
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $key => $value) {
				$messages[]=$value;
			}
		}catch(Exception $e){
			echo $e->getMessage();
		}
		return $messages;
	}

	public static function deleteUserMessage($user_id1,$user_id2){
		global $conn;
		$sql="DELETE from messages WHERE (user_id1=:1 AND user_id2=:2) OR (user_id1=:3 AND user_id2=:4)";
		$sth=$conn->prepare($sql);
		$sth->bindParam(':1',$user_id1);
		$sth->bindParam(':2',$user_id2);
		$sth->bindParam(':3',$user_id2);
		$sth->bindParam(':4',$user_id1);
		try{
			$sth->execute();
		}catch(Exception $e){
			echo $e->getMessage();
		}
		return true;
	}

	

}
?>