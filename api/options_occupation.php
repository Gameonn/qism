<?php
require_once('../phpInclude/db_connection.php');
require_once('../classes/AllClasses.php');

/*
store to suggestions table
sending mail ??
*/



$option = new Options;
$occupations=$option->getOccupation();
$success='1';$msg='success';

echo json_encode(array('success'=>$success,'msg'=>$msg,'options'=>$occupations));
?>