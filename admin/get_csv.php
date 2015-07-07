<?php
header("Content-Type: text/csv");
header('Content-disposition: attachment;filename=user_details.csv');

require_once("../phpInclude/db_connection.php");
require_once('csv_func.php');
require_once('SortClass.php');


	$resultSet = SortClass::getUsers();
	$header = array("ID","Username","Email","Gender","DOB","Location","is_blocked","Country");
	$fp = fopen("php://output", "w");
   	fputcsv ($fp, $header, ",");
   	foreach($resultSet as $row){
   		$data=array($row['id'],
   				$row['username'],
   				$row['email'],
   				$row['gender'],
   				$row['dob'],
   				$row['location'],
   				$row['is_blocked'],
   				$row['country']);
        	fputcsv($fp, $data, ",");
  	 }
  	 fclose($fp);
   	
