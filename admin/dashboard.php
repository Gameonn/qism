<?php require_once("../phpInclude/db_connection.php"); 

$sql="SELECT count(communities.id) as community,(select count(user.id) from user) as users,(select count(ancestral_origins.id) from ancestral_origins) as origin,(SELECT COUNT(educations.id) from educations) as education, (SELECT count(sects.id) from sects) as sect,(SELECT count(occupations.id) from occupations) as occupation,(SELECT count(industries.id) from industries) as industry, (SELECT count(languages.id) from languages) as language FROM `communities`";
$sth=$conn->prepare($sql);
try{$sth->execute();}
catch(Exception $e){}
$result=$sth->fetchAll(PDO::FETCH_ASSOC);
$total=$result[0]['community']+$result[0]['origin']+$result[0]['education']+$result[0]['sect']+$result[0]['occupation']+$result[0]['industry']+$result[0]['language'];
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css"> 
  <body>

  <section id="container" >
  <?php require_once("header.php"); ?>
<?php require_once("sidebar.php"); ?>
     
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">

              <div class="row">
                  <div class="col-lg-12 main-chart">
                  <?php //error div
                	if(isset($_REQUEST['success']) && isset($_REQUEST['msg']) && $_REQUEST['msg']){ ?>
                		<div style="margin:0px 0px 10px 0px;" class="alert alert-<?php if($_REQUEST['success']) echo "success"; else echo "danger"; ?> alert-dismissable">
			            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			            	<?php echo $_REQUEST['msg']; ?>
			            </div>
			        <?php } // --./ error -- ?>
                  	<div class="row mt">
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_heart"></span>
					  			<h3><?php echo $result[0]['community']; ?></h3>COMMUNITIES
                  			</div>
					  			<p><?php echo $result[0]['community']; ?> Communities</p>
                  		</div>
						<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_user"></span>
					  			<h3><?php echo $result[0]['users']; ?></h3>USERS
                  			</div>
					  			<p><?php echo $result[0]['users']; ?> Users</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_cloud"></span>
					  			<h3><?php echo $result[0]['occupation']; ?></h3>OCCUPATIONS
                  			</div>
					  			<p><?php echo $result[0]['occupation']; ?> Occupations</p>
                  		</div>
                  		<!-- <div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_stack"></span>
					  			<h3><?php echo $result[0]['language']; ?></h3>LANGUAGES
                  			</div>
					  			<p><?php echo $result[0]['language']; ?> Languages</p>
                  		</div> -->
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_news"></span>
					  			<h3><?php echo $result[0]['origin']; ?></h3>ETHNIC ORIGINS
                  			</div>
					  			<p><?php echo $result[0]['origin']; ?> Ethnic Origins</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_data"></span>
					  			<h3><?php echo $result[0]['education']; ?></h3>EDUCATION LEVELS
                  			</div>
					  			<p><?php echo $result[0]['education']; ?> Education Levels</p>
                  		</div>
                  		
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_stack"></span>
					  			<h3><?php echo $result[0]['industry']; ?></h3> INDUSTRIES
                  			</div>
					  			<p><?php echo $result[0]['industry']; ?> Industries</p>
                  		</div>
                  	
                  	</div><!-- /row mt -->	
                  
                  <div id="morris">
                  <div class="row mt">
                   <div class="col-lg-12">
                          <div class="content-panel">
                              <h4><i class="fa fa-angle-right"></i> User Counts</h4>
                              <div class="panel-body">
                                  <div id="hero-bar" ></div>
                              </div>
                          </div>
                      </div>
                      </div>
                      </div>
                  
                  
                  <!--
					
                      <div class="border-head">
                          <h3>COUNTS</h3>
                      </div>
                      <div class="custom-bar-chart">
                          
                          <div class="bar">
                              <div class="title">Community</div>
                              <div class="value tooltips" data-original-title="<?php echo $result[0]['community']; ?>" data-toggle="tooltip" data-placement="top">50%<?#php echo ($result[0]['community']/$total)*100; ?>
                              </div>
                          </div>
                          <div class="bar ">
                              <div class="title">Occupation</div>
                              <div class="value tooltips" data-original-title="<?php echo $result[0]['occupation']; ?>" data-toggle="tooltip" data-placement="top">42%<?#php echo ($result[0]['occupation']/$total)*100; ?>
                              </div>
                          </div>
                          <div class="bar ">
                              <div class="title">Industry</div>
                              <div class="value tooltips" data-original-title="<?php echo $result[0]['industry']; ?>" data-toggle="tooltip" data-placement="top">64%<?#php echo ($result[0]['industry']/$total)*100; ?>
                              </div>
                          </div>
                          <div class="bar ">
                              <div class="title">Sect</div>
                              <div class="value tooltips" data-original-title="<?php echo $result[0]['sect']; ?>" data-toggle="tooltip" data-placement="top">35%<?#php echo ($result[0]['sect']/$total)*100; ?></div>
                          </div>
                          <div class="bar">
                              <div class="title">Education</div>
                              <div class="value tooltips" data-original-title="<?php echo $result[0]['education']; ?>" data-toggle="tooltip" data-placement="top">56%<?#php echo ($result[0]['education']/$total)*100; ?>
                              </div>
                          </div>
                          <div class="bar ">
                              <div class="title">Ethnic Origin</div>
                              <div class="value tooltips" data-original-title="<?php echo $result[0]['origin']; ?>" data-toggle="tooltip" data-placement="top">24%<?#php echo ($result[0]['origin']/$total)*100; ?></div>
                          </div>
                          <div class="bar">
                              <div class="title">Language</div>
                              <div class="value tooltips" data-original-title="<?php echo $result[0]['language']; ?>" data-toggle="tooltip" data-placement="top">75%<?#php echo ($result[0]['language']/$total)*100; ?>
                              </div>
                          </div>
                      </div>
                      
					</div>
					-->
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
     </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              QISMA
              <a href="dashboard.php#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

<script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../assets/js/jquery.scrollTo.min.js"></script>
    <script src="../assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
	<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="../assets/js/common-scripts.js"></script>

    <!--script for this page-->
  <!--  <script src="../assets/js/morris-conf.js"></script> -->
    
    <script>
   $(document).ready(function(){
  $(function () {
     
      Morris.Bar({
        element: 'hero-bar',
        data: [
          {device: 'Community', Users: "<?php echo $result[0]['community']; ?>"},
          {device: 'Occupation', Users: "<?php echo $result[0]['occupation']; ?>"},
          {device: 'Education', Users: "<?php echo $result[0]['education']; ?>"},
          {device: 'Ethnic Origins', Users: "<?php echo $result[0]['origin']; ?>"},
          {device: 'Industries', Users: "<?php echo $result[0]['industry']; ?>"},
          {device: 'Sects', Users: "<?php echo $result[0]['sect']; ?>"},
          {device: 'Languages', Users: "<?php echo $result[0]['language']; ?>"},
          {device: 'App Users', Users: "<?php echo $result[0]['users']; ?>"}
        ],
        xkey: 'device',
        ykeys: ['Users'],
        labels: ['Count'],
        barRatio: 0.4,
        xLabelAngle: 35,
        hideHover: 'auto',
        barColors: ['#ac92ec']
      });
    });

	});
	</script>	

	

  

  </body>
</html>