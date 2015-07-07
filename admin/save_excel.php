<?php
/************************ YOUR DATABASE CONNECTION START HERE   ****************************/
require_once "../phpInclude/db_connection.php";
//error_reporting(E_ALL);

/************************ YOUR DATABASE CONNECTION END HERE  ****************************/
function randomFileNameGenerator($prefix){
        $r=substr(str_replace(".","",uniqid($prefix,true)),0,20);
        if(file_exists("../uploads/$r")) randomFileNameGenerator($prefix);
        else return $r;
      }

//set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
require_once '../Excel_Classes/PHPExcel/IOFactory.php';
require_once '../Excel_Classes/PHPExcel/Calculation/DateTime.php';

// This is the file path to be uploaded.
$uploadedStatus = 0;
$inputFileName = $_FILES['file']['name']; 
if ( isset($_POST["submit"]) ) {
if ( isset($_FILES["file"])) {
//if there was an error uploading the file
if ($_FILES["file"]["error"] > 0) {
echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
}
else {
if (file_exists($_FILES["file"]["name"])) {
unlink($_FILES["file"]["name"]);
}
$storagename =$inputFileName ;
move_uploaded_file($_FILES["file"]["tmp_name"],  $storagename);
$uploadedStatus = 1;
}
}
else{
echo "No file selected <br />";
}
}


try{
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}
$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet

for($i=2;$i<=$arrayCount;$i++){
$username = trim($allDataInSheet[$i]["A"]);
$nickname= trim($allDataInSheet[$i]["B"]);
$email= trim($allDataInSheet[$i]["C"]);
$password= trim($allDataInSheet[$i]["D"]);
$gender= trim($allDataInSheet[$i]["E"]);
$dob= trim($allDataInSheet[$i]["F"]);
$location= trim($allDataInSheet[$i]["G"]);
$phone= trim($allDataInSheet[$i]["H"]);
$about= trim($allDataInSheet[$i]["I"]);
$height= trim($allDataInSheet[$i]["J"]);
$weight= trim($allDataInSheet[$i]["K"]);
$body_type = trim($allDataInSheet[$i]["L"]);
$eyes= trim($allDataInSheet[$i]["M"]);
$hair= trim($allDataInSheet[$i]["N"]);
$education = trim($allDataInSheet[$i]["O"]);
$job_title= trim($allDataInSheet[$i]["P"]);
$income= trim($allDataInSheet[$i]["Q"]);
$industry= trim($allDataInSheet[$i]["R"]);
$sect= trim($allDataInSheet[$i]["S"]);
$halal= trim($allDataInSheet[$i]["T"]);
$fasting= trim($allDataInSheet[$i]["U"]);
$zakat= trim($allDataInSheet[$i]["V"]);
$salah= trim($allDataInSheet[$i]["W"]);
$religiousness= trim($allDataInSheet[$i]["X"]);
$anc_origin= trim($allDataInSheet[$i]["Y"]);
$community= trim($allDataInSheet[$i]["Z"]);
$sub_community= trim($allDataInSheet[$i]["AA"]);
$mother_tongue= trim($allDataInSheet[$i]["AB"]);
$values= trim($allDataInSheet[$i]["AC"]);
$siblings= trim($allDataInSheet[$i]["AD"]);
$father= trim($allDataInSheet[$i]["AE"]);
$mother= trim($allDataInSheet[$i]["AF"]);
$h_p= trim($allDataInSheet[$i]["AG"]);
$h_e= trim($allDataInSheet[$i]["AH"]);
$health_food= trim($allDataInSheet[$i]["AI"]);
$smoker= trim($allDataInSheet[$i]["AJ"]);
$pets= trim($allDataInSheet[$i]["AK"]);
$hiv= trim($allDataInSheet[$i]["AL"]);
$loc_living_arrange= trim($allDataInSheet[$i]["AM"]);
$reloc= trim($allDataInSheet[$i]["AN"]);
$sports= trim($allDataInSheet[$i]["AO"]);
$movies= trim($allDataInSheet[$i]["AP"]);
$cuisines = trim($allDataInSheet[$i]["AQ"]);
$personalities= trim($allDataInSheet[$i]["AR"]);
$books= trim($allDataInSheet[$i]["AS"]);
$music= trim($allDataInSheet[$i]["AT"]);
$desert= trim($allDataInSheet[$i]["AU"]);
$marital_status= trim($allDataInSheet[$i]["AV"]);
$marriage_plan= trim($allDataInSheet[$i]["AW"]);
$grew_up= trim($allDataInSheet[$i]["AX"]);
$res_status= trim($allDataInSheet[$i]["AY"]);
$common_int= trim($allDataInSheet[$i]["AZ"]);
$lives_in = trim($allDataInSheet[$i]["BA"]);
$emp_status= trim($allDataInSheet[$i]["BB"]);
$first_lang= trim($allDataInSheet[$i]["BC"]);
$spoken_lang= trim($allDataInSheet[$i]["BD"]);
$occupation= trim($allDataInSheet[$i]["BE"]);
$country= trim($allDataInSheet[$i]["BF"]);
$profile_image= trim($allDataInSheet[$i]["BG"]);
$cover_image= trim($allDataInSheet[$i]["BH"]);
$passport= trim($allDataInSheet[$i]["BI"]);
$id_card= trim($allDataInSheet[$i]["BJ"]);
$license= trim($allDataInSheet[$i]["BK"]);
$compatibility= trim($allDataInSheet[$i]["BL"]);
$profile_by= trim($allDataInSheet[$i]["BM"]);
$pao= trim($allDataInSheet[$i]["BN"]);
$p_sect= trim($allDataInSheet[$i]["BO"]);
$p_ms= trim($allDataInSheet[$i]["BP"]);
$age= trim($allDataInSheet[$i]["BQ"]);
$max_age= trim($allDataInSheet[$i]["BR"]);
$p_mp= trim($allDataInSheet[$i]["BS"]);
$p_grew_up= trim($allDataInSheet[$i]["BT"]);
$p_lives_in= trim($allDataInSheet[$i]["BU"]);
$p_res= trim($allDataInSheet[$i]["BV"]);
$p_occ= trim($allDataInSheet[$i]["BW"]);
$p_edu= trim($allDataInSheet[$i]["BX"]);

$dob=date('Y-m-d',strtotime($dob));

$sql = "SELECT * FROM user WHERE username=:username or email=:email";
$sth=$conn->prepare($sql);
$sth->bindValue('email',$email);
$sth->bindValue('username',$username);
try{$sth->execute();}
catch(Exception $e){
//echo $e->getMessage();
}
$recResult=$sth->fetchAll();

//if(!count($recResult)) {
if($username){
if($occupation){
$sql = "SELECT id FROM occupations WHERE occupation=:occ";
$sth=$conn->prepare($sql);
$sth->bindValue('occ',$occupation);
try{$sth->execute();}
catch(Exception $e){
//echo $e->getMessage();
}
$occ=$sth->fetchAll();
$oid=$occ[0]['id'];

if(!count($occ)){
$sql="insert into occupations(id,occupation) values(DEFAULT,:occ)";
$sth=$conn->prepare($sql);
$sth->bindValue('occ',$occupation);
try{$sth->execute();
$oid=$conn->lastInsertId();
}
catch(Exception $e){
//echo $e->getMessage();
}
}
}
$oid=$oid?$oid:0;

if($p_occ){ // occupation partner
$sql = "SELECT id FROM occupations WHERE occupation=:occ";
$sth=$conn->prepare($sql);
$sth->bindValue('occ',$p_occ);
try{$sth->execute();}
catch(Exception $e){
//echo $e->getMessage();
}
$occ1=$sth->fetchAll();
$oid1=$occ1[0]['id'];

if(!count($occ1)){
$sql="insert into occupations(id,occupation) values(DEFAULT,:occ)";
$sth=$conn->prepare($sql);
$sth->bindValue('occ',$p_occ);
try{$sth->execute();
$oid1=$conn->lastInsertId();
}
catch(Exception $e){
//echo $e->getMessage();
}
}
}
$oid1=$oid1?$oid1:0;

if($education){
$sql = "SELECT id FROM educations WHERE education=:edu";
$sth=$conn->prepare($sql);
$sth->bindValue('edu',$education);
try{$sth->execute();}
catch(Exception $e){
//echo $e->getMessage();
}
$edu=$sth->fetchAll();
$eid=$edu[0]['id'];

if(!count($edu)){
$sql="insert into educations(id,education) values(DEFAULT,:edu)";
$sth=$conn->prepare($sql);
$sth->bindValue('edu',$education);
try{$sth->execute();
$eid=$conn->lastInsertId();
}
catch(Exception $e){
//echo $e->getMessage();
}
}
}
$eid=$eid?$eid:0;

if($p_edu){ //partner education
$sql = "SELECT id FROM educations WHERE education=:edu";
$sth=$conn->prepare($sql);
$sth->bindValue('edu',$p_edu);
try{$sth->execute();}
catch(Exception $e){
echo $e->getMessage();
}
$edu1=$sth->fetchAll();
$eid1=$edu1[0]['id'];

if(!count($edu)){
$sql="insert into educations(id,education) values(DEFAULT,:edu)";
$sth=$conn->prepare($sql);
$sth->bindValue('edu',$p_edu);
try{$sth->execute();
$eid1=$conn->lastInsertId();
}
catch(Exception $e){
echo $e->getMessage();
}
}
}
$eid1=$eid1?$eid1:0;

if($job_title){
$sql = "SELECT id FROM jobs WHERE job_title=:job_title";
$sth=$conn->prepare($sql);
$sth->bindValue('job_title',$job_title);
try{$sth->execute();}
catch(Exception $e){
echo $e->getMessage();
}
$job=$sth->fetchAll();
$jid=$job[0]['id'];

if(!count($job)){
$sql="insert into jobs(id,job_title) values(DEFAULT,:job)";
$sth=$conn->prepare($sql);
$sth->bindValue('job',$job_title);
try{$sth->execute();
$jid=$conn->lastInsertId();
}
catch(Exception $e){
echo $e->getMessage();
}
}
}
$jid=$jid?$jid:0;

if($mother_tongue){
$sql = "SELECT id FROM languages WHERE language=:language";
$sth=$conn->prepare($sql);
$sth->bindValue('language',$mother_tongue);
try{$sth->execute();}
catch(Exception $e){
echo $e->getMessage();
}
$lan=$sth->fetchAll();
$lid=$lan[0]['id'];

if(!count($lan)){
$sql="insert into languages(id,language) values(DEFAULT,:language)";
$sth=$conn->prepare($sql);
$sth->bindValue('language',$mother_tongue);
try{$sth->execute();
$lid=$conn->lastInsertId();
}
catch(Exception $e){
echo $e->getMessage();
}
}
}
$lid=$lid?$lid:0;

if($industry){
$sql = "SELECT id FROM industries WHERE industry=:industry";
$sth=$conn->prepare($sql);
$sth->bindValue('industry',$industry);
try{$sth->execute();}
catch(Exception $e){
echo $e->getMessage();
}
$indus=$sth->fetchAll();
$industryid=$indus[0]['id'];

if(!count($indus)){
$sql="insert into industries(id,industry) values(DEFAULT,:edu)";
$sth=$conn->prepare($sql);
$sth->bindValue('edu',$industry);
try{$sth->execute();
$industryid=$conn->lastInsertId();
}
catch(Exception $e){
echo $e->getMessage();
}
}
}
$industryid=$industryid?$industryid:0;

if($sect){
$sql = "SELECT id FROM sects WHERE sect=:sect";
$sth=$conn->prepare($sql);
$sth->bindValue('sect',$sect);
try{$sth->execute();}
catch(Exception $e){
echo $e->getMessage();
}
$sec=$sth->fetchAll();
$sid=$sec[0]['id'];

if(!count($sec)){
$sql="insert into sects(id,sect) values(DEFAULT,:sect)";
$sth=$conn->prepare($sql);
$sth->bindValue('sect',$sect);
try{$sth->execute();
$sid=$conn->lastInsertId();
}
catch(Exception $e){
echo $e->getMessage();
}
}
}
$sid=$sid?$sid:0;

if($anc_origin){
$sql = "SELECT id FROM ancestral_origins WHERE ancestral_origin=:ancestral_origin";
$sth=$conn->prepare($sql);
$sth->bindValue('ancestral_origin',$anc_origin);
try{$sth->execute();}
catch(Exception $e){
echo $e->getMessage();
}
$anc=$sth->fetchAll();
$aid=$anc[0]['id'];

if(!count($anc)){
$sql="insert into ancestral_origins(id,ancestral_origin) values(DEFAULT,:anc_origin)";
$sth=$conn->prepare($sql);
$sth->bindValue('anc_origin',$anc_origin);
try{$sth->execute();
$aid=$conn->lastInsertId();
}
catch(Exception $e){
echo $e->getMessage();
}
}
}
$aid=$aid?$aid:0;

if($pao){//fam_anc_origin
$sql = "SELECT id FROM ancestral_origins WHERE ancestral_origin=:ancestral_origin";
$sth=$conn->prepare($sql);
$sth->bindValue('ancestral_origin',$pao);
try{$sth->execute();}
catch(Exception $e){
echo $e->getMessage();
}
$anc1=$sth->fetchAll();
$aid1=$anc1[0]['id'];

if(!count($anc)){
$sql="insert into ancestral_origins(id,ancestral_origin) values(DEFAULT,:anc_origin)";
$sth=$conn->prepare($sql);
$sth->bindValue('anc_origin',$pao);
try{$sth->execute();
$aid1=$conn->lastInsertId();
}
catch(Exception $e){
echo $e->getMessage();
}
}
}
$aid1=$aid1?$aid1:0;

if($community){
$sql = "SELECT id FROM communities WHERE community=:community";
$sth=$conn->prepare($sql);
$sth->bindValue('community',$community);
try{$sth->execute();}
catch(Exception $e){
echo $e->getMessage();
}
$comm=$sth->fetchAll();
$cid=$comm[0]['id'];

if(!count($comm)){
$sql="insert into communities(id,community) values(DEFAULT,:community)";
$sth=$conn->prepare($sql);
$sth->bindValue('community',$community);
try{$sth->execute();
$cid=$conn->lastInsertId();
}
catch(Exception $e){
echo $e->getMessage();
}
}
}
$cid=$cid?$cid:0;

if($sub_community){
$sql = "SELECT id FROM sub_communities WHERE sub_community=:sub_community";
$sth=$conn->prepare($sql);
$sth->bindValue('sub_community',$sub_community);
try{$sth->execute();}
catch(Exception $e){
echo $e->getMessage();
}
$sub=$sth->fetchAll();
$subid=$sub[0]['id'];

if(!count($sub)){
$sql="insert into sub_communities(id,sub_community,community_id) values(DEFAULT,:sub_community,:comm_id)";
$sth=$conn->prepare($sql);
$sth->bindValue('sub_community',$sub_community);
$sth->bindValue('comm_id',$cid);
try{$sth->execute();
$subid=$conn->lastInsertId();
}
catch(Exception $e){
echo $e->getMessage();
}
}
}
$subid=$subid?$subid:0;

		
$sql="insert into user(id,username,nickname,email,password,gender,dob,location,phone,about,profile_image,cover_image,is_imported) values(DEFAULT,:name,:nickname,:email,:password,:gender,:dob,:location,:phone,:about,:profile_image,:cover_image,1)";
$sth=$conn->prepare($sql);
$sth->bindValue('name',$username);
$sth->bindValue('nickname',$nickname);
$sth->bindValue('email',$email);
$sth->bindValue('password',md5($password));
$sth->bindValue('gender',$gender);
$sth->bindValue('dob',$dob);
$sth->bindValue('location',$location);
$sth->bindValue('phone',$phone);
$sth->bindValue('about',$about);
$sth->bindValue('profile_image',$profile_image);
$sth->bindValue('cover_image',$cover_image);

try{$sth->execute();
$uid=$conn->lastInsertId();
}
catch(Exception $e){
echo $e->getMessage();
}

if($passport || $id_card || $license){
		
$sql = "SELECT * FROM ID_verification WHERE user_id=:user_id";
$sth=$conn->prepare($sql);
$sth->bindValue('user_id',$uid);
try{$sth->execute();}
catch(Exception $e){
echo $e->getMessage();
}
$verify=$sth->fetchAll();

if(!count($verify)){
$sql="insert into ID_verification(id,user_id,passport,id_card,license,passport_verified,id_card_verified,license_verified) values(DEFAULT,:user_id,:passport,:id_card,:license,'n','n','n')";
$sth=$conn->prepare($sql);
$sth->bindValue('user_id',$uid);
$sth->bindValue('passport',$passport);
$sth->bindValue('id_card',$id_card);
$sth->bindValue('license',$license);
try{$sth->execute();
}
catch(Exception $e){
echo $e->getMessage();
}
}
else{
$sql="update ID_verification set passport=:passport,id_card=:id_card,license=:license where user_id=:user_id";
$sth=$conn->prepare($sql);
$sth->bindValue('user_id',$uid);
$sth->bindValue('passport',$passport);
$sth->bindValue('id_card',$id_card);
$sth->bindValue('license',$license);
try{$sth->execute();
}
catch(Exception $e){
echo $e->getMessage();
}
}
}

$sql = "SELECT * FROM user_setting WHERE user_id=:user_id";
$sth=$conn->prepare($sql);
$sth->bindValue('user_id',$uid);
try{$sth->execute();}
catch(Exception $e){
echo $e->getMessage();
}
$u_setting=$sth->fetchAll();

if(!count($u_setting)){
$sql="insert into user_setting(id,user_id,gallery_public_view_on,picture_setting,profile_hide,profile_disable,notification_message,notification_match) values(DEFAULT,:user_id,1,1,0,0,1,1)";
$sth=$conn->prepare($sql);
$sth->bindValue('user_id',$uid);
try{$sth->execute();
}
catch(Exception $e){
echo $e->getMessage();
}
}

$sql="insert into user_detail(id,user_id,app_height,app_weight,app_body_type,app_eyes,app_hair,edu_education,edu_job_title,edu_income,edu_industry,rel_sect,rel_halal,rel_fasting,rel_zakat,rel_salah,rel_religiousness,fam_anct_origin,fam_community,fam_sub_community,fam_mother_tounge,fam_values,fam_siblings,fam_father,fam_mother,hea_problem,hea_exercise,hea_smoker,hea_pets,hea_food,hea_hiv,loc_current,loc_living_arrange,loc_res_status,loc_reloc_intension,hob_sports,hob_common_int,hob_movies,hob_cuisine,hob_personalities,hob_books,hob_music,hob_desert,marital_status,grew_up,marriage_plan,lives_in,emp_status,first_lang,spoken_lang,profile_by,occupation,compatibility,citizenship) values(DEFAULT,:user_id,:height,:weight,:body_type,:eyes,:hair,:education,:job_title,:income,:industry,:rel_sect,:rel_halal,:rel_fasting,:rel_zakat,:rel_salah,:rel_religiousness,:fam_anct_origin,:fam_community,:fam_sub_community,:fam_mother_tongue,:fam_values,:fam_siblings,:fam_father,:fam_mother,:hea_problem,:hea_exercise,:hea_smoker,:hea_pets,:hea_food,:hea_hiv,:loc_current,:loc_living_arrange,:loc_res_status,:loc_reloc_intention,:hob_sports,:hob_common_int,:hob_movies,:hob_cuisine,:hob_personalities,:hob_books,:hob_music,:hob_desert,:marital_status,:grew_up,:marriage_plan,:lives_in,:emp_status,:first_lang,:spoken_lang,:profile_by,:occupation,:compatibility,:citizenship)";
$sth=$conn->prepare($sql);
$sth->bindValue('user_id',$uid);
$sth->bindValue('height',$height);
$sth->bindValue('weight',$weight);
$sth->bindValue('body_type',$body_type);
$sth->bindValue('eyes',$eyes);
$sth->bindValue('hair',$hair);
$sth->bindValue('education',$eid);
$sth->bindValue('job_title',$jid);
$sth->bindValue('income',$income);
$sth->bindValue('industry',$industryid);
$sth->bindValue('body_type',$body_type);
$sth->bindValue('rel_sect',$sid);
$sth->bindValue('rel_halal',$halal);
$sth->bindValue('rel_fasting',$fasting);
$sth->bindValue('rel_zakat',$zakat);
$sth->bindValue('rel_salah',$salah);
$sth->bindValue('loc_living_arrange',$loc_living_arrange);
$sth->bindValue('rel_religiousness',$religiousness);
$sth->bindValue('fam_anct_origin',$aid);
$sth->bindValue('fam_community',$cid);
$sth->bindValue('fam_sub_community',$subid);
$sth->bindValue('fam_mother_tongue',$lid);
$sth->bindValue('fam_values',$values);
$sth->bindValue('fam_siblings',$siblings);
$sth->bindValue('fam_father',$father);
$sth->bindValue('fam_mother',$mother);
$sth->bindValue('hea_problem',$h_p);
$sth->bindValue('hea_exercise',$h_e);
$sth->bindValue('hea_smoker',$smoker);
$sth->bindValue('hea_pets',$pets);
$sth->bindValue('hea_food',$health_food);
$sth->bindValue('hea_hiv',$hiv);
$sth->bindValue('loc_current',$location);
$sth->bindValue('loc_res_status',$res_status);
$sth->bindValue('loc_reloc_intention',$reloc);
$sth->bindValue('hob_sports',$sports);
$sth->bindValue('hob_common_int',$common_int);
$sth->bindValue('hob_movies',$movies);
$sth->bindValue('hob_cuisine',$cuisines);
$sth->bindValue('hob_personalities',$personalities);
$sth->bindValue('hob_books',$books);
$sth->bindValue('hob_music',$music);
$sth->bindValue('hob_desert',$desert);
$sth->bindValue('marital_status',$marital_status);
$sth->bindValue('marriage_plan',$marriage_plan);
$sth->bindValue('grew_up',$grew_up);
$sth->bindValue('lives_in',$lives_in);
$sth->bindValue('emp_status',$emp_status);
$sth->bindValue('first_lang',$first_lang);
$sth->bindValue('spoken_lang',$spoken_lang);
$sth->bindValue('profile_by',$profile_by);
$sth->bindValue('compatibility',$compatibility);
$sth->bindValue('occupation',$oid);
$sth->bindValue('citizenship',$country);
try{$sth->execute();
}
catch(Exception $e){
echo $e->getMessage();
}


$sql="insert into partner_pref(id,user_id,fam_anct_origin,rel_sect,marital_status,age,max_age,marriage_plan,grew_up,lives_in,local_res_status,occupation,education) values(DEFAULT,:user_id,:pao,:p_sect,:p_ms,:age,:max_age,:p_mp,:p_grew_up,:p_lives_in,:p_res,:p_occ,:p_edu)";
$sth=$conn->prepare($sql);
$sth->bindValue('user_id',$uid);
$sth->bindValue('pao',$aid1);
$sth->bindValue('p_sect',$p_sect);
$sth->bindValue('age',$age);
$sth->bindValue('max_age',$max_age);
$sth->bindValue('p_mp',$p_mp);
$sth->bindValue('p_grew_up',$p_grew_up);
$sth->bindValue('p_lives_in',$p_lives_in);
$sth->bindValue('p_res',$p_res);
$sth->bindValue('p_occ',$oid1);
$sth->bindValue('p_edu',$eid1);
$sth->bindValue('p_ms',$p_ms);
try{$sth->execute();
}
catch(Exception $e){
echo $e->getMessage();
}

$success=1;
$msg = 'Record has been added';
}
 /*else {
$success=0;
$msg = 'Record already exist';
}*/
}
header("Location: users.php?success=$success&msg=$msg");

?>