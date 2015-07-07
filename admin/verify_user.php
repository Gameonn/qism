<?php require_once("../phpInclude/db_connection.php"); 
$uid=$_REQUEST['uid'];

$sth=$conn->prepare("SELECT ID_verification.*,user.* FROM `ID_verification` join user on user.id=ID_verification.user_id where user_id=:user_id");
$sth->bindValue('user_id',$uid);
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
.pn_l{
height:400px !important;
}
</style>
<link href="../assets/css/sweet-alert.css" rel="stylesheet" type="text/css">
  <section id="container" >
  <?php require_once("header.php"); ?>
<?php require_once("sidebar.php"); ?>
     
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
    <h3> User Verification </h3>
                      <div class="row mt mb">
          <input type="hidden" name="user_id" value="<?php echo $uid; ?>">
<?php 
              if($result){
              foreach($result as $row){ 
               if($row['passport']){
              ?>
                      	<div class="col-md-4 col-sm-4 mb">
                      		<div class="darkblue-panel pn pn_l">
                      			<div class="darkblue-header" style="position:relative;">
								<?php if($row['passport_verified']=='y') { echo '<div style="position: absolute;left: 0px;top: 0px;color: green;"> <i class="fa fa-check fa-2x"> </i></div>' ;} ?>
						  			<h5>PASSPORT</h5>
                      			</div>
								<img src="../uploads/<?php if($row['passport']) echo $row['passport']; ?>" style="width:100%;height:300px;padding: 10px;" >	
								<footer>
									<div class="pull-left">
									<?php if($row['passport_verified']=='n') { ?>
										<h5> <button class="btn btn-sm btn-success verfic" id="1">VERIFY</button></h5>
										<?php } else{ ?>
										<h5> <button class="btn btn-sm btn-success verified" >VERIFIED</button></h5>
										<?php } ?>
									</div>
									<div class="pull-right">
										
									</div>
								</footer>
                      		</div><!-- /darkblue panel -->
                      	</div><!-- /col-md-4 -->
                      	  <?php } 
                      	  
                      	  else{
                      	  echo '<div class="col-lg-4 col-md-4 col-sm-4 mb">
              <div class="twitter-panel pn">
                <i class="fa fa-archive fa-4x"></i>
                <h3>NO VERFICATION IMAGE UPLOADED SO FAR</h3>
                
              </div>
            </div>';
                      	  }
                                       if($row['id_card']){
                                      ?>
                      	<div class="col-md-4 col-sm-4 mb">
                      		<div class="darkblue-panel pn pn_l">
                      			<div class="darkblue-header" style="position:relative;">
								<?php if($row['id_card_verified']=='y') { echo '<div style="position: absolute;left: 0px;top: 0px;color: green;"> <i class="fa fa-check fa-2x"> </i></div>' ;} ?>
						  			<h5>ID CARD</h5>
                      			</div>
								<img src="../uploads/<?php if($row['id_card']) echo $row['id_card']; ?>" style="width:100%;height:300px;padding: 10px;" >	
							
								<footer>
									<div class="pull-left">
									<?php if($row['id_card_verified']=='n') { ?>
										<h5> <button class="btn btn-sm btn-success verfic" id="2">VERIFY</button></h5>
										<?php } else{ ?>
										<h5> <button class="btn btn-sm btn-success verified" >VERIFIED</button></h5>
										<?php } ?>
									</div>
									<div class="pull-right">
										
									</div>
								</footer>
                      		</div><!-- /darkblue panel -->
                      	</div><!-- /col-md-4 -->
                      	    <?php }
                      	    else{
                      	    echo '<div class="col-lg-4 col-md-4 col-sm-4 mb">
              <div class="twitter-panel pn">
                <i class="fa fa-archive fa-4x"></i>
                <h3>NO VERFICATION IMAGE UPLOADED SO FAR</h3>
                
              </div>
            </div>';
                      	    }
                      	    
                                       if($row['license']){ ?>
                      	<div class="col-md-4 col-sm-4 mb">
                      		<div class="darkblue-panel pn pn_l">
                      			<div class="darkblue-header" style="position:relative;">
								<?php if($row['license_verified']=='y') { echo '<div style="position: absolute;left: 0px;top: 0px;color: green;"> <i class="fa fa-check fa-2x"> </i></div>' ;} ?>
						  			<h5>LICENSE</h5>
                      			</div>
								<img src="../uploads/<?php if($row['license']) echo $row['license']; ?>" style="width:100%;height:300px;padding: 10px;" >	
								<footer>
									<div class="pull-left">
									<?php if($row['license_verified']=='n') { ?>
										<h5> <button class="btn btn-sm btn-success verfic" id="3">VERIFY</button></h5>
										<?php } else{ ?>
										<h5> <button class="btn btn-sm btn-success verified" >VERIFIED</button></h5>
										<?php } ?>
									</div>
									<div class="pull-right">
										
									</div>
								</footer>
                      		</div><!-- /darkblue panel -->
                      	</div><!-- /col-md-4 -->
                      	 <?php }
                      	 
                      	   else{
                      	    echo '<div class="col-lg-4 col-md-4 col-sm-4 mb">
              <div class="twitter-panel pn">
                <i class="fa fa-archive fa-4x"></i>
                <h3>NO VERFICATION IMAGE UPLOADED SO FAR</h3>
                
              </div>
            </div>';
                      	    }
                  }
              }
              else{ ?>

                 <div class="col-lg-12 col-md-12 col-sm-12 mb">
              <div class="twitter-panel pn">
                <i class="fa fa-archive fa-4x"></i>
                <h3>NO VERFICATION IMAGE UPLOADED SO FAR</h3>
                
              </div>
            </div><!-- /col-md-12 -->
              <?php } ?>
              </div><!-- /row -->
                  
                  
     </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              QISMA
              <a href="community.php#" class="go-top">
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
    <script href="../assets/js/sweet-alert.js" type="text/javascript"></script>
    
<script>
  $('.verfic').on('click',function(){
   
	var uid=$("[name='user_id']").val();
	var cid= $(this).attr('id');
	
    var event='update_verification_status';

    $.post("eventHandler.php",
    {
      event: event,
      cid: cid,
	  uid: uid
    },
    
    function(data){

      console.log(data);
     location.reload();
     });

});

$('.verified').on('click',function(){
alert('Already Verified');
});
</script>

  </body>
</html>