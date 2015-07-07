<?php

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Import Excel</title>
</head>
<body>

<?php
/************************ YOUR DATABASE CONNECTION START HERE   ****************************/
require_once "../phpInclude/db_connection.php";
//error_reporting(E_ALL);
$databasetable = "test";

/************************ YOUR DATABASE CONNECTION END HERE  ****************************/


//set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
require_once 'Classes/PHPExcel/IOFactory.php';

// This is the file path to be uploaded.
$inputFileName = $_FILES['file']['name']; 

try{
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}


$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet


for($i=2;$i<=$arrayCount;$i++){
$userName = trim($allDataInSheet[$i]["A"]);
$userMobile = trim($allDataInSheet[$i]["B"]);


$sql = "SELECT name FROM test WHERE name=:name and email=:email";
$sth=$conn->prepare($sql);

$sth->bindValue('name',$userName);
$sth->bindValue('email',$userMobile);
try{$sth->execute();}
catch(Exception $e){
echo $e->getMessage();
}
$recResult=$sth->fetchAll();

if(!count($recResult)) {
$sql="insert into test(id,name,email) values(DEFAULT,:name,:email)";
$sth=$conn->prepare($sql);
$sth->bindValue('name',$userName);
$sth->bindValue('email',$userMobile);
try{$sth->execute();}
catch(Exception $e){
echo $e->getMessage();
}
die;

$msg = 'Record has been added. <div style="Padding:20px 0 0 0;"><a href="">Go Back to tutorial</a></div>';
} else {
$msg = 'Record already exist. <div style="Padding:20px 0 0 0;"><a href="">Go Back to tutorial</a></div>';
}
}
echo "<div style='font: bold 18px arial,verdana;padding: 45px 0 0 500px;'>".$msg."</div>";
 

?>
<body>
</html>