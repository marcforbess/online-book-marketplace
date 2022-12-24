<?php 
	include_once 'include/connectdb.php';
	include_once 'sql_functions.php';
	session_start();

	$userID = $_SESSION['userID'];
	$notiCount = getNotiCount($connect, $userID);

	if($notiCount!=0){
		echo $notiCount;
	}


?>