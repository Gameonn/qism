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
.pn_e{
height:300px!important;
}
.pn_r{
height:400px!important;
}
.white-panel {
color: #867A7A!important;
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
		<h3> Users</h3>
            <div class="row mt">
          		<div class="col-md-4">
          			<div class="white-panel pn pn_e">
	                	<div class="panel-heading">
	                        <div class="pull-left"><h5><i class="fa fa-tasks"></i> Appearance</h5></div>
	                        <br>
	                 	</div>
				  		<div class="custom-check goleft mt">
				             <table id="todo" class="table table-hover custom-check">
				              <tbody>
				                <tr>
				           			<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Height
				                        <span class="close" >abc</span>
									</td>
				                </tr>
				                <tr>
				           			<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Weight
				                        <span class="close" >abc</span>
									</td>
				                </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Body Type
				                        <span class="close" >abc</span>
									</td>
				                </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Eyes
				                        <span class="close" >abc</span>
									</td>
				                 </tr>
				                 <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Hair
				                        <span class="close" >abc</span>
									</td>
				                 </tr>
				              </tbody>
				          </table>
						</div><!-- /table-responsive -->
					</div><!--/ White-panel -->
          		</div><!--/col-md-4 -->

<div class="col-md-4">
          			<div class="white-panel pn pn_e">
	                	<div class="panel-heading">
	                        <div class="pull-left"><h5><i class="fa fa-tasks"></i> Health & Lifestyle</h5></div>
	                        <br>
	                 	</div>
				  		<div class="custom-check goleft mt">
				             <table id="todo" class="table table-hover custom-check">
				              <tbody>
				                <tr>
				           			<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Excercise Habbits
				                        <span class="close" >abc</span>
									</td>
				                </tr>
				                <tr>
				           			<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Smoker
				                        <span class="close" >abc</span>
									</td>
				                </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Pets
				                        <span class="close">abc</span>
									</td>
				                </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Food Choice
				                        <span class="close" >abc</span>
									</td>
				                 </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        HIV
				                        <span class="close" >abc</span>
									</td>
				                 </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Health Problems
				                        <span class="close" >abc</span>
									</td>
				                 </tr>
				              </tbody>
				          </table>
						</div><!-- /table-responsive -->
					</div><!--/ White-panel -->
          		</div><!--/col-md-4 -->
        
        <div class="col-md-4">
          			<div class="white-panel pn pn_e">
	                	<div class="panel-heading">
	                        <div class="pull-left"><h5><i class="fa fa-tasks"></i> Location & Residence</h5></div>
	                        <br>
	                 	</div>
				  		<div class="custom-check goleft mt">
				             <table id="todo" class="table table-hover custom-check">
				              <tbody>
				                <tr>
				           			<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Current Location
				                        <span class="close" >abc</span>
									</td>
				                </tr>
				                <tr>
				           			<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Residency Status
				                        <span class="close" >×</span>
									</td>
				                </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Citizenship
				                        <span class="close" >abc</span>
									</td>
				                </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Relocation Intention
				                        <span class="close" >abc</span>
									</td>
				                 </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Living Arrangements
				                        <span class="close" >abc</span>
									</td>
				                 </tr>
				              </tbody>
				          </table>
						</div><!-- /table-responsive -->
					</div><!--/ White-panel -->
          		</div><!--/col-md-4 -->
          	</div><!-- row -->

          	<div class="row mt">
          		<div class="col-md-4">
          			<div class="white-panel pn pn_r">
	                	<div class="panel-heading">
	                        <div class="pull-left"><h5><i class="fa fa-tasks"></i> Family</h5></div>
	                        <br>
	                 	</div>
				  		<div class="custom-check goleft mt">
				             <table id="todo" class="table table-hover custom-check">
				              <tbody>
				                <tr>
				           			<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Ancestral Origin
				                        <span class="close" >abc</span>
									</td>
				                </tr>
				                <tr>
				           			<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Community/Caste/Tribe
				                        <span class="close" >abc</span>
									</td>
				                </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Sub Community
				                        <span class="close" >abc</span>
									</td>
				                </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Mother Tongue
				                        <span class="close" >abc</span>
									</td>
				                 </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                       Family Values
				                        <span class="close" >abc</span>
									</td>
				                 </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Number of Siblings
				                        <span class="close" >abc</span>
									</td>
				                 </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Father Status
				                        <span class="close" >abc</span>
									</td>
				                 </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Mother Status
				                        <span class="close" >abc</span>
									</td>
				                 </tr>
				              </tbody>
				          </table>
						</div><!-- /table-responsive -->
					</div><!--/ White-panel -->
          		</div><!--/col-md-4 -->

          	<div class="col-md-4">
          			<div class="white-panel pn pn_r">
	                	<div class="panel-heading">
	                        <div class="pull-left"><h5><i class="fa fa-tasks"></i> Hobbies, Interests & More</h5></div>
	                        <br>
	                 	</div>
				  		<div class="custom-check goleft mt">
				             <table id="todo" class="table table-hover custom-check">
				              <tbody>
				                <tr>
				           			<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Sports
				                        <span class="close" >abc</span>
									</td>
				                </tr>
				                <tr>
				           			<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Interests/Hobbies
				                        <span class="close" >abc</span>
									</td>
				                </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Favourite Movies
				                        <span class="close" >abc</span>
									</td>
				                </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Favourite Cuisine
				                        <span class="close" >abc</span>
									</td>
				                 </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Favourite Personalities
				                        <span class="close" >abc</span>
									</td>
				                 </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Favourite Books
				                        <span class="close" >abc</span>
									</td>
				                 </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Favourite Music
				                        <span class="close" >abc</span>
									</td>
				                 </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Favourite Dessert
				                        <span class="close" >abc</span>
									</td>
				                 </tr>
				              </tbody>
				          </table>
						</div><!-- /table-responsive -->
					</div><!--/ White-panel -->
          		</div><!--/col-md-4 -->
        
        <div class="col-md-4">
          			<div class="white-panel pn pn_r">
	                	<div class="panel-heading">
	                        <div class="pull-left"><h5><i class="fa fa-tasks"></i> Religious</h5></div>
	                        <br>
	                 	</div>
				  		<div class="custom-check goleft mt">
				             <table id="todo" class="table table-hover custom-check">
				              <tbody>
				                <tr>
				           			<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Sect
				                        <span class="close" >abc</span>
									</td>
				                </tr>
				                <tr>
				           			<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Halal
				                        <span class="close" >abc</span>
									</td>
				                </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Fasting
				                        <span class="close" >abc</span>
									</td>
				                </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Zakat
				                        <span class="close" >abc</span>
									</td>
				                 </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Salah
				                        <span class="close" >abc</span>
									</td>
				                 </tr>
				                <tr>
				            		<td>
				                        <span class="check"><i class="fa fa-adn"></i></span>
				                        Religiousness
				                        <span class="close" >abc</span>
									</td>
				                 </tr>
				              </tbody>
				          </table>
						</div><!-- /table-responsive -->
					</div><!--/ White-panel -->
          		</div><!--/col-md-4 -->
	

          	</div><!-- row -->
                  
                  
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


  </body>
</html>