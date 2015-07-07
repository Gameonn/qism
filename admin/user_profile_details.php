<?php require_once("../phpInclude/db_connection.php"); 

$sth=$conn->prepare("select * from user order by username");
try{$sth->execute();}
catch(Exception $e){
echo $e->getMessage();
}
$result=$sth->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
  <body>
<style>
#profile-01 {
background: #2f2f2f!important;
min-height:200px!important;
}
.pn_1{
	height:320px;
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
		  
		<h3> <img src="../uploads/emma-watson-profile-model-30795574.jpg" class="img-circle" width="100" height="100"/> User Profile</h3>
		
	<nav class="navbar navbar-inverse">

<!--	  <ul class="nav navbar-nav navbar-left">
		<li ><a href="user_profile.php">About</a></li>
		<li class="active"><a href="user_profile_details.php">Details <span class="sr-only">(current)</span></a></li>
      </ul> -->
	<ul class="nav nav-pills">
  <li role="presentation" ><a href="#about">About</a></li>
  <li role="presentation" ><a href="#details" data-toggle="tab">Details</a></li>
  </ul>  
	</nav>
	 
	 <section id="details">
		
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
                                          ABC
                                              </div>    
                                          </div>
                                      </li>

                                      <li class="list-danger">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Weight</span>
                                             <div class="pull-right hidden-phone">
                                          ABC
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Body Type</span>
                                           <div class="pull-right hidden-phone">
                                          ABC
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Eyes</span>
                                           <div class="pull-right hidden-phone">
                                          ABC
                                              </div>   
                                          </div>
                                      </li>
                                      <li class="list-info">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Hair</span>
                                          <div class="pull-right hidden-phone">
                                          ABC
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
                                          ABC
                                              </div>    
                                          </div>
                                      </li>

                                      <li class="list-danger">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Job Title</span>
                                             <div class="pull-right hidden-phone">
                                          ABC
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Income</span>
                                           <div class="pull-right hidden-phone">
                                          ABC
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Industry</span>
                                           <div class="pull-right hidden-phone">
                                          ABC
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
                                          ABC
                                              </div>    
                                          </div>
                                      </li>

                                      <li class="list-danger">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Residency Status</span>
                                             <div class="pull-right hidden-phone">
                                          ABC
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Citizenship</span>
                                           <div class="pull-right hidden-phone">
                                          ABC
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Relocation Intention</span>
                                           <div class="pull-right hidden-phone">
                                          ABC
                                              </div>   
                                          </div>
                                      </li>
                                      <li class="list-info">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Living Arrangements</span>
                                          <div class="pull-right hidden-phone">
                                          ABC
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
			  
						  <!-- <div class="col-md-5 col-md-offset-1"> -->
						  <div class="col-md-6">
                      <section class="task-panel tasks-widget pn_e">
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
                                              <span class="task-title-sp">Excercise Habbits</span>
                                            <div class="pull-right hidden-phone">
                                          ABC
                                              </div>    
                                          </div>
                                      </li>

                                      <li class="list-danger">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Smoker</span>
                                             <div class="pull-right hidden-phone">
                                          ABC
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Pets</span>
                                           <div class="pull-right hidden-phone">
                                          ABC
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Food Choice</span>
                                           <div class="pull-right hidden-phone">
                                          ABC
                                              </div>   
                                          </div>
                                      </li>
                                      <li class="list-info">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">HIV</span>
                                          <div class="pull-right hidden-phone">
                                          ABC
                                              </div>   
                                          </div>
                                      </li>
                                         <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Health Problems</span>
                                           <div class="pull-right hidden-phone">
                                          ABC
                                              </div>
                                          </div>
                                      </li>

                                  </ul>
                              </div>
                             
                          </div>
                      </section>
                  </div><!--/col-md-4 -->
			  
                  
              


                          <!-- <div class="col-md-5"> -->
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
                                          ABC
                                              </div>    
                                          </div>
                                      </li>

                                      <li class="list-danger">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Halal</span>
                                             <div class="pull-right hidden-phone">
                                          ABC
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Zakat</span>
                                           <div class="pull-right hidden-phone">
                                          ABC
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Fasting</span>
                                           <div class="pull-right hidden-phone">
                                          ABC
                                              </div>   
                                          </div>
                                      </li>
                                      <li class="list-info">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Religiousness</span>
                                          <div class="pull-right hidden-phone">
                                          ABC
                                              </div>   
                                          </div>
                                      </li>
                                      <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Salah</span>
                                           <div class="pull-right hidden-phone">
                                          ABC
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

			
			<!--<div class="col-md-5 col-md-offset-1"> -->
			<div class="col-md-6">
                      <section class="task-panel tasks-widget pn_r">
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
                                          ABC
                                              </div>    
                                          </div>
                                      </li>

                                      <li class="list-danger">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Community/Caste/Tribe</span>
                                             <div class="pull-right hidden-phone">
                                          ABC
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Sub Community</span>
                                           <div class="pull-right hidden-phone">
                                          ABC
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Mother Tongue</span>
                                           <div class="pull-right hidden-phone">
                                          ABC
                                              </div>   
                                          </div>
                                      </li>
                                      <li class="list-info">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Family Values</span>
                                          <div class="pull-right hidden-phone">
                                          ABC
                                              </div>   
                                          </div>
                                      </li>
                                      <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Number of Siblings</span>
                                           <div class="pull-right hidden-phone">
                                          ABC
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Father Status</span>
                                           <div class="pull-right hidden-phone">
                                          ABC
                                              </div>   
                                          </div>
                                      </li>
                                     <li class="list-info">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Mother Status</span>
                                          <div class="pull-right hidden-phone">
                                          ABC
                                              </div>   
                                          </div>
                                      </li> 
                                  </ul>
                              </div>
                             
                          </div>
                      </section>
                  </div><!--/col-md-4 -->
  
  
				   <!--<div class="col-md-5">-->
				   <div class="col-md-6">
                      <section class="task-panel tasks-widget pn_r">
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
                                          ABC
                                              </div>    
                                          </div>
                                      </li>

                                      <li class="list-danger">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Interests/Hobbies</span>
                                             <div class="pull-right hidden-phone">
                                          ABC
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Favourite Movies</span>
                                           <div class="pull-right hidden-phone">
                                          ABC
                                              </div>
                                          </div>
                                      </li>
                                      <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Favourite Cuisine</span>
                                           <div class="pull-right hidden-phone">
                                          ABC
                                              </div>   
                                          </div>
                                      </li>
                                      <li class="list-info">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Favourite Personalities</span>
                                          <div class="pull-right hidden-phone">
                                          ABC
                                              </div>   
                                          </div>
                                      </li>
                                         <li class="list-success">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Favourite Books</span>
                                           <div class="pull-right hidden-phone">
                                          ABC
                                              </div>
                                          </div>
                                      </li>
                                            <li class="list-warning">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Favourite Music</span>
                                           <div class="pull-right hidden-phone">
                                          ABC
                                              </div>   
                                          </div>
                                      </li>
                                      <li class="list-info">
                                          <i class=" fa fa-ellipsis-v"></i>
                                           
                                          <div class="task-title">
                                              <span class="task-title-sp">Favourite Dessert</span>
                                          <div class="pull-right hidden-phone">
                                          ABC
                                              </div>   
                                          </div>
                                      </li>
                                  </ul>
                              </div>
                             
                          </div>
                      </section>
                  </div><!--/col-md-4 -->
			</section>
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

   <script>
   $(".modalBtn").click(function(){
  var comid= $(this).data('comid');
    $(".modal-body #comid").val(comid);
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