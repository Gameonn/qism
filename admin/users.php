<?php require_once("../phpInclude/db_connection.php"); 

$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
	$limit = 12;
	$startpoint = ($page * $limit) - $limit;
	$sortby = (int) (!isset($_GET["sortby"]) ? 0 : $_GET["sortby"]);
	$filterby = (int) (!isset($_GET["filterby"]) ? 0 : $_GET["filterby"]);
	$key=$_GET['key'];
	$chk=$_GET['chk'];
	if($filterby==1)
	$er="and user.gender='m' ";
	elseif($filterby==2)
	$er="and user.gender='f'";
	if($sortby==2)
	$qe='DESC';
	else
	$qe='ASC';
	if($key)
	$searchkey= "where username LIKE '%$key%'";
	else 
	$searchkey='where 1';
	$age = (int)((time()- strtotime (user.dob)) /(3600 * 24 * 365));
	if($chk==1)
	$wf=" and 0<=(year(NOW())-year(dob)) and (year(NOW())-year(dob))<=15";	
	elseif($chk==2)
	$wf=" and 15<=(year(NOW())-year(dob)) and (year(NOW())-year(dob))<=30";
	elseif($chk==3)
	$wf=" and 30<=(year(NOW())-year(dob)) and (year(NOW())-year(dob))<=45";	
	elseif($chk==4)
	$wf=" and (year(NOW())-year(dob))>=45";
	
	$sql="select user.*,(select group_concat(reported_user.id SEPARATOR ',') from reported_user where reported_user.user_id2=user.id) as is_reported from user $searchkey $er $wf order by username  $qe ";
	$sth=$conn->prepare($sql);
try{$sth->execute();}
catch(Exception $e){
echo $e->getMessage();
}
$re=$sth->fetchAll();
$total_records=count($re);
$sth=$conn->prepare("select user.*,(select group_concat(reported_user.id SEPARATOR ',') from reported_user where reported_user.user_id2=user.id) as is_reported from user $searchkey $er $wf order by username $qe LIMIT {$startpoint}, {$limit}");
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
.images .action{
    display: block;
    padding: 0 10px;
	margin-top: 20px;
    -webkit-transition:0.7s ease;
    transition:0.7s ease;
    -o-transition:0.7s ease;
    -ms-transition:0.7s ease;
    -moz-transition:0.7s ease;
}

.images:hover .action{
    margin-top: -140px;
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
                		<div style="margin:0px 0px 10px 0px;" class="alert alert-<?php if($_REQUEST['success']) echo "success"; else echo "danger"; ?> alert-dismissable">
			            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			            	<?php echo $_REQUEST['msg']; ?>
			            </div>
			        <?php } // --./ error -- ?>
          <div class="col-md-12 no-padding">
		<div class="col-md-2">
		<h3> Users</h3>
		</div>
		<div class="col-md-2">
		<div id="example2_length" class="dataTables_length ">
			<label style="margin-top:20px;"> <select size="1" name="example2_length" class="form-control btn btn-default " aria-controls="example2" onchange="window.location.href='?&limit=<?php echo $limit;?>&page=<?php echo $page; ?>&chk=<?php echo $chk; ?>&filterby='+(this.options[this.selectedIndex].value);">
				
				<?php foreach(array('0'=>'GENDER','1'=>'MALE','2'=>'FEMALE') as $r=>$s){
					echo "<option value='$r' ";
					if($r==$filterby) echo "selected";
					echo ">$s</option>";
				} ?>
			</select></label>
		</div>
	</div>
	<div class="col-md-2">
		<div id="example2_length" class="dataTables_length ">
			<label style="margin-top:20px;"> <select size="1" name="example2_length" class="form-control btn btn-default " aria-controls="example2" onchange="window.location.href='?&limit=<?php echo $limit;?>&page=1&filterby=<?php echo $filterby; ?>&chk='+(this.options[this.selectedIndex].value);">
				
				<?php foreach(array('0'=>'AGE GROUP','1'=>'0-15','2'=>'15-30','3'=>'30-45','4'=>'Above 45') as $r=>$s){
					echo "<option value='$r' ";
					if($r==$chk) echo "selected";
					echo ">$s</option>";
				} ?>
			</select></label>
		</div>
	</div>
	<!-- 	<div class="col-md-2">
		<div id="example2_length" class="dataTables_length ">
			<label style="margin-top:20px;"> <select size="1" name="example2_length" class="form-control btn btn-default " aria-controls="example2" onchange="window.location.href='?&limit=<?php echo $limit;?>&page=1&sortby='+(this.options[this.selectedIndex].value);">
				
				<?php foreach(array('0'=>'SORT BY','1'=>'Ascending','2'=>'Descending') as $r=>$s){
					echo "<option value='$r' ";
					if($r==$sortby) echo "selected";
					echo ">$s</option>";
				} ?>
			</select></label>
		</div>
	</div> -->
	
	<div class="col-md-2" style="margin-top:20px;">
	<a class="btn btn-primary" href="get_csv.php">Export to CSV </a>
	</div>
	
		<div class="col-md-2">
			<div class="input-group" style="margin-top:20px;">
				<input class="form-control" type="text" aria-controls="example1" onkeyup=" window.location.href='?limit=<?php echo $limit;?>&page=1&sortby=<?php echo $sortby; ?>&key='+this.value; " placeholder="Search by Name" value="">
				<span class="input-group-btn"><button class="btn btn-primary btn-flat fa fa-search" style="line-height: 20px;" onclick="window.location.href='?limit=<?php echo $limit;?>&page=1&sortby=<?php echo $sortby; ?>&key=;"></button></span>
			</div>
</div>		
<div class="col-md-2" style="text-align:right;">			
			<div class="dataTables_paginate paging_bootstrap">
		<ul class="pagination" style="display:flex;">
			<li <?php if($page==1) echo "class='prev disabled'><a href='#'>"; else { echo "class='prev'><a href='?page=".--$page."&limit=$limit&sortby=$sortby'>"; $page++; } ?>← </a></li>
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
			<li <?php if($page==$i) echo "class='active'"; ?> ><a href="<?php echo "?page=$i&limit=$limit&sortby=$sortby"; ?>"><?php echo $i; ?></a></li>
			<?php } ?>
			<li <?php if($page==ceil($total_records/$limit)) echo "class='next disabled'><a href='#'>"; else { echo "class='next'><a href='?page=".++$page."&limit=$limit&sortby=$sortby'>"; $page--; } ?> → </a></li>
		</ul>
	</div>	
	</div>
	</div>
	
	<div class="col-md-12 no-padding form-group">
	<form action="save_excel.php" method="post" enctype="multipart/form-data">
	<div class="col-md-6 col-md-offset-3">
	  <input type="file" name="file" class="filestyle" data-size="sm" data-buttonText="Upload Excel file">
	  </div>
	  <div class="col-md-3">
	  <input type="submit" name="submit" class="btn btn-primary btn-sm"> 
	</div>
	</form>
	</div>
			
              <div class="col-md-12 no-padding">
              <?php foreach($result as $row){ ?>
              	 <div class="col-lg-4 col-md-4 col-sm-4 mb">
			<div class="content-panel pn images" style="overflow:hidden;">
				<div id="profile-02" style="background: url(../uploads/<?php if($row['cover_image']) echo $row['cover_image']; else echo 'profile-02.jpg'; ?>); position:relative; ">
				<?php if($row['is_blocked']==1) { ?>
					<div style="position: absolute;color: red;top: 0px; left: 0px;">
					  <i class="fa fa-ban fa-3x"></i>
					</div>
					<?php } ?>
					<div class="user">
					<a href="user_profile.php?uid=<?php echo $row['id']; ?>">	<img src="../uploads/<?php if($row['profile_image']) echo $row['profile_image']; else echo 'fr-06.jpg'; ?>" class="img-circle" width="80"></a>
						<h4 style='text-transform:uppercase;'><?php echo $row['username']; ?></h4>
						<h5 style='color:#fff;'><?php echo $row['email']; ?></h5>
					</div>
				</div>
				<div class="pr2-social centered" style="margin-top: -10px;">
				<a href="<?php if($row['twitter_id']) { echo 'http://www.twitter.com/'.$row['twitter_id'];} else{ echo '#';} ?>"><i class="fa fa-twitter"></i></a>
					
				<a href="<?php if($row['facebook_id']) { echo 'https://www.facebook.com/'.$row['facebook_id']; } else {echo '#'; } ?>"><i class="fa fa-facebook"></i></a>
				
					<a href="<?php if($row['google_id']) { echo 'https://plus.google.com/'.$row['google_id'];} else {echo '#'; } ?>"><i class="fa fa-google-plus"></i></a>
					<a href="<?php if($row['instagram_id']) { echo 'https://www.instagram.com/'.$row['instagram_id'];} else {echo '#';} ?>"><i class="fa fa-instagram"></i></a>
					<a href="#" class="ban-user" uid="<?php  echo $row['id']; ?>" bl="<?php if($row['is_blocked']==0) echo 0; else echo 1; ?>"><?php if($row['is_blocked']==0){ echo '<i class="fa fa-ban"></i>'; }else{ echo '<i class="fa fa-circle-o"></i>'; }?> </a>
					
				</div>
				
				<div class="action">
                                <div class="row">
                                                                      
                                        <div class="col-sm-6">
										<a class="ban-user btn btn-danger btn-block" uid="<?php  echo $row['id']; ?>" bl="<?php if($row['is_blocked']==0) echo 0; else echo 1; ?>">
										<?php if($row['is_blocked']==0){ echo '<i class="fa fa-ban"></i> Block'; }else{ echo '<i class="fa fa-circle-o"></i>Unblock'; }?> </a>
										</div>
                                        <div class="col-sm-6"><a href="verify_user.php?uid=<?php echo $row['id']; ?>" class="edit-img-user-edit btn btn-info btn-block"><i class="fa fa-edit"></i> Verify</a></div>
                                    
                                 <?#php if($row['is_reported']){ ?>
                                   <!--  <div class="col-sm-12 mt">	<a href="#" class="rep_user btn btn-primary btn-block" data-no-turbolink ='true' data-toggle="modal" cid="<?php echo $row['id']; ?>" data-target="#viewcomm" data-remote="true"><i class="fa fa-scissors"></i> Report</a></div> -->
                                     <?#php  } ?>
                                </div>
                            </div>
			</div><!--/panel -->
			</div><!--/ col-md-4 -->
         	
              <?php } ?>
                 </div><!-- /row END SECTION MIDDLE -->
                  
                  
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
    <script src="../assets/js/bootstrap-filestyle.js"></script>
    <!--common script for all pages-->
    <script src="../assets/js/common-scripts.js"></script>
    <script type="text/javascript" src="../assets/js/data-confirm-modal.js"></script>

<script>
	$('.rep_user').on('click',function(){
		
		var cid= $(this).attr('cid');
		var event='get-reported-user';

		$.post("eventHandler.php",
		{
			event: event,
			cid: cid
		},
		
		function(data){

			console.log(data);
			$('.comm-view1').empty();
			$.each(data, function(index,v) {
			
	       var field='<div class="" style="text-align:center;"><div class=""> <img src="../uploads/'+v.profile_image+'" class="img-circle" width="80"><br><div style="text-transform:uppercase;font-size:15px;"> '+v.username+'</div> <div class="row well ml" style="display:inline-block; margin-right:5px;" ><span class="col-md-6" style="font-size: 18px;font-weight: bold;">Reason</span><span class="col-md-6" style="text-transform: capitalize;font-size: 15px;">'+v.reason+'</span></div></div></div> ';

	       $('.comm-view1').append(field).fadeIn(1000);
	   });
	
	
},"json"
);
	
});
</script>
   
         <script>
		$('.ban-user').on('click', function () {
		
		var uid=$(this).attr('uid');
		var bl=$(this).attr('bl');
		if(bl==1)
		blk=0;
		else
		blk=1;
		
	dataConfirmModal.confirm({
		        title: 'Are you sure?',
		        text: 'Confirming it will block the user',
		        commit: 'Confirm ',
		        cancel: 'Cancel', 
		
		        onConfirm: function () {
		            var event='block_user';

			    $.post("eventHandler.php",
			    {
			    event: event,
			    uid: uid,
			    bl: blk
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

<div class="modal fade" id="viewcomm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Reported User</h4>
			</div>
			<div class="modal-body">
				<div class="comm-view1">

				</div>
			</div>
		</div>
	</div>
</div>

  </body>
</html>