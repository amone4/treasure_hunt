<?php

session_start();
date_default_timezone_set('Asia/Kolkata');

DEFINE('hostname','localhost');
DEFINE('database','scimatics_new');
DEFINE('username','root');
DEFINE('password','');

if (!$conn=mysqli_connect(hostname,username,password,database)) {
	die('some error occurred while connecting to the database');
}

?>