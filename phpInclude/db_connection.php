<?php
require_once('config.php');
try {
	
	$dsn = 'mysql:host='.$DB_HOST.';dbname='.$DB_DATABASE;
	
   // $conn = new PDO('mysql:host=localhost;dbname=four', $DB_USER, $DB_PASSWORD);
   $conn = new PDO($dsn, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	
	} 
	catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
	}
?>
