<?php require_once("../phpInclude/db_connection.php"); 
session_start();
if($_SESSION['admin']['type']==1){

$sth=$conn->prepare("SELECT suggestions.*,(SELECT user.username from user WHERE user.id=suggestions.user_id) as username FROM `suggestions`");
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
		
	      	<div class="row mt">
              <div class="col-lg-12">
                      <div class="content-panel">
						  <h4><i class="fa fa-angle-right"></i> SUGGESTIONS</h4>
                          <section id="no-more-tables">
                              <table class="table table-bordered table-striped table-condensed cf">
                                  <thead class="cf">
                                  <tr>
                                      <th>ID</th>
                                      <th>Username</th>
                                      <th class="numeric">Title</th>
                                      <th>Description</th>
                                      <th class="numeric">Date</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <?php foreach($result as $row){ ?>
                                  <tr>
                                      <td data-title="ID"><?php echo $row['id']; ?></td>
                                      <td data-title="Username"><?php echo $row['username']; ?></td>
                                      <td class="numeric" data-title="Title"><?php echo $row['title']; ?></td>
                                      <td data-title="Description"><?php echo $row['description']; ?></td>
                                      <td class="numeric" data-title="Date"><?php echo date_format(date_create($row['created_on']),"Y-m-d"); ?></td>
                                  </tr>
                                   <?php } ?>
                                  </tbody>
                              </table>
                          </section>
                      </div><!-- /content-panel -->
                  </div><!-- /col-lg-12 -->
              </div><!-- /row -->
                  
                  
     </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              QISMA
              <a href="education.php#" class="go-top">
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
    <!--common script for all pages-->
    <script src="../assets/js/common-scripts.js"></script>
    <script type="text/javascript" src="../assets/js/data-confirm-modal.js"></script>
   
</body>
</html>