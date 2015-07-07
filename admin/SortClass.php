<?php
class SortClass{

	public static function convert_to_csv($input_array, $output_file_name, $delimiter){
    /** open raw memory as file, no need for temp files, be careful not to run out of memory thought */
    $f = fopen('php://memory', 'w');
    /** loop through array  */
    foreach ($input_array as $line) {
        /** default php csv handler **/
        fputcsv($f, $line, $delimiter);
    }
    /** rewrind the "file" with the csv lines **/
    fseek($f, 0);
    /** modify header to be downloadable csv file **/
    header('Content-Type: application/csv');
    header('Content-Disposition: attachement; filename="' . $output_file_name . '";');
    /** Send file to browser for download */
    fpassthru($f);
}


public static function getUsers(){

global $conn;
$sql="SELECT user.*,user_books.*,user_citizenship.*,countries.country, user_cuisines.*,user_desert.*,user_detail.*,industries.industry,educations.education,occupations.occupation,(select occupations.occupation from occupations join partner_pref on partner_pref.occupation=occupations.id where partner_pref.user_id=1) as occ,(select educations.education from educations join partner_pref on partner_pref.education=educations.id  where partner_pref.user_id=1) as edu,(select ancestral_origins.ancestral_origin from ancestral_origins join partner_pref on partner_pref.fam_anct_origin=ancestral_origins.id where partner_pref.user_id=1) as anc_origin, communities.community,sub_communities.sub_community,languages.`language`, jobs.job_title,ancestral_origins.ancestral_origin,partner_pref.rel_sect as p_sect,partner_pref.marital_status as p_marital_status,partner_pref.age as p_age,partner_pref.marriage_plan as p_marriage_plan,partner_pref.grew_up as p_grew_up,partner_pref.lives_in as p_lives_in,partner_pref.local_res_status as p_local_res_status, user_movies.*,user_music.*,user_setting.* FROM `user` left join user_books on user_books.user_id=user.id left join user_citizenship on user_citizenship.user_id=user.id left join user_cuisines on user_cuisines.user_id=user.id left join user_desert on user_desert.user_id=user.id left join user_detail on user_detail.user_id=user.id left join user_movies on user_movies.user_id=user.id left join countries on countries.id=user_citizenship.country_id left join user_music on user_music.user_id=user.id left join user_setting on user_setting.user_id=user.id left join industries on industries.id=user_detail.edu_industry left join educations on educations.id=user_detail.edu_education left join jobs on jobs.id=user_detail.edu_job_title left join ancestral_origins on ancestral_origins.id=user_detail.fam_anct_origin left join communities on communities.id=user_detail.fam_community left join sub_communities on sub_communities.id=user_detail.fam_sub_community left join languages on languages.id=user_detail.fam_mother_tounge left join occupations on occupations.id=user_detail.occupation left join partner_pref on partner_pref.user_id=user.id group by user.id";

	$sth=$conn->prepare($sql);
    try{$sth->execute();}catch(Exception $e){}
    $r=$sth->fetchAll();
    return $r;

}

	public static function getAllCommunities($startpoint,$limit,$sortby){
	global $conn;

    $sql="SELECT communities.*,(SELECT group_concat(sub_communities.id SEPARATOR ',') from sub_communities where sub_communities.community_id=communities.id) as sid,(SELECT group_concat(sub_communities.sub_community SEPARATOR ',') from sub_communities where sub_communities.community_id=communities.id AND sub_communities.is_deleted='n') as sub_community from communities where communities.is_deleted='n'";
    $sth=$conn->prepare($sql);
    try{$sth->execute();}catch(Exception $e){}
    $r=$sth->fetchAll();
		
		
		$orderClause = "ORDER BY communities.community ASC ";
		
		switch ($sortby) {
		  case "1":	//Coupon name
		  
			$orderClause = " GROUP BY communities.id ORDER BY communities.community ASC ";
			
			$sql_with_limit =" $sql $orderClause
			LIMIT {$startpoint}, {$limit}";
			
			$sql_without_limit = "$sql $orderClause ";
			
			break;
		  case "2": //expiry date
			$orderClause = " GROUP BY communities.id ORDER BY communities.community DESC";
			
			$sql_with_limit ="$sql $orderClause
			LIMIT {$startpoint}, {$limit}";
			
			$sql_without_limit = "$sql $orderClause ";
			break;
		 		  	
		  default:
			$orderClause = " GROUP BY communities.id ORDER BY communities.community ASC";
			
			$sql_with_limit ="$sql	$orderClause LIMIT {$startpoint}, {$limit}";
			
			$sql_without_limit = "$sql $orderClause ";
		}
		
		$result = $conn->query($sql_with_limit);	
		$listing = array();
		$resultSet = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC))
		{
			$listing[] = $row;
		}
		$resultSet["listing"] = $listing;
		
		$result = $conn->query($sql_without_limit);	
		$listing = array();
		while($row = $result->fetch(PDO::FETCH_ASSOC))
		{
			$listing[] = $row;
		}
		$resultSet["count"] = count($listing);
		
		return $resultSet;
	}	
	}

?>