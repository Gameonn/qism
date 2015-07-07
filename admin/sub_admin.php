<?php require_once("../phpInclude/db_connection.php"); 
session_start();
if($_SESSION['admin']['type']==1){
$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
	$limit = 12;
	$startpoint = ($page * $limit) - $limit;
	$sortby = (int) (!isset($_GET["sortby"]) ? 0 : $_GET["sortby"]);
	$key=$_GET['key'];
	if($sortby==2)
	$qe='DESC';
	else
	$qe='ASC';
	if($key)
	$searchkey= "and username LIKE '%$key%'";
	else 
	$searchkey='and 1';

$sth=$conn->prepare("select * from admin where admin_type=2 $searchkey order by username {$qe} ");
try{$sth->execute();}
catch(Exception $e){
echo $e->getMessage();
}
$re=$sth->fetchAll(PDO::FETCH_ASSOC);
$total_records=count($re);

$sth=$conn->prepare("select * from admin where admin_type=2 $searchkey order by username {$qe} LIMIT {$startpoint}, {$limit}");
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
 background: url('../uploads/23324234.jpg')!important;
min-height:200px!important;
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
		<?php //error div
                	if(isset($_REQUEST['success']) && isset($_REQUEST['msg']) && $_REQUEST['msg']){ ?>
                		<div style="margin:15px 0px 10px 0px;" class="alert alert-<?php if($_REQUEST['success']) echo "success"; else echo "danger"; ?> alert-dismissable">
			            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			            	<?php echo $_REQUEST['msg']; ?>
			            </div>
			        <?php } // --./ error -- ?>
		<div class="col-md-3">
		<h3> Sub Admins
		<a href="#" class="sub_admin_class" data-no-turbolink ='true' data-toggle="modal" data-target="#sub_admin" data-remote="true">
				<i class="fa fa-plus-circle"></i></a></h3>
				</div>
				<div class="col-md-3">
		<div id="example2_length" class="dataTables_length ">
			<label style="margin-top:20px;"> <select size="1" name="example2_length" class="form-control btn btn-default " aria-controls="example2" onchange="window.location.href='?&limit=<?php echo $limit;?>&page=1&sortby='+(this.options[this.selectedIndex].value);">
				
				<?php foreach(array('0'=>'SORT BY','1'=>'Ascending','2'=>'Descending') as $r=>$s){
					echo "<option value='$r' ";
					if($r==$sortby) echo "selected";
					echo ">$s</option>";
				} ?>
			</select></label>
		</div>
	</div>
		<div class="col-md-3">
			<div class="input-group" style="margin-top:20px;">
				<input class="form-control" type="text" aria-controls="example1" onkeyup=" window.location.href='?limit=<?php echo $limit;?>&page=1&sortby=<?php echo $sortby; ?>&key='+this.value; " placeholder="Search by Name" value="">
				<span class="input-group-btn"><button class="btn btn-primary btn-flat fa fa-search" style="line-height: 20px;" onclick="window.location.href='?limit=<?php echo $limit;?>&page=1&sortby=<?php echo $sortby; ?>&key=;"></button></span>
			</div>
</div>		
<div class="col-md-3" style="text-align:right;">			
			<div class="dataTables_paginate paging_bootstrap">
		<ul class="pagination">
			<li <?php if($page==1) echo "class='prev disabled'><a href='#'>"; else { echo "class='prev'><a href='?page=".--$page."&limit=$limit&sortby=$sortby'>"; $page++; } ?> Prev</a></li>
			<?php 
			if(ceil($total_records/$limit) > 3){
				$forstart=1+$page-1;
				$forend = (3+$page-1)<=ceil($total_records/$limit) ? 3+$page-1 : ceil($total_records/$limit);
			}
			else {
				$forstart=1;
				$forend=ceil($total_records/$limit);
			}
			for($i=$forstart;$i<=$forend;$i++){ ?>
			<li <?php if($page==$i) echo "class='active'"; ?>><a href="<?php echo "?page=$i&limit=$limit&sortby=$sortby"; ?>"><?php echo $i; ?></a></li>
			<?php } ?>
			<li <?php if($page==ceil($total_records/$limit)) echo "class='next disabled'><a href='#'>"; else { echo "class='next'><a href='?page=".++$page."&limit=$limit&sortby=$sortby'>"; $page--; } ?>Next  </a></li>
		</ul>
	</div>	
	</div>		
              <div class="row">
              <?php foreach($result as $row){ ?>
          <div class="col-lg-4 col-md-4 col-sm-4 mb">
							<div class="content-panel pn">
								<div id="profile-01" >
									<h3 style="text-transform:uppercase;"><?php echo $row['username']; ?></h3>
									
								</div>
								
								<div class="centered">
									<h5><i class="fa fa-envelope"></i><br/><?php echo $row['email']; ?></h5>
								</div>
							</div><!--/content-panel -->
						</div><!--/col-md-4 -->
         	
              <?php } ?>
                 </div><!-- /row END SECTION MIDDLE -->
                  
                  
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
  <?php } else{
  require_once('user_1.php');
  }?>
<?php require_once('add_sub_admin.php'); ?>


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
	$('.editcommunity').on('click',function(){
		
		var cid= $(this).attr('cid');
		var event='get-community';

		$.post("eventHandler.php",
		{
			event: event,
			cid: cid
		},
		
		function(data){

			console.log(data);
			$('#comm-editing1').empty();
			$.each(data, function(index,v) {
			
	       var field='<form action="eventHandler.php" method="post"><p>Enter Community Name</p><input type="text" name="community" value="'+v.community+'" class="form-control" required>  <input type="hidden" name="event" value="edit_community"><input type="hidden" name="cid" value="'+cid+'"><div class="modal-footer"><button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button><button class="btn btn-theme" type="submit">Submit</button></div></form>';

	       $('#comm-editing1').append(field).fadeIn(1000);
	   });
	
	
},"json"
);
	
});
</script>

<script>
	$('.editsubcommunity').on('click',function(){
		
		var sid= $(this).attr('sid');
		var event='get-subcommunity';

		$.post("eventHandler.php",
		{
			event: event,
			sid: sid
		},
		
		function(data){

			console.log(data);
			$('#sub-editing1').empty();
			$.each(data, function(index,v) {
			
	       var field='<form action="eventHandler.php" method="post"><p>Enter Sub Community Name</p><input type="text" name="subcommunity" value="'+v.sub_community+'" class="form-control" required>  <input type="hidden" name="event" value="edit_subcommunity"><input type="hidden" name="sid" value="'+sid+'"><div class="modal-footer"><button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button><button class="btn btn-theme" type="submit">Submit</button></div></form>';

	       $('#sub-editing1').append(field).fadeIn(1000);
	   });
	
	
},"json"
);
	
});
</script>

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
<div class="modal fade" id="editcomm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Edit Community</h4>
			</div>
			<div class="modal-body">
				<div class="" id="comm-editing1">

				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editsubcomm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Edit Sub Community</h4>
			</div>
			<div class="modal-body">
				<div class="" id="sub-editing1">

				</div>
			</div>
		</div>
	</div>
</div>


  </body>
</html>