<?php 
	
	include_once 'include/connectdb.php';
	include_once 'sql_functions.php';
	session_start();

	$userCount = getUserCount($connect);
	echo $userCount;



?>