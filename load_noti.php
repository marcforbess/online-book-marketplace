<?php 
	
	include_once 'include/connectdb.php';
	include_once 'sql_functions.php';
	session_start();
	$userID = $_SESSION['userID'];

	if(isset($_GET['cm'])){

		$command = htmlspecialchars(base64_decode(urldecode($_GET['cm'])));
		if($command == 'clear'){

			clearNoti($connect, $userID);

		}

	}


	$loadNoti = loadNoti($connect, $userID);
	foreach ($loadNoti as $row) {

		$noti_message = $row['noti_message'];
		$noti_date = $row['noti_date'];
		$noti_time = $row['noti_time'];
		$noti_type = $row['noti_type']; //0 for offers, 1 for approved/rejected
		$timeFormat = date('g:i A', strtotime($noti_time));
		$dateFormat = date('d M Y', strtotime($noti_date));

		if($noti_type == 0){

			echo '<a href="offers.php" class="text-decoration-none"><span class="noti-font"><strong>'.$noti_message.'</strong></span></a><br>';
			//echo '<span class="noti-font text-muted">'.$dateFormat.' '.$timeFormat.'</span>';
			//echo '<hr class="dropdown-divider"></hr>';

		} else if ($noti_type == 1){

			echo '<a href="history_profile.php" class="text-decoration-none"><span class="noti-font"><strong>'.$noti_message.'</strong></span></a><br>';
			//echo '<span class="noti-font text-muted">'.$dateFormat.' '.$timeFormat.'</span>';
			//echo '<hr class="dropdown-divider"></hr>';


		} else if ($noti_type == 2){

			echo '<a href="transactions.php" class="text-decoration-none"><span class="noti-font"><strong>'.$noti_message.'</strong></span></a><br>';

		} else if($noti_type == 3){

			echo '<a href="offers.php?tab2active=true" class="text-decoration-none"><span class="noti-font"><strong>'.$noti_message.'</strong></span></a><br>';

		} else if ($noti_type == 4){

			echo '<span class="noti-font"><strong>'.$noti_message.'</strong></span><br>';


		} 

		//echo '<a href="offers.php" class="text-decoration-none"><span class="noti-font"><strong>'.$noti_message.'</strong></span></a><br>';
		echo '<span class="noti-font text-muted">'.$dateFormat.' '.$timeFormat.'</span>';
		echo '<hr class="dropdown-divider"></hr>';


	}

	$updateNoti = updateNoti($connect, $userID);
	
	//echo '<span class="noti-font"><strong>Amazon Web sent an offer</strong></span>';
   	//echo '<span class="noti-font text-muted">24/10/2022 8:49 pm</span>';
	//echo '<hr class="dropdown-divider"></hr>';

?>