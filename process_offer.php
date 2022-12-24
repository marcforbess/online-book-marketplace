<?php 
	include_once 'include/connectdb.php';
	include_once 'sql_functions.php';
	session_start();

	date_default_timezone_set("Asia/Kuching");
	$date = date('Y-m-d');
	$time = date('H:i');
	$listingID = htmlspecialchars($_POST['listingID']);
	//$listingID = htmlspecialchars(base64_decode(urldecode($_POST['listingID'])));
	$buyerID = htmlspecialchars($_POST['sender']);
	$buyername = htmlspecialchars($_POST['senderFirstName']);
	$sellerID = htmlspecialchars($_POST['recipientID']);
	$sellerName = htmlspecialchars($_POST['recipientFirstName']);
	$offerprice = htmlspecialchars($_POST['offerprice']);
	$command = htmlspecialchars($_POST['command']);


	//$sql = "INSERT INTO dummy(randomnum, current) VALUES ('$listingID','$time');";
	//$result = mysqli_query($connect, $sql);

	$checkExist = checkOfferExist($connect, $sellerID, $buyerID, $listingID);

	if($checkExist == 'true'){

		echo '<span>You already sent an offer to '.$sellerName.' earlier!</span>';

	} else {

		insertOffer($connect, $listingID, $sellerID, $buyerID, $date, $time, $buyername, $offerprice);

		if($command == 'normal-offer'){

			echo '<span>Your offer was successfully sent to '.$sellerName.'!</span>';

		} else if($command == 'custom-offer'){

			echo '<span>Your custom offer was successfully sent to '.$sellerName.'!</span>';

		}

		

	}

	//echo '<span>Your offer was successfully sent to '.$sellerName.'!</span>';

	//echo '<span>Your offer was successfully sent to Edly</span>';

?>