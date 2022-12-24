<?php 
	
	/*function loginAdmin($connect, $adminemail, $adminpassword){

		$sql = "SELECT * FROM admin WHERE admin_email = ? LIMIT 1;";
		$infomatch = "";

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Unable to retrieve course details";

		} else {

			mysqli_stmt_bind_param($stmt, "s", $adminemail);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			if(){

			}

		}


	} */

	function getAdminCount($connect){

		$sql = "SELECT * FROM admin;";
		$result = mysqli_query($connect, $sql);

		$adminCount = mysqli_num_rows($result);
		return $adminCount;


	}

	function getAllAdmin($connect){

		$resultArray = array();
		$sql = "SELECT * FROM admin;";
		$result = mysqli_query($connect, $sql);

		if(mysqli_num_rows($result) > 0){

			while ($fetchedrow = mysqli_fetch_assoc($result)) {

				$resultArray[] = $fetchedrow;
			}

		}

		return $resultArray;


	}

	function getAdminDetails($connect, $adminID){

		$sql = "SELECT * FROM admin WHERE admin_id = ? LIMIT 1;";
		$resultArray = array();

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error getting admin details";
		} else {

			mysqli_stmt_bind_param($stmt, "s", $adminID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			while($fetchedrow = mysqli_fetch_assoc($result)){

				$resultArray[] = $fetchedrow;
			}

		}

		return $resultArray;

	}

	function getCourseDetails($connect, $course_id){

		$sql = "SELECT * FROM course WHERE  course_id = ?;";
		$resultArray = array();

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Unable to retrieve course details";

		} else {

			mysqli_stmt_bind_param($stmt, "s", $course_id);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			while($fetchedrow = mysqli_fetch_assoc($result)){

				$resultArray[] = $fetchedrow;
			}

		}

		return $resultArray;

	}

	function getCourseCount($connect){

		$sql = "SELECT * FROM course;";
		$result = mysqli_query($connect, $sql);

		$courseCount = mysqli_num_rows($result);
		return $courseCount;

	}


	function getAllCourse($connect){

		$sql = "SELECT * FROM course ORDER BY course_name ASC;";
		$resultArray = array();
		$result = mysqli_query($connect, $sql);

		while($fetchedrow = mysqli_fetch_assoc($result)){
			$resultArray[] = $fetchedrow;
		}

		return $resultArray;
		

	}

	function getAllUsers($connect){

		$sql = "SELECT * FROM users;";
		$resultArray = array();
		$result = mysqli_query($connect, $sql);

		while($fetchedrow = mysqli_fetch_assoc($result)){
			$resultArray[] = $fetchedrow;
		}

		return $resultArray;

	}

	function checkUserPwd($connect, $userID, $oldPw){

		$sql = "SELECT user_password FROM users WHERE user_id = ? LIMIT 1;";
		$pwdMatch = "false";

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error checking password";
		} else {

			mysqli_stmt_bind_param($stmt, "s", $userID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$fetchedrow = mysqli_fetch_assoc($result);

			if(password_verify($oldPw, $fetchedrow['user_password'])){
				$pwdMatch = "true";
			}
			

		}

		return $pwdMatch;

	} 


	function updateUserDetails($connect, $sql, $userID, $updateVar1, $updateVar2, $type){
		//$sql = "UPDATE users SET user_password = ? WHERE user_id = ?";
		$updateStatus = "false";

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error updating user details";

		} else {

			if($type == 1){ //Updating password/phonenum/course

				mysqli_stmt_bind_param($stmt, "ss", $updateVar1, $userID);

			} else { //Updating Name

				mysqli_stmt_bind_param($stmt, "sss", $updateVar1, $updateVar2, $userID);

			}

			
			mysqli_stmt_execute($stmt);
			$updateStatus = "true";
		}

		return $updateStatus;

	}

	function checkPhoneNoExist($connect, $phoneNum){

		$sql = "SELECT phone_num FROM users WHERE phone_num = ? LIMIT 1;";
		$phoneMatch = "false";

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error checking existing phone num";
		} else {

			mysqli_stmt_bind_param($stmt, "s", $phoneNum);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			if(mysqli_num_rows($result) == 1){

				$phoneMatch = "true";
			}
			

		}

		return $phoneMatch;


	}

	function getAllListing($connect){

		$sql = "SELECT * FROM listing WHERE book_approved = 1;";
		$resultArray = array();
		$result = mysqli_query($connect, $sql);

		while($fetchedrow = mysqli_fetch_assoc($result)){
			$resultArray[] = $fetchedrow;
		}

		return $resultArray;

	}

	function getSellerID($connect, $listingID){

		$sql = "SELECT * FROM listing WHERE listing_id = ? LIMIT 1;";
		$sellerID = "";

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error getting seller ID";
		} else {

			mysqli_stmt_bind_param($stmt, "s", $listingID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$fetchedrow = mysqli_fetch_assoc($result);

			$sellerID = $fetchedrow['user_id'];
			

		}

		return $sellerID; 

	}


	function getSellerDetails($connect, $listingID){

		$sellerID = getSellerID($connect, $listingID);

		$sql = "SELECT * FROM users WHERE user_id = ? LIMIT 1;";
		$resultArray = array();

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error getting seller details";
		} else {

			mysqli_stmt_bind_param($stmt, "s", $sellerID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			while($fetchedrow = mysqli_fetch_assoc($result)){

				$resultArray[] = $fetchedrow;
			}

		}

		return $resultArray;

	}

	function getDetailsFromID($connect, $buyerID){

		$sql = "SELECT * FROM users WHERE user_id = ? LIMIT 1;";
		$resultArray = array();

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error getting user/seller details";
		} else {

			mysqli_stmt_bind_param($stmt, "s", $buyerID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			while($fetchedrow = mysqli_fetch_assoc($result)){

				$resultArray[] = $fetchedrow;
			}

		}

		return $resultArray;

	}

	function checkUserExist($connect, $userID){
		//$count = 0;
		$sql = "SELECT * FROM users WHERE user_id = ? LIMIT 1;";

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error checking user exist";
		} else {

			mysqli_stmt_bind_param($stmt, "s", $userID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$count = mysqli_num_rows($result);
			

		}

		return $count; 


	}



	function getListingDetails($connect, $listingID){

		$sql = "SELECT * FROM listing WHERE listing_id = ? LIMIT 1;";
		$resultArray = array();

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error getting listing details";

		} else {

			mysqli_stmt_bind_param($stmt, "s", $listingID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			while($fetchedrow = mysqli_fetch_assoc($result)){

				$resultArray[] = $fetchedrow;
			}

		}

		return $resultArray;

	}

	function getMyListing($connect, $userID){

		$sql = "SELECT * FROM listing WHERE user_id = ?;";
		$resultArray = array();

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error getting my listing details";

		} else {

			mysqli_stmt_bind_param($stmt, "s", $userID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			while($fetchedrow = mysqli_fetch_assoc($result)){

				$resultArray[] = $fetchedrow;
			}

		}

		return $resultArray;



	}


	function getMyListingCount($connect, $userID){

		$getmyListingQuery = "SELECT * FROM listing WHERE user_id = '$userID'";
		$getmyListingQueryResult = mysqli_query($connect, $getmyListingQuery);

		$myListingCount = mysqli_num_rows($getmyListingQueryResult);

		return $myListingCount;
	}

	function getAvailableListing($connect, $userID, $type){

		$resultArray = array();

		$sql = "SELECT * FROM listing WHERE user_id = ? AND book_approved = 1;";
		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error getting user listings";

		} else {

			mysqli_stmt_bind_param($stmt, "s", $userID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$count = mysqli_num_rows($result);

			while($fetchedrow = mysqli_fetch_assoc($result)){

				$resultArray[] = $fetchedrow;
			}

		}

		if($type == 0){
			return $resultArray;

		} else {
			return $count;
		}
		


	}


	function getProfilePic($connect, $userID){

		$sql = "SELECT pic_path FROM profilepic WHERE user_id = ? LIMIT 1;";
		$picpath = "";

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error getting profile pic";
		} else {

			mysqli_stmt_bind_param($stmt, "s", $userID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$fetchedrow = mysqli_fetch_assoc($result);

			$picpath = $fetchedrow['pic_path'];
			

		}

		return $picpath; 
	}



	function getSidePics($connect, $listingID){

		$sql = "SELECT sidepicture_path FROM listing_sidepic WHERE listing_id = ?;";
		$resultArray = array();

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error getting side pics";

		} else {

			mysqli_stmt_bind_param($stmt, "s", $listingID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			while($fetchedrow = mysqli_fetch_assoc($result)){

				$resultArray[] = $fetchedrow;
			}

		}

		return $resultArray;

	}


	function getWishlistCount($connect, $userID){

		$getWishlistQuery = "SELECT * FROM wishlist WHERE user_id = '$userID';";
		$getWishlistQueryResult = mysqli_query($connect, $getWishlistQuery);
		$wishlistCount = mysqli_num_rows($getWishlistQueryResult);

		return $wishlistCount;
	}

	function getWishlistListingID($connect, $userID){

		$resultArray = array();
		$sql = "SELECT listing_id FROM wishlist WHERE user_id = '$userID';";
		$result = mysqli_query($connect, $sql);

		while($fetchedrow = mysqli_fetch_assoc($result)){
			$resultArray[] = $fetchedrow;
		}

		return $resultArray;
	}

	function insertOffer($connect, $listingID, $sellerID, $buyerID, $date, $time, $buyername, $offerprice){
		$offerID = "";
		$offerStatus = 0; //0(Sent) 1(Sold) 2(Rejected)
		$sql = "INSERT INTO offer(offer_id, listing_id, offerTo, offerFrom, offerStatus, offer_date, offer_time, offer_price) VALUES (?,?,?,?,?,?,?,?);";

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo 'Error inserting offer';

		} else {

			mysqli_stmt_bind_param($stmt, "ssssssss", $offerID, $listingID, $sellerID, $buyerID, $offerStatus, $date, $time, $offerprice);
			mysqli_stmt_execute($stmt);
			$noti_message = "You received an offer from ".$buyername;
			$noti_type = 0;

			insertNoti($connect, $sellerID, $date, $time, $noti_message, $noti_type);

		}

	}

	function checkOfferExist($connect, $sellerID, $buyerID, $listingID){

		$sql = "SELECT * FROM offer WHERE offerTo = ? AND offerFrom = ? AND listing_id = ? AND offerStatus=0 LIMIT 1;";
		$exist = "";

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo 'Error checking offer';

		} else {

			mysqli_stmt_bind_param($stmt, "sss", $sellerID, $buyerID, $listingID);
			mysqli_stmt_execute($stmt);

			$result = mysqli_stmt_get_result($stmt);

			if(mysqli_num_rows($result)==0){
				$exist = 'false';
			} else{
				$exist = 'true';
			}
		}

		return $exist;
	}


	function insertNoti($connect, $userID, $date, $time, $message, $noti_type){
		$notiID = "";
		$notiStatus = 0;
		//$noti_message = "You received an offer from ".$buyername;
		$sql = "INSERT INTO notifications(noti_id, noti_to, noti_message, noti_date, noti_time, noti_status, noti_type)VALUES(?,?,?,?,?,?,?);";

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo 'Error inserting notifications';

		} else {

			mysqli_stmt_bind_param($stmt, "sssssss", $notiID, $userID, $message, $date, $time, $notiStatus, $noti_type);
			mysqli_stmt_execute($stmt);

		}



	}

	function getNotiCount($connect, $userID){

		$sql = "SELECT * FROM notifications WHERE noti_to = ? AND noti_status = 0;";
		$notiCount = "";

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error getting notifications";

		} else {

			mysqli_stmt_bind_param($stmt, "s", $userID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$notiCount = mysqli_num_rows($result);
		}

		return $notiCount;

	}

	function loadNoti($connect, $userID){

		$sql = "SELECT * FROM notifications WHERE noti_to = ? ORDER BY noti_id DESC LIMIT 5;";
		$resultArray = array();

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error loading notifications";

		} else {

			mysqli_stmt_bind_param($stmt, "s", $userID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			if(mysqli_num_rows($result)>0){

				while($fetchedrow = mysqli_fetch_assoc($result)){

					$resultArray[] = $fetchedrow;
				}

			}


			
		}

		return $resultArray;


	}

	function updateNoti($connect, $userID){

		$sql = "UPDATE notifications SET noti_status = 1 WHERE noti_to = ?;";
		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo 'Error inserting notifications';

		} else {

			mysqli_stmt_bind_param($stmt, "s", $userID);
			mysqli_stmt_execute($stmt);

		}


	}

	function clearNoti($connect, $userID){

		$sql = "DELETE FROM notifications WHERE noti_to = ?;";
		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo 'Error clearing notifications';

		} else {

			mysqli_stmt_bind_param($stmt, "s", $userID);
			mysqli_stmt_execute($stmt);

		}

	}

	function getIncomingOffers($connect, $userID){
		$sql = "SELECT * FROM offer WHERE offerTo = ? AND offerStatus = 0;";
		$resultArray = array();

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error getting incoming offers";

		} else {

			mysqli_stmt_bind_param($stmt, "s", $userID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			if(mysqli_num_rows($result)>0){

				while($fetchedrow = mysqli_fetch_assoc($result)){

					$resultArray[] = $fetchedrow;
				}

			}

			

		}

		return $resultArray;


	}



	function getOutgoingOffers($connect, $userID){
		$sql = "SELECT * FROM offer WHERE offerFrom = ? ORDER BY offer_date DESC, offer_time DESC/*AND offerStatus = 0*/;";
		$resultArray = array();

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error getting outgoing offers";

		} else {

			mysqli_stmt_bind_param($stmt, "s", $userID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			if(mysqli_num_rows($result)>0){

				while($fetchedrow = mysqli_fetch_assoc($result)){

					$resultArray[] = $fetchedrow;
				}

			}

			

		}

		return $resultArray;


	}



	function updatebookAvailable($connect, $listingID){

		$sql = "UPDATE listing SET book_available = 0, book_approved = 3 WHERE listing_id = ?;";
		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo 'Error updating book available status';

		} else {

			mysqli_stmt_bind_param($stmt, "s", $listingID);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

	}

	function sameBookOffers($connect, $acceptedOfferID, $listingID){

		$sql = "UPDATE offer SET offerStatus = 3 WHERE listing_id = ? AND offer_id!=?;";
		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo 'Error marking as sold out';

		} else {

			mysqli_stmt_bind_param($stmt, "ss", $listingID, $acceptedOfferID);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

	}

	function removeWishlist($connect, $sql, $userID, $listingID, $type){

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo 'Error removing from wishlist';

		} else {

			if($type == 1){ //Remove single

				mysqli_stmt_bind_param($stmt, "ss", $userID, $listingID);

			} else if($type == 0){ // Remove entire 

				mysqli_stmt_bind_param($stmt, "s", $userID);

			} else if($type == 2){ //Remove listing from all users wishlist

				mysqli_stmt_bind_param($stmt, "s", $listingID);
			}

			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}



	}

	function cancelOffer($connect, $var, $sql){
		//$sql = "DELETE FROM offer WHERE offer_id = ?;";
		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo 'Error deleting offer';

		} else {

			mysqli_stmt_bind_param($stmt, "s", $var);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

	}

	function updateOfferStatus($connect, $offerID, $statusint){

		$sql = "UPDATE offer SET offerStatus = ? WHERE offer_id = ?;";
		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo 'Error updating offer status';

		} else {

			mysqli_stmt_bind_param($stmt, "ss", $statusint, $offerID);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}


	}

	function insertTransaction($connect, $offerID, $datetime, $ratestatus){

		$sql = "INSERT INTO transactions(tsc_id, offer_id, tsc_datetime, rate_status) VALUES (?,?,?,?)";
		$autoinc = "";
		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo 'Error inserting into transactions table';

		} else {

			mysqli_stmt_bind_param($stmt, "ssss", $autoinc, $offerID, $datetime, $ratestatus);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

	}

	function checkOfferStatus($connect, $offerID){

		$status = "true";
		$sql = "SELECT offerStatus FROM offer WHERE offer_id = ? LIMIT 1;";
		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo 'Error checking offer status';

		} else {

			mysqli_stmt_bind_param($stmt, "s", $offerID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_assoc($result);
			$offerstatus = $row['offerStatus'];

			if($offerstatus != 0){

				$status = "false";

			} 
			mysqli_stmt_close($stmt);
		}

		return $status;


	}


	/*function offerAction($connect, $sql, $offerID, $listingID, $command){

		//accept sql : update offer set offerstatus = 1 where offerid = foo
		//reject sql : update offer set offerStatus = 2 where offerid = foo
		//cancel sql : delete from offer where offerid = foo

		$stmt = mysqli_stmt_init($sql);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error processing offer action";

		} else {

			if ($command == 'accept') {

				mysqli_stmt_bind_param($stmt, "");

				
			} else if($command == 'reject'){

			} else if($command == 'cancel'){

			}

			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);


		}

	} */



	function getInOfferCount($connect, $userID){

		$sql = "SELECT * FROM offer WHERE offerTo = ? AND offerStatus = 0;";
		$count = "";

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error getting incoming offers count";

		} else {

			mysqli_stmt_bind_param($stmt, "s", $userID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$count = mysqli_num_rows($result);
		}

		return $count;


	}


	function getOutOfferCount($connect, $userID){

		$sql = "SELECT * FROM offer WHERE offerFrom = ?;";
		$count = "";

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error getting incoming offers count";

		} else {

			mysqli_stmt_bind_param($stmt, "s", $userID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$count = mysqli_num_rows($result);
		}

		return $count;


	}

	function getPendingCount($connect){


		$sql = "SELECT * FROM listing WHERE book_approved = 0;";
		$result = mysqli_query($connect, $sql);

		$pendingCount = mysqli_num_rows($result);
		return $pendingCount;

	}

	function getUserCount($connect){

		$sql = "SELECT * FROM users;";
		$result = mysqli_query($connect, $sql);

		$userCount = mysqli_num_rows($result);
		return $userCount;


	}

	function getListingCount($connect){

		$sql = "SELECT * FROM listing WHERE book_approved = 1;";
		$result = mysqli_query($connect, $sql);

		$listingCount = mysqli_num_rows($result);
		return $listingCount;



	}

	function getPendingListing($connect){

		$resultArray = array();

		$sql = "SELECT * FROM listing WHERE book_approved = 0;";
		$result = mysqli_query($connect, $sql);

		while($fetchedrow = mysqli_fetch_assoc($result)){

			$resultArray[] = $fetchedrow;

		}

		return $resultArray;



	}

	function updateBookApproved($connect, $listingID, $command){

		$status = "";

		if($command == 'approve'){

			$sql = "UPDATE listing SET book_approved = 1 WHERE listing_id = ?;";


		} else if($command == 'reject'){

			$sql = "UPDATE listing SET book_approved = 2 WHERE listing_id = ?;";

		}

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			echo "Error updating book approval status";
			$status = "false";
		} else {

			mysqli_stmt_bind_param($stmt, "s", $listingID);
			mysqli_stmt_execute($stmt);
			$status = "true";
		}

		return $status;


	}

	function insertAdminActivity($connect, $adminID, $message, $date, $time){

		$activity_id = "";
		$sql = "INSERT INTO admin_activity(activity_id, activity_message, activity_date, activity_time, admin_id)VALUES(?,?,?,?,?);";

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo 'Error inserting activity';

		} else {

			mysqli_stmt_bind_param($stmt, "sssss", $activity_id, $message, $date, $time, $adminID);
			mysqli_stmt_execute($stmt);

		}

		mysqli_stmt_close($stmt);

	}

	function getAdminActivity($connect, $adminID){

		$resultArray = array();
		//$sql = "SELECT * FROM admin_activity WHERE admin_id = ? ORDER BY activity_date, activity_time DESC;";
		$sql = "SELECT * FROM admin_activity WHERE admin_id = ? ORDER BY admin_activity.activity_date DESC;";
		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo 'Error getting activity';

		} else {

			mysqli_stmt_bind_param($stmt, "s", $adminID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			if(mysqli_num_rows($result) == 0){

				echo 'No activity yet!';

			} else {

				while ($fetchedrow = mysqli_fetch_assoc($result)) {
					$resultArray[] = $fetchedrow;
				}

			}

		}

		mysqli_stmt_close($stmt);

		return $resultArray;

	}

	function getMyTransactions($connect, $userID, $type){

		$resultArray = array();

		if($type == 0){ //Get books user sold

			$sql = "SELECT transactions.tsc_id, offer.offer_id,offer.listing_id, offer.offerTo AS sellerID, offer.offerFrom AS buyerID, users.user_picpath AS buyerImg,users.user_fname AS buyerfname, users.user_lname AS buyerlname,users.phone_num AS buyerphone, listing.book_imgpath AS bookImg,listing.book_title AS bookTitle, listing.book_isbn AS bookISBN, offer.offer_price AS offerPrice ,offer.offer_date, offer_time, transactions.rate_status FROM users, offer,listing,transactions WHERE (offer.offerTo = ? AND offer.offerStatus = 1) AND (users.user_id = offer.offerFrom) AND (listing.listing_id = offer.listing_id) AND (offer.offer_id = transactions.offer_id);
";

		} else if($type == 1){ //Get books user bought
			$sql = "SELECT transactions.tsc_id, offer.offer_id, offer.listing_id, offer.offerTo AS sellerID, offer.offerFrom AS buyerID, users.user_picpath AS sellerImg,users.user_fname AS sellerfname, users.user_lname AS sellerlname,users.phone_num AS sellerphone, listing.book_imgpath AS bookImg,listing.book_title AS bookTitle,listing.book_isbn AS bookISBN, offer.offer_price AS offerPrice ,offer.offer_date, offer_time, transactions.rate_status FROM users, offer,listing,transactions WHERE (offer.offerFrom = ? AND offer.offerStatus = 1) AND (users.user_id = offer.offerTo) AND (listing.listing_id = offer.listing_id) AND (offer.offer_id = transactions.offer_id);
";
		}


		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo 'Error getting transactions';

		} else {

			mysqli_stmt_bind_param($stmt, "s", $userID);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			if(mysqli_num_rows($result) > 0){

				while ($fetchedrow = mysqli_fetch_assoc($result)) {
					$resultArray[] = $fetchedrow;
				}
				

			} 

		}

		mysqli_stmt_close($stmt);

		return $resultArray;

	}

	function getInfoFromTscID($connect, $tscid){
		$resultArray = array();
		$sql = "SELECT transactions.tsc_id, offer.offer_id, offer.listing_id, offer.offerTo AS sellerID, offer.offerFrom AS buyerID, users.user_picpath AS sellerImg,users.user_fname AS sellerfname, users.user_lname AS sellerlname,users.phone_num AS sellerphone, listing.book_imgpath AS bookImg,listing.book_title AS bookTitle,listing.book_isbn AS bookISBN, offer.offer_price AS offerPrice ,offer.offer_date, offer_time, transactions.rate_status, transactions.tsc_datetime FROM users, offer,listing,transactions WHERE (transactions.tsc_id = ?) AND (users.user_id = offer.offerTo) AND (listing.listing_id = offer.listing_id) AND (offer.offer_id = transactions.offer_id);
";

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo 'Error getting info from transactions ID';

		} else {

			mysqli_stmt_bind_param($stmt, "s", $tscid);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			if(mysqli_num_rows($result) > 0){

				while ($fetchedrow = mysqli_fetch_assoc($result)) {
					$resultArray[] = $fetchedrow;
				}
				

			} 

		}

		mysqli_stmt_close($stmt);
		return $resultArray;


	}

	function updateRateStatus($connect, $tscid){

		$sql = "UPDATE transactions SET rate_status = 1 WHERE tsc_id = ?;";
		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			echo "Error updating rating status";
		} else {

			mysqli_stmt_bind_param($stmt, "s", $tscid);
			mysqli_stmt_execute($stmt);
		}

		mysqli_stmt_close($stmt);


	}

	function insertRating($connect, $var1, $var2, $var3, $var4, $var5, $type){
		$autoinc = "";

		if($type == 0){ //Book Rating

			$sql = "INSERT INTO rate_book (rb_id, book_isbn, ratedBy, book_rating, book_review, rb_datetime) VALUES (?,?,?,?,?,?);";

		} else if($type == 1){ // User Rating

			$sql = "INSERT INTO rate_user (ru_id, ratingTo, ratingFrom, user_rating, user_review, ru_datetime) VALUES (?,?,?,?,?,?);";

		}


		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error inserting rating";

		} else {

				mysqli_stmt_bind_param($stmt, "ssssss",$autoinc, $var1, $var2, $var3, $var4, $var5);

				mysqli_stmt_execute($stmt);
		}

		mysqli_stmt_close($stmt);


	}

	function getReviews($connect, $userID){
		$resultArray = array();
		$sql = "SELECT * FROM rate_user WHERE ratingTo = ?;";

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error getting reviews";

		} else {

				mysqli_stmt_bind_param($stmt, "s", $userID);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);

				if(mysqli_num_rows($result) > 0){

				while ($fetchedrow = mysqli_fetch_assoc($result)) {
					$resultArray[] = $fetchedrow;
				}
				

			} 
		}


		mysqli_stmt_close($stmt);
		return $resultArray;


	}

	function getReviewsCount($connect, $userID){

		$count = "";
		$sql = "SELECT * FROM rate_user WHERE ratingTo = ?;";

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error getting reviews count";

		} else {

				mysqli_stmt_bind_param($stmt, "s", $userID);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				$count = mysqli_num_rows($result);

				
		}

		return $count;
		mysqli_stmt_close($stmt);



	}

	function getAverageRating($connect, $userID){

		$avg = "";
		$sql = "SELECT CAST(AVG(user_rating) AS DECIMAL(2,1)) AS avg FROM rate_user WHERE ratingTo = ?;";

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error getting average rating";

		} else {

				mysqli_stmt_bind_param($stmt, "s", $userID);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				//$count = mysqli_num_rows($result);
				$row = mysqli_fetch_assoc($result);

				if($row['avg'] == NULL){
					return 0.0;

				} else {
					$avg = $row['avg'];

				}

				

				
		}

		return $avg;
		mysqli_stmt_close($stmt);



	}

	function updateRejectMsg($connect, $listingID, $message){

		$sql = "UPDATE listing SET reject_message = ? WHERE listing_id = ?;";
		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo 'Error updating reject message';

		} else {

			mysqli_stmt_bind_param($stmt, "ss", $message,$listingID);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);

		}



	}

	function getCategory($connect){
		$resultArray = array();
		$sql = "SELECT * FROM category ORDER BY cat_name ASC;";
		$result = mysqli_query($connect, $sql);

		while($row = mysqli_fetch_assoc($result)){

			$resultArray[] = $row;

		}

		return $resultArray;

	}

	function getCategoryName($connect, $cat_id){
		
		$sql = "SELECT cat_name FROM category WHERE cat_id = ? LIMIT 1;";
		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo 'Error getting category name';

		} else {

			mysqli_stmt_bind_param($stmt, "s", $cat_id);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_assoc($result);
			$name = $row['cat_name'];
			mysqli_stmt_close($stmt);

		}

		return $name;
	}


	function checkCategoryExist($connect, $categoryName){
		$sql = "SELECT cat_name FROM category WHERE cat_name = ? LIMIT 1;";
		$catMatch = "false";

		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo "Error checking existing category";
		} else {

			mysqli_stmt_bind_param($stmt, "s", $categoryName);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			if(mysqli_num_rows($result) == 1){

				$catMatch = "true";
			}
			

		}

		return $catMatch;
	}

	function addCategory($connect, $newCategory){
		$autoinc = "";
		$sql = "INSERT INTO category(cat_id, cat_name) VALUES (?,?);";
		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){

			echo 'Error inserting category';

		} else {

			mysqli_stmt_bind_param($stmt, "ss", $autoinc,$newCategory);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);

		}


	}





?>