<?php
error_reporting(0);
$servername = $_SERVER['HTTP_HOST'];
$pathimg=$servername."/";
define("ROOT_PATH",$_SERVER['DOCUMENT_ROOT']);
define("UPLOAD_PATH","http://code-brew.com/projects/Qisma/");
define("BASE_PATH","http://code-brew.com/projects/Qisma/");

define('LOCALHOST','localhost');
define('USER_NAME','root');
define('USER_PASS','dkbose');
define('DB_NAME','Qisma_raju');
//define("UPLOAD_PATH","http://localhost/Qisma");
//define("BASE_PATH","http://localhost/Qisma");
define("CLIENT_ID","");
define("CLIENT_SECRET","");
define("V","");
define("AUTH_KEY","");
define("MAX_ID",9999999);

/*$DB_HOST = LOCALHOST;
$DB_DATABASE = DB_NAME;
$DB_USER = USER_NAME;
$DB_PASSWORD = USER_PASS;*/
$DB_HOST = 'localhost';
$DB_DATABASE = 'codebrew_Qisma';
$DB_USER = 'codebrew_super';
$DB_PASSWORD = 'core2duo';

define('SMTP_USER','pargat@code-brew.com');
define('SMTP_EMAIL','pargat@code-brew.com');
define('SMTP_PASSWORD','core2duo');
define('SMTP_NAME','Qisma');
define('SMTP_HOST','mail.code-brew.com');
define('SMTP_PORT','25');