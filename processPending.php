<?php 
	include_once 'include/connectdb.php';
	include_once 'sql_functions.php';
	session_start();
	date_default_timezone_set("Asia/Kuching");

	$adminID = $_SESSION['adminID'];
	$listingID = htmlspecialchars($_GET['productid']);
	$sellerID = getSellerID($connect, $listingID);
	$command = htmlspecialchars($_GET['action']);
	$date = date('Y-m-d');
	$time = date('H:i:s');
	$noti_type = 1;

	$updateBookApproved = updateBookApproved($connect, $listingID, $command);

	if($updateBookApproved == 'true'){

		if($command == 'approve'){

			$message = "You have approved listing ID: ".$listingID;
			$usernoti = "Your listing was approved!";


		} else if($command == 'reject'){

			$rejectmsg = htmlspecialchars($_POST['reject-msg']);

			$message = "You have rejected listing ID: ".$listingID;
			$usernoti = "Your listing was rejected";


		}

		updateRejectMsg($connect, $listingID, $rejectmsg);
		insertAdminActivity($connect, $adminID, $message, $date, $time);
		insertNoti($connect, $sellerID, $date, $time, $usernoti, $noti_type);

		header("Location: listingApproval.php?updated=true");

	} else {
		echo "Unable to update book status";
	}



	//Update the book approve status either approve or reject
	//Add into admin activity that they have approved the book
	
?>