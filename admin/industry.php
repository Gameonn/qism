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
	$searchkey= "where industry LIKE '%$key%'";
	else 
	$searchkey='where 1';

$sth=$conn->prepare("select * from industries $searchkey order by industry {$qe} ");
try{$sth->execute();}
catch(Exception $e){
echo $e->getMessage();
}
$re=$sth->fetchAll(PDO::FETCH_ASSOC);
	$total_records=count($re);

$sth=$conn->prepare("select * from industries $searchkey order by industry {$qe} LIMIT {$startpoint}, {$limit}");
try{$sth->execute();}
catch(Exception $e){
echo $e->getMessage();
}
$result=$sth->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
 <style>
#profile-01 {
background: #2f2f2f!important;
min-height:200px!important;
}
</style>
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
		<div class="col-md-3">
		<h3>Industries
		<a href="#" class="newcommunity" data-no-turbolink ='true' data-toggle="modal" data-target="#industry">
				<i class="fa fa-plus-circle"></i></a>
		</h3>
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
			<li <?php if($page==1) echo "class='prev disabled'><a href='#'>"; else { echo "class='prev'><a href='?page=".--$page."&limit=$limit&sortby=$sortby'>"; $page++; } ?>← Previous</a></li>
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
			<li <?php if($page==ceil($total_records/$limit)) echo "class='next disabled'><a href='#'>"; else { echo "class='next'><a href='?page=".++$page."&limit=$limit&sortby=$sortby'>"; $page--; } ?>Next → </a></li>
		</ul>
	</div>	
	</div>
		
              <div class="row">
              <?php foreach($result as $row){ ?>
              	<div class="col-lg-3 col-md-3 col-sm-3 mb">
			<div class="content-panel pn">
				<div id="profile-01">
					<h3 style='text-transform:uppercase;'><?php echo $row['industry']; ?></h3>
					<i class="fa fa-bolt fa-3x" style="  text-align: center;display: block;"></i>
				</div>
				
			<div class="pr2-social centered">
				
				<a href="#" class="edit_industry" did="<?php echo $row['id']; ?>" data-no-turbolink ='true' data-toggle="modal" data-target="#editindustry">
				<i class="fa fa-pencil"></i></a>
				<!-- <a href="#" class="delcommunity" data-no-turbolink ='true' data-toggle="modal" data-target="#comm1">
				<i class="fa fa-trash-o"></i></a> -->
			</div>
			</div><! --/content-panel -->
		</div><! --/col-md-4 -->
         	
              <?php } ?>
                 </div><!-- /row END SECTION MIDDLE -->
                  
                  
     </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              QISMA
              <a href="industry.php#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>
  <?php } else{
  require_once('user_1.php');
  }?>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/jquery-1.8.3.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../assets/js/jquery.scrollTo.min.js"></script>
    <script src="../assets/js/jquery.nicescroll.js" type="text/javascript"></script>
      <script src="../assets/js/common-scripts.js"></script>
   <script>
	$('.edit_industry').on('click',function(){
		
		var did= $(this).attr('did');
		var event='get-industry';

		$.post("eventHandler.php",
		{
			event: event,
			did: did
		},
		
		function(data){

			console.log(data);
			$('#industry-editing1').empty();
			$.each(data, function(index,v) {
			
	       var field='<form action="eventHandler.php" method="post"><p>Enter Industry Name</p><input type="text" name="industry" value="'+v.industry+'" class="form-control" required>  <input type="hidden" name="event" value="edit_industry"><input type="hidden" name="did" value="'+did+'"><div class="modal-footer"><button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button><button class="btn btn-theme" type="submit">Submit</button></div></form>';

	       $('#industry-editing1').append(field).fadeIn(1000);
	   });
	
	
},"json"
);
	
});
</script>
   
<div class="modal fade" id="editindustry" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Edit Industry</h4>
			</div>
			<div class="modal-body">
				<div class="" id="industry-editing1">

				</div>
			</div>
		</div>
	</div>
</div>   

  </body>
</html>

<?php require_once('add_industry.php'); ?>