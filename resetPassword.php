<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.ico">

    <title>Qisma</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    
    <!-- Admin CSS-->
    <link href="admin/css/AdminLTE.css" rel="stylesheet" type="text/css">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        
      </div>
    </nav>
<div class="jumbotron fullscreen-img">
	<div class="container">
        <h2>Reset Password</h2>
	<!--<h1>Your college life is exclusive again!</h1>
  	<p class="lead">What is EmBazaar? Glad you asked. Its an exclusive social community just for your college or university. Make new friends, attend cool events, sell or trade stuff in the student only bazaar and always stay connected to news and social gossip on campus. It's the best thing to hit your campus since sliced bread!</p>-->
  <!--  temp -->
  <?php
require_once('phpInclude/db_connection.php');
require_once('classes/AllClasses.php');

$key=$_REQUEST['token'];

if(isset($_POST['cc']) && ($_POST['cc']!='')){
	
	global $conn;
	$cc=$_POST['cc'];
	$pass=$_POST['new_pass'];
	$c_pass=$_POST['conf_pass'];
	
	if(($pass == $c_pass) && !empty($pass)){
		$confirm_code=GeneralFunctions::generateRandomString();
		$pass=md5($pass);
		$sql="SELECT email from `user` WHERE pass_reset_key='{$cc}'";
		$result=$conn->query($sql);
		$row = $result->fetch(PDO::FETCH_ASSOC);

		if($result->rowCount() == 1){
			$sql="UPDATE `user` SET password=:pass,pass_reset_key=:confirm_code WHERE pass_reset_key=:cc";
			$sth = $conn->prepare($sql);
			$sth->bindParam(':pass',$pass);
			$sth->bindParam(':confirm_code',$confirm_code);
			$sth->bindParam(':cc',$cc);
			try{
				
			}catch(Exception $e){
				echo $e->getMessage();die;
				}
			$result=$conn->query($sql);
		}else{
			//password not changed//
			echo '<div style="margin-left:0px;display: inline-block;opacity:0.8;" class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Error Occured! Key not valid</div>';
			//echo '<b style="color: #CC2828;">Error Occured! Key not valid</b>';
		}
		
	}else{
	        echo '<div style="margin-left:0px;display: inline-block;opacity:0.8;" class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Password don\'t Match</div>';
		//echo '<b style="color: #CC2828;">Password don\'t Match</b>';
		header('location:resetPassword.php?key='.$key);
	}
}
?>
<script>
var formValidation = function() {
    if (document.getElementById('new_pass').value == "") {
        alert('Empty Password');
        return false;
    }
    if (document.getElementById('conf_pass').value == "") {
        alert('Empty Password');
        return false;
    }
    if (document.getElementById('new_pass').value != document.getElementById('conf_pass').value) {
        alert('Passwords Not Match');
        return false;
    }
    else {
        return true;
    }
} 
</script>
<style>
table{
margin: 0px auto;
line-height: 2;
}
td{
 padding:10px;
}
 
input[type="password"]{
opacity: 0.4;
border-radius: 22px;
color: black;
width: 100%;
padding: 0px 10px;
}
</style>
<div>
<form action="" method="post" onSubmit="return formValidation()">
	<input type="hidden" name="cc" value="<?php echo $key;?>"/>
	<table>
	<tr>
	<td><label>New Password</label></td><td><input type="password" name="new_pass" id="new_pass"/></td>
	</tr>
	<tr>
	<td><label>Confirm Password</label></td><td><input type="password" name="conf_pass" id="conf_pass"/></td>
	</tr>
	<tr>
	<td></td>
	<td><input class="btn btn-primary btn-large" style="border-radius: 15px;width: 100px;height: 35px;opacity: .8;"type="submit" value="Save"/> </td>
	</tr>
	</table>	
</form>
</div>

  
  <!--  temp -->
  	</div>
  

</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/docs.min.js"></script>
  </body>
</html>
