<?php 
	
	include_once 'include/connectdb.php';
	include_once 'sql_functions.php';
	date_default_timezone_set("Asia/Kuching");
	session_start();

	$userID = $_SESSION['userID'];
	$command = htmlspecialchars($_GET['command']);

	if($command == 'accept'){

		$datetime = date('Y-m-d H:i');
		$date = date('Y-m-d');
		$time = date('H:i');
		$buyerID = htmlspecialchars($_GET['buyerid']);
		$listingID = htmlspecialchars($_GET['productid']);
		$offerID = htmlspecialchars($_GET['offerid']);
		$bookTitle = htmlspecialchars($_GET['booktitle']);
		//set offer to 1 (accepted)
		//set other offers on the same book to 3 (out of stock)
		//insert into transaction table
		//notify buyer
		updatebookAvailable($connect, $listingID);
		updateOfferStatus($connect, $offerID, 1);
		sameBookOffers($connect, $offerID, $listingID);
		insertTransaction($connect, $offerID, $datetime, 0);

		$wishlistQuery = "DELETE FROM wishlist WHERE listing_id = ?;";
		removeWishlist($connect, $wishlistQuery, $userID, $listingID, 2);

		$messageSeller = "You accepted an offer for ".$bookTitle;
		insertNoti($connect, $userID, $date, $time, $messageSeller, 2);

		$messageBuyer = "Your offer price for ".$bookTitle." was accepted!";
		insertNoti($connect, $buyerID, $date, $time, $messageBuyer, 2);
		header("Location:offers.php?accepted=success");


	} else if ($command == 'reject'){

		$datetime = date('Y-m-d H:i');
		$date = date('Y-m-d');
		$time = date('H:i');
		$buyerID = htmlspecialchars($_GET['buyerid']);
		//$listingID = htmlspecialchars($_GET['productid']);
		$offerID = htmlspecialchars($_GET['offerid']);
		$bookTitle = htmlspecialchars($_GET['booktitle']);
		//set offer status to 2 (rejected)
		//notify buyer
		updateOfferStatus($connect, $offerID, 2);

		$messageSeller = "You rejected an offer for ".$bookTitle;
		insertNoti($connect, $userID, $date, $time, $messageSeller, 4);

		$messageBuyer = "Your offer price for ".$bookTitle." was rejected!";
		insertNoti($connect, $buyerID, $date, $time, $messageBuyer, 3);
		header("Location:offers.php?accepted=success");

		//echo "Hello reject";

	} else if ($command == 'cancel'){

		$username = $_SESSION['userfname'];
		$offerID = htmlspecialchars($_GET['offerid']);
		$bookTitle = htmlspecialchars($_GET['booktitle']);
		$sellerID = htmlspecialchars($_GET['sellerid']);
		$date = date('Y-m-d');
		$time = date('H:i');

		//Check if seller has already accepted or rejected offer
		$status = checkOfferStatus($connect, $offerID);

		if($status == "false"){

			echo "<h1>Error: Seller has already taken action</h1>";

			echo '<meta http-equiv="refresh" content="2;URL=\'offers.php?tab2active=true\'">';


		} else {

			$messageSeller = $username." retracted their offer price for ".$bookTitle;
			insertNoti($connect, $sellerID, $date, $time, $messageSeller, 4);

			$sql = "DELETE FROM offer WHERE offer_id = ?;";
			cancelOffer($connect, $offerID, $sql);
			header("Location:offers.php?tab2active=true");


		}

		//notify seller (retracted offer for $bookTitle)
		//run a check to see if offer is accepted or rejected already
		//header("Location:offers.php?tab2active=true");



	} else if($command == 'remove'){

		$offerID = htmlspecialchars($_GET['offerid']);
		$sql = "DELETE FROM offer WHERE offer_id = ?;";
		cancelOffer($connect, $offerID, $sql);
		header("Location:offers.php?tab2active=true");

	}


?>

