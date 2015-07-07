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
.pn_l{
padding:20px;
}
#1{
margin-top:200px;
}
#1 h3
{
	text-align:center;
	
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
		
		<div class="row" id="1">
			<div class="col-md-4 col-md-offset-4 mtbox">
				<img src="../uploads/page_notfound.jpg" />
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