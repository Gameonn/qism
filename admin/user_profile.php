<?php require_once("../phpInclude/db_connection.php"); 

$sth=$conn->prepare("select * from user order by username");
try{$sth->execute();}
catch(Exception $e){
echo $e->getMessage();
}
$res=$sth->fetchAll(PDO::FETCH_ASSOC);

$user_id=$_REQUEST['uid'];
$sql="SELECT user.*,user_books.*,user_citizenship.*,countries.country, user_cuisines.*,user_desert.*,user_detail.*,industries.industry,educations.education,occupations.occupation,(select occupations.occupation from occupations join partner_pref on partner_pref.occupation=occupations.id where partner_pref.user_id=1) as occ,(select educations.education from educations join partner_pref on partner_pref.education=educations.id  where partner_pref.user_id=1) as edu,(select ancestral_origins.ancestral_origin from ancestral_origins join partner_pref on partner_pref.fam_anct_origin=ancestral_origins.id where partner_pref.user_id=1) as anc_origin, communities.community,sub_communities.sub_community,languages.`language`, jobs.job_title,ancestral_origins.ancestral_origin,partner_pref.rel_sect as p_sect,partner_pref.marital_status as p_marital_status,partner_pref.age as p_age,partner_pref.marriage_plan as p_marriage_plan,partner_pref.grew_up as p_grew_up,partner_pref.lives_in as p_lives_in,partner_pref.local_res_status as p_local_res_status, user_movies.*,user_music.*,user_setting.* FROM `user` left join user_books on user_books.user_id=user.id left join user_citizenship on user_citizenship.user_id=user.id left join user_cuisines on user_cuisines.user_id=user.id left join user_desert on user_desert.user_id=user.id left join user_detail on user_detail.user_id=user.id left join user_movies on user_movies.user_id=user.id left join countries on countries.id=user_citizenship.country_id left join user_music on user_music.user_id=user.id left join user_setting on user_setting.user_id=user.id left join industries on industries.id=user_detail.edu_industry left join educations on educations.id=user_detail.edu_education left join jobs on jobs.id=user_detail.edu_job_title left join ancestral_origins on ancestral_origins.id=user_detail.fam_anct_origin left join communities on communities.id=user_detail.fam_community left join sub_communities on sub_communities.id=user_detail.fam_sub_community left join languages on languages.id=user_detail.fam_mother_tounge left join occupations on occupations.id=user_detail.occupation left join partner_pref on partner_pref.user_id=user.id where user.id=:user_id group by user.id";
$sth=$conn->prepare($sql);
$sth->bindValue('user_id',$user_id);
try{$sth->execute();}
catch(Exception $e){echo $e->getMessage();}
$result=$sth->fetchAll(PDO::FETCH_ASSOC);

$sth=$conn->prepare("select gallery.image from gallery where user_id=:user_id and is_deleted='n' ");
$sth->bindValue('user_id',$user_id);
try{$sth->execute();}
catch(Exception $e){echo $e->getMessage();}
$gallery=$sth->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
  <body>
<style>
#profile-01 {
background: #2f2f2f!important;
min-height:200px!important;
}
.pn_l{
padding:20px;
}
.pn_r{
height: 440px;
}
.pn_n{
height: 460px;
}
.mtx{
margin-bottom:25px;
}
</style>
  <section id="container" >
  <?php require_once("header.php"); ?>
<?php require_once("sidebar.php"); ?>  
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
		  
		<h3> <img src="../uploads/<?php if($result[0]['profile_image']) echo $result[0]['profile_image']; else echo 'fr-06.jpg';?>" class="img-circle" width="100" height="100"/> User Profile</h3>
		


  <ul class="nav nav-pills">
  <li role="presentation" class="active"><a href="#about" data-toggle="pill">About</a></li>
  <li role="presentation"><a href="#details" data-toggle="pill">Details</a></li>
    <li role="presentation"><a href="#gallery" data-toggle="pill">Gallery</a></li>
  </ul>

	<div class="tab-content">
		<div class="tab-pane active" id ="about">
		<div class="row mt mb">
                  <div class="col-md-12">
                      <section class="task-panel tasks-widget">
	                	<div class="panel-heading">
	                        <div class="pull-left"><h5><i class="fa fa-user"></i> Profile posted by <?php echo $result[0]['profile_by']; ?> </h5></div>
	                        <br>
	                 	</div>
                          <div class="panel-body">
                              <div class="task-content">
							<p><?php if($result[0]['about']) echo $result[0]['about']; ?></p> 
							</div>
                          <span class="badge bg-theme"><i class="fa fa-facebook"></i> <i class="fa fa-check"></i></span>
                          <span class="badge bg-danger"><i class="fa fa-google-plus"></i> <i class="fa fa-check"></i></span>  
                          <span class="badge bg-theme"><i class="fa fa-twitter"></i> <i class="fa fa-check"></i></span> 
                          <span class="badge bg-warning"><i class="fa fa-instagram"></i> <i class="fa fa-check"></i></span>
                          </div>
                      </section>
                  </div>
		
		
              <div class="mt mb">
                  <div class="col-md-6">
                      <section class="task-panel tasks-widget pn_l">
	                	<div class="panel-heading">
	                        <div class="pull-left"><h5><i class="fa fa-tasks"></i> Basic Information </h5></div>
	                        <br>
	                 	</div>
                          <div class="panel-body">
                              <div class="task-content">
                                  <ul id="sortable" class="task-list ui-sortable">
                                      <li class="list-primary">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Email</span>
                                            <div class="pull-right hidden-phone">
                                          <?php if($result[0]['email']) echo $result[0]['email']; else echo 'N/A';?>
                                              </div>    
                                          </div>
                                      </li>

                                      <li class="list-danger">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">First Name</span>
                                             <div class="pull-right hidden-phone">
                                          <?php if($result[0]['firstname']) echo $result[0]['firstname']; else echo 'N/A';?>
                                              </div>
                                          </div>
                                      </li>
									   <li class="list-danger">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Last Name</span>
                                             <div class="pull-right hidden-phone">
                                          <?php if($result[0]['lastname']) echo $result[0]['lastname']; else echo 'N/A';?>
                                              </div>
                                          </div>
                                      </li>
									  
									  <li class="list-primary">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp"> Gender</span>
                                          <div class="pull-right hidden-phone">
                                           <?php if($result[0]['gender']=='m')
										   $gender='Male';
										   elseif($result[0]['gender']=='f')
										   $gender='Female';
											else
											$gender='N/A';
											
										   echo $gender; ?>
                                              </div>   
                                          </div>
                                      </li>
                                      <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Marital status</span>
                                           <div class="pull-right hidden-phone">
                                           <?php if($result[0]['marital_status']) echo $result[0]['marital_status']; else echo 'N/A';?>
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Age</span>
                                           <div class="pull-right hidden-phone">
                                         <?php
                                         //if($result[0]['dob']==0000-00-00) $age='N/A';
                                         $age = (int)((time()- strtotime ($result[0]['dob'])) /(3600 * 24 * 365));
                                         
                                         if($age) echo $age; else echo 'N/A';
                                           ?>
                                              </div>   
                                          </div>
                                      </li>
                                      <li class="list-info">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Planing to get married when</span>
                                          <div class="pull-right hidden-phone">
                                           <?php if($result[0]['marriage_plan']) echo $result[0]['marriage_plan']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
									  <li class="list-primary">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Grew up in</span>
                                          <div class="pull-right hidden-phone">
                                           <?php if($result[0]['grew_up']) echo $result[0]['grew_up']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
									  <li class="list-danger">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp"> Lives in</span>
                                          <div class="pull-right hidden-phone">
                                          <?php if($result[0]['lives_in']) echo $result[0]['lives_in']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
									  <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp"> Residency status</span>
                                          <div class="pull-right hidden-phone">
                                          <?php if($result[0]['loc_res_status']) echo $result[0]['loc_res_status']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
									  <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp"> Occupation</span>
                                          <div class="pull-right hidden-phone">
                                          <?php if($result[0]['occupation']) echo $result[0]['occupation']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
									  <li class="list-info">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp"> Education</span>
                                          <div class="pull-right hidden-phone">
                                          <?php if($result[0]['education']) echo $result[0]['education']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
					<!-- <li class="list-primary">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp"> Compatibility</span>
                                          <div class="pull-right hidden-phone">
                                          ABC
                                              </div>   
                                          </div>
                                      </li> -->
									  

                                  </ul>
                              </div>
                             
                          </div>
                      </section>
                  </div><!--/col-md-4 -->



                  <div class="col-md-6">
                      <section class="task-panel tasks-widget pn_l">
                    <div class="panel-heading">
                          <div class="pull-left"><h5><i class="fa fa-tasks"></i> Partners Preferences </h5></div>
                          <br>
                    </div>
                          <div class="panel-body">
                              <div class="task-content">
                                  <ul id="sortable" class="task-list ui-sortable">
                                    <li class="list-primary">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Ethnic origin</span>
                                            <div class="pull-right hidden-phone">
                                          <?php if($result[0]['anc_origin']) echo $result[0]['anc_origin']; else echo 'N/A';?>
                                              </div>    
                                          </div>
                                      </li>

                                      <li class="list-danger">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Sect</span>
                                             <div class="pull-right hidden-phone">
                                          <?php if($result[0]['p_sect']) echo $result[0]['p_sect']; else echo 'N/A';?>
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Marital status</span>
                                           <div class="pull-right hidden-phone">
                                          <?php if($result[0]['p_marital_status']) echo $result[0]['p_marital_status']; else echo 'N/A';?>
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Age</span>
                                           <div class="pull-right hidden-phone">
                                          <?php if($result[0]['p_age']) echo $result[0]['p_age']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
                                      <li class="list-info">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Planing to get married when</span>
                                          <div class="pull-right hidden-phone">
                                          <?php if($result[0]['p_marriage_plan']) echo $result[0]['p_marriage_plan']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
									  <li class="list-primary">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Grew up in</span>
                                          <div class="pull-right hidden-phone">
                                          <?php if($result[0]['p_grew_up']) echo $result[0]['p_grew_up']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
									  <li class="list-danger">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp"> Lives in</span>
                                          <div class="pull-right hidden-phone">
                                          <?php if($result[0]['p_lives_in']) echo $result[0]['p_lives_in']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
									  <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp"> Residency status</span>
                                          <div class="pull-right hidden-phone">
                                          <?php if($result[0]['p_local_res_status']) echo $result[0]['p_local_res_status']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
									  <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp"> Occupation</span>
                                          <div class="pull-right hidden-phone">
                                          <?php if($result[0]['occ']) echo $result[0]['occ']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
									  <li class="list-info">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp"> Education</span>
                                          <div class="pull-right hidden-phone">
                                          <?php if($result[0]['edu']) echo $result[0]['edu']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>  
                                  </ul>
                              </div>
                             
                          </div>
                      </section>
                  </div><!--/col-md-4 -->

				  
			</div>
		</div>		
	</div>
			
			 <div class="tab-pane" id="details">
		
              <div class="row mt mb" >
                  <div class="col-md-4">
                      <section class="task-panel tasks-widget pn_1">
	                	<div class="panel-heading">
	                        <div class="pull-left"><h5><i class="fa fa-tasks"></i> Appearance</h5></div>
	                        <br>
	                 	</div>
                          <div class="panel-body">
                              <div class="task-content">
                                  <ul id="sortable" class="task-list ui-sortable">
                                      <li class="list-primary">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Height</span>
                                            <div class="pull-right hidden-phone">
                                          <?php if($result[0]['app_height']) echo $result[0]['app_height']; else echo 'N/A';?>
                                              </div>    
                                          </div>
                                      </li>

                                      <li class="list-danger">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Weight</span>
                                             <div class="pull-right hidden-phone">
                                         <?php if($result[0]['app_weight']) echo $result[0]['app_weight']; else echo 'N/A';?>
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Body Type</span>
                                           <div class="pull-right hidden-phone">
                                          <?php if($result[0]['app_body_type']) echo $result[0]['app_body_type']; else echo 'N/A';?>
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Eyes</span>
                                           <div class="pull-right hidden-phone">
                                          <?php if($result[0]['eyes']) echo $result[0]['eyes']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
                                      <li class="list-info">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Hair</span>
                                          <div class="pull-right hidden-phone">
                                          <?php if($result[0]['hair']) echo $result[0]['hair']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>

                                  </ul>
                              </div>
                             
                          </div>
                      </section>
                  </div><!--/col-md-4 -->

                
				      <div class="col-md-4">
                      <section class="task-panel tasks-widget pn_1">
	                	<div class="panel-heading">
	                        <div class="pull-left"><h5><i class="fa fa-tasks"></i> Education and Career</h5></div>
	                        <br>
	                 	</div>
                          <div class="panel-body">
                              <div class="task-content">
                                  <ul id="sortable" class="task-list ui-sortable">
                                      <li class="list-primary">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Education</span>
                                            <div class="pull-right hidden-phone">
                                          <?php if($result[0]['education']) echo $result[0]['education']; else echo 'N/A';?>
                                              </div>    
                                          </div>
                                      </li>

                                      <li class="list-danger">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Job Title</span>
                                             <div class="pull-right hidden-phone">
                                          <?php if($result[0]['job_title']) echo $result[0]['job_title']; else echo 'N/A';?>
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Income</span>
                                           <div class="pull-right hidden-phone">
                                          <?php if($result[0]['edu_income']) echo $result[0]['edu_income']; else echo 'N/A';?>
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Industry</span>
                                           <div class="pull-right hidden-phone">
                                          <?php if($result[0]['industry']) echo $result[0]['industry']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>

                                  </ul>
                              </div>
                             
                          </div>
                      </section>
                  </div><!--/col-md-4 -->
                           

					<div class="col-md-4">
                      <section class="task-panel tasks-widget pn_1">
                    <div class="panel-heading">
                          <div class="pull-left"><h5><i class="fa fa-tasks"></i> Location & Residence</h5></div>
                          <br>
                    </div>
                          <div class="panel-body">
                              <div class="task-content">
                                  <ul id="sortable" class="task-list ui-sortable">
                                      <li class="list-primary">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Current Location</span>
                                            <div class="pull-right hidden-phone">
                                          <?php if($result[0]['loc_current']) echo $result[0]['loc_current']; else echo 'N/A';?>
                                              </div>    
                                          </div>
                                      </li>

                                      <li class="list-danger">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Residency Status</span>
                                             <div class="pull-right hidden-phone">
                                          <?php if($result[0]['loc_res_status']) echo $result[0]['loc_res_status']; else echo 'N/A';?>
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Citizenship</span>
                                           <div class="pull-right hidden-phone">
                                          <?php if($result[0]['country']) echo $result[0]['country']; else echo 'N/A';?>
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Relocation Intention</span>
                                           <div class="pull-right hidden-phone">
                                          <?php if($result[0]['loc_reloc_intention']) echo $result[0]['loc_reloc_intention']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
                                      <li class="list-info">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Living Arrangements</span>
                                          <div class="pull-right hidden-phone">
                                          <?php if($result[0]['loc_living_arrange']) echo $result[0]['loc_living_arrange']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>

                                  </ul>
                              </div>
                             
                          </div>
                      </section>
                  </div><!--/col-md-4 -->				
				  
              </div><!-- /row -->



              <div class="row mt mb">
			  
						
						  <div class="col-md-6">
                      <section class="task-panel tasks-widget pn_r">
                    <div class="panel-heading">
                          <div class="pull-left"><h5><i class="fa fa-tasks"></i>Health & Lifestyle</h5></div>
                          <br>
                    </div>
                          <div class="panel-body">
                              <div class="task-content">
                                  <ul id="sortable" class="task-list ui-sortable">
                                      <li class="list-primary">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Exercise Habbits</span>
                                            <div class="pull-right hidden-phone">
                                          <?php if($result[0]['hea_exercise']) echo $result[0]['hea_exercise']; else echo 'N/A';?>
                                              </div>    
                                          </div>
                                      </li>

                                      <li class="list-danger">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Smoker</span>
                                             <div class="pull-right hidden-phone">
                                          <?php if($result[0]['hea_smoker']) echo $result[0]['hea_smoker']; else echo 'N/A';?>
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Pets</span>
                                           <div class="pull-right hidden-phone">
                                          <?php if($result[0]['hea_pets']) echo $result[0]['hea_pets']; else echo 'N/A';?>
                                              </div>
                                          </div>
                                      </li>
									    <li class="list-primary">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Disability</span>
                                            <div class="pull-right hidden-phone">
                                          <?php if($result[0]['disability']) echo $result[0]['disability']; else echo 'N/A';?>
                                              </div>    
                                          </div>
                                      </li>
                                      <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Food Choice</span>
                                           <div class="pull-right hidden-phone">
                                          <?php if($result[0]['hea_food']) echo $result[0]['hea_food']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
                                      <li class="list-info">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">HIV</span>
                                          <div class="pull-right hidden-phone">
                                          <?php if($result[0]['hea_hiv']) echo $result[0]['hea_hiv']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
                                         <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Health Problems</span>
                                           <div class="pull-right hidden-phone">
                                          <?php if($result[0]['hea_problem']) echo $result[0]['hea_problem']; else echo 'N/A';?>
                                              </div>
                                          </div>
                                      </li>

                                  </ul>
                              </div>
                             
                          </div>
                      </section>
                  </div><!--/col-md-4 -->
			  
                   
						  <div class="col-md-6">
                      <section class="task-panel tasks-widget pn_r">
                    <div class="panel-heading">
                          <div class="pull-left"><h5><i class="fa fa-tasks"></i> Religious</h5></div>
                          <br>
                    </div>
                          <div class="panel-body">
                              <div class="task-content">
                                  <ul id="sortable" class="task-list ui-sortable">
                                      <li class="list-primary">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Sect</span>
                                            <div class="pull-right hidden-phone">
                                          <?php if($result[0]['rel_sect']) echo $result[0]['rel_sect']; else echo 'N/A';?>
                                              </div>    
                                          </div>
                                      </li>

                                      <li class="list-danger">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Halal</span>
                                             <div class="pull-right hidden-phone">
                                          <?php if($result[0]['rel_halal']) echo $result[0]['rel_halal']; else echo 'N/A';?>
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Zakat</span>
                                           <div class="pull-right hidden-phone">
                                          <?php if($result[0]['rel_zakat']) echo $result[0]['rel_zakat']; else echo 'N/A';?>
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Fasting</span>
                                           <div class="pull-right hidden-phone">
                                          <?php if($result[0]['rel_fasting']) echo $result[0]['rel_fasting']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
                                      <li class="list-info">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Religiousness</span>
                                          <div class="pull-right hidden-phone">
                                          <?php if($result[0]['rel_religiousness']) echo $result[0]['rel_religiousness']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
                                      <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Salah</span>
                                           <div class="pull-right hidden-phone">
                                          <?php if($result[0]['rel_salah']) echo $result[0]['rel_salah']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
                                  </ul>
                              </div>
                             
                          </div>
                      </section>
                  </div><!--/col-md-4 -->

              </div><!-- /row -->
                  
			<div class="row mt mb">

			
			
			<div class="col-md-6">
                      <section class="task-panel tasks-widget pn_n">
                    <div class="panel-heading">
                          <div class="pull-left"><h5><i class="fa fa-tasks"></i> Family</h5></div>
                          <br>
                    </div>
                          <div class="panel-body">
                              <div class="task-content">
                                  <ul id="sortable" class="task-list ui-sortable">
                                      <li class="list-primary">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Ancestral Origin</span>
                                            <div class="pull-right hidden-phone">
                                           <?php if($result[0]['ancestral_origin']) echo $result[0]['ancestral_origin']; else echo 'N/A';?>
                                              </div>    
                                          </div>
                                      </li>

                                      <li class="list-danger">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Community/Caste/Tribe</span>
                                             <div class="pull-right hidden-phone">
                                            <?php if($result[0]['community']) echo $result[0]['community']; else echo 'N/A';?>
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Sub Community</span>
                                           <div class="pull-right hidden-phone">
                                            <?php if($result[0]['sub_community']) echo $result[0]['sub_community']; else echo 'N/A';?>
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Mother Tongue</span>
                                           <div class="pull-right hidden-phone">
                                            <?php if($result[0]['ancestral_origin']) echo $result[0]['ancestral_origin']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
                                      <li class="list-info">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Family Values</span>
                                          <div class="pull-right hidden-phone">
                                          <?php if($result[0]['fam_values']) echo $result[0]['fam_values']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
                                      <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Number of Siblings</span>
                                           <div class="pull-right hidden-phone">
                                          <?php if($result[0]['fam_siblings']) echo $result[0]['fam_siblings']; else echo 'N/A';?>
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Father Status</span>
                                           <div class="pull-right hidden-phone">
                                          <?php if($result[0]['fam_father']) echo $result[0]['fam_father']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
                                     <li class="list-info">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Mother Status</span>
                                          <div class="pull-right hidden-phone">
                                          <?php if($result[0]['fam_mother']) echo $result[0]['fam_mother']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li> 
                                  </ul>
                              </div>
                             
                          </div>
                      </section>
                  </div><!--/col-md-4 -->
  
  
				
				   <div class="col-md-6">
                      <section class="task-panel tasks-widget pn_n">
                    <div class="panel-heading">
                          <div class="pull-left"><h5><i class="fa fa-tasks"></i>Hobbies, Interests & More</h5></div>
                          <br>
                    </div>
                          <div class="panel-body">
                              <div class="task-content">
                                  <ul id="sortable" class="task-list ui-sortable">
                                      <li class="list-primary">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Sports</span>
                                            <div class="pull-right hidden-phone">
                                          <?php if($result[0]['hob_sports']) echo $result[0]['hob_sports']; else echo 'N/A';?>
                                              </div>    
                                          </div>
                                      </li>

                                      <li class="list-danger">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Interests/Hobbies</span>
                                             <div class="pull-right hidden-phone">
                                          <?php if($result[0]['hob_common_int']) echo $result[0]['hob_common_int']; else echo 'N/A';?>
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Favourite Movies</span>
                                           <div class="pull-right hidden-phone">
                                         <?php if($result[0]['hob_movie']) echo $result[0]['hob_movie']; else echo 'N/A';?>
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Favourite Cuisine</span>
                                           <div class="pull-right hidden-phone">
                                          <?php if($result[0]['hob_cuisine']) echo $result[0]['hob_cuisine']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
                                      <li class="list-info">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Favourite Personalities</span>
                                          <div class="pull-right hidden-phone">
                                          <?php if($result[0]['hob_personalities']) echo $result[0]['hob_personalities']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
                                         <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Favourite Books</span>
                                           <div class="pull-right hidden-phone">
                                          <?php if($result[0]['hob_books']) echo $result[0]['hob_books']; else echo 'N/A';?>
                                              </div>
                                          </div>
                                      </li>
                                            <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Favourite Music</span>
                                           <div class="pull-right hidden-phone">
                                          <?php if($result[0]['hob_music']) echo $result[0]['hob_music']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
                                      <li class="list-info">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Favourite Dessert</span>
                                          <div class="pull-right hidden-phone">
                                          <?php if($result[0]['hob_desert']) echo $result[0]['hob_desert']; else echo 'N/A';?>
                                              </div>   
                                          </div>
                                      </li>
                                  </ul>
                              </div>
                             
                          </div>
                      </section>
                  </div><!--/col-md-4 -->
			
			</div>
			</div>
			
			<div class="tab-pane" id="gallery">
			<div class="row mt">
			
			<?php 
			if($gallery){
			foreach($gallery as $row){ ?>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 desc mb">
						<div class="project-wrapper">
		                    <div class="project">
		                        <div class="photo-wrapper">
		                            <div class="photo">
		                            	<a class="fancybox" href="../uploads/<?php echo $row['image']; ?>"><img class="img-responsive" src="../uploads/<?php echo $row['image']; ?>" alt=""></a>
		                            </div>
		                            <div class="overlay"></div>
		                        </div>
		                    </div>
		                </div>
					</div><!-- col-lg-4 -->
					<?php }}
							else{?>
						 <div class="col-md-4 col-md-offset-4">
					  <div class="twitter-panel pn">
						<img src="../uploads/pagenotfound.jpg" style="padding-top: 10px;width: 200px;height:200px;">
						<h3>GALLERY EMPTY</h3>
                
					</div>
					</div>
					<?php } ?>
				</div><!-- /row -->
				</div>
				
			</div>
      </section>
</section>
      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              QISMA
              <a href="users.php#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>


    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/jquery-1.8.3.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../assets/js/jquery.scrollTo.min.js"></script>
    <script src="../assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <!--common script for all pages-->
    <script src="../assets/js/common-scripts.js"></script>
    <script type="text/javascript" src="../assets/js/data-confirm-modal.js"></script>
	<script src="../assets/js/fancybox/jquery.fancybox.js"></script>
  <script type="text/javascript">
      $(function() {
        //    fancybox
          jQuery(".fancybox").fancybox();
      });

  </script>
         <script>
		$('.delcommunity').on('click', function () {
		
		var cid=$(this).attr('cid');
	
	dataConfirmModal.confirm({
		        title: 'Are you sure?',
		        text: 'Removing this will remove all related information',
		        commit: 'Yes do it',
		        cancel: 'Cancel', 
		
		        onConfirm: function () {
		            var event='delete-community';

			    $.post("eventHandler.php",
			    {
			    event: event,
			    cid: cid
			    },
			    
			    function(data){
			    console.log(data);
			    location.reload();
			    }
			    );   
		           
		           
		        },
		        onCancel: function () {
		           
		        }
		    });
		});
	   </script>



  </body>
</html>