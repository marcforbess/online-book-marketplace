<?php 
	
	include_once 'include/connectdb.php';
	include_once 'sql_functions.php';
	session_start();

	$listingCount = getListingCount($connect);
	echo $listingCount;



?>