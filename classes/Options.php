<?php
class Options{

	public static function getIndustry(){
		global $conn;
		$industry=array();
		$sql= "SELECT id,industry FROM industries WHERE 1 ORDER BY industry";
		$sth= $conn->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$industry[]=$value;
		}
		return $industry;
	}

	public static function getJobTitle(){
		global $conn;
		$title=array();
		$sql= "SELECT id,job_title FROM jobs WHERE 1 ORDER BY job_title";
		$sth= $conn->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$title[]=$value;
		}
		return $title;
	}

	public static function getLanguages(){
		global $conn;
		$language=array();
		$sql= "SELECT id,language FROM languages WHERE 1 ORDER BY language";
		$sth= $conn->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$language[]=$value;
		}
		return $language;
	}

	public static function getOccupation(){
		global $conn;
		$occupation=array();
		$sql= "SELECT id,occupation FROM occupations WHERE 1 ORDER BY id";
		$sth= $conn->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$occupation[]=$value;
		}
		return $occupation;
	}

	public static function getCommunity(){
		global $conn;
		$community=array();
		$sql= "SELECT id,community FROM communities WHERE 1 ORDER BY community";
		$sth= $conn->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$community[]=$value;
		}
		return $community;
	}

	public static function getSubCommunity($community_id){
		global $conn;
		$sub_community=array();
		$sql= "SELECT id,sub_community FROM sub_communities WHERE community_id=:community_id ORDER BY sub_community";
		$sth= $conn->prepare($sql);
		$sth->bindParam(':community_id',$community_id);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$sub_community[]=$value;
		}
		return $sub_community;
	}

	public static function getAncestralOrigin($community_id){
		global $conn;
		$ancestral_origin=array();
		$sql= "SELECT id,ancestral_origin FROM ancestral_origins WHERE 1 ORDER BY ancestral_origin";
		$sth= $conn->prepare($sql);
		$sth->bindParam(':community_id',$community_id);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$ancestral_origin[]=$value;
		}
		return $ancestral_origin;
	}

	public static function getCountry(){
		global $conn;
		$country=array();
		$sql= "SELECT id,country FROM countries WHERE 1 ORDER BY country";
		$sth= $conn->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$country[]=$value;
		}
		return $country;
	}

	public static function getEducation(){
		global $conn;
		$education=array();
		$sql= "SELECT id,education FROM educations WHERE 1 ORDER BY education";
		$sth= $conn->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$education[]=$value;
		}
		return $education;
	}

	public static function getSect(){
		global $conn;
		$sect=array();
		$sql= "SELECT id,sect FROM sects WHERE 1 ORDER BY sect";
		$sth= $conn->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $key => $value) {
			$sect[]=$value;
		}
		return $sect;
	}

}
?>
