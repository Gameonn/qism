<?php
session_start();


if(!isset($_SESSION['admin']) ){
	$success=0;
	$msg="Signed Out! Sign In Again!";
	?> <script> window.location.href="index.php"; </script> <?php
	//header("Location: index.php?success=$success&msg=$msg");
}
?>
<!DOCTYPE html>
<html>
      <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Qisma</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet" type='text/css'>
    <!--external css-->
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" type='text/css' />
    <link rel="stylesheet" type="text/css" href="../assets/js/gritter/css/jquery.gritter.css" type='text/css' />
    
    <link rel="stylesheet" type="text/css" href="../assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="../assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="../assets/lineicons/style.css">      
    <!-- Custom styles for this template -->
    <link href="../assets/css/style.css" rel="stylesheet" type='text/css'>
    <link href="../assets/css/style-responsive.css" rel="stylesheet" type='text/css'>
    <link rel="stylesheet" href="../assets/css/to-do.css" rel="stylesheet" type='text/css'>
	<link href="../assets/js/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" />
	
    <link href="../assets/css/table-responsive.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css"> 
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
         <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg" >
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b>QISMA</b></a>
            <!--logo end-->

            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="<?php echo BASE_PATH; ?>admin/eventHandler.php?event=signout">Logout</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->