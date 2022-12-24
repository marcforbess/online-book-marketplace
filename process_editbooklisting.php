<?php 
	include_once 'include/connectdb.php';
	include_once 'sql_functions.php';
	session_start();

	$listingID = htmlspecialchars($_POST['listing-id']);
	$listingIDenc = urlencode(base64_encode($listingID));
	$bookTitle = htmlspecialchars($_POST['ori-btitle']);
	$sellerID = htmlspecialchars($_POST['seller-id']);
	$edited = array();
	//echo "Listing ID is".$listingID;


	if(!empty($_POST['book-title'])){

		$newbooktitle = htmlspecialchars($_POST['book-title']);
		$sql = "UPDATE listing SET book_title = ? WHERE listing_id = ?;";
		array_push($edited, "Title");
		if(!updateUserDetails($connect, $sql, $listingID, $newbooktitle, "", 1)){
			echo "Error updating book title";
		}


	}if(!empty($_POST['book-price'])){

		$newbookprice = htmlspecialchars($_POST['book-price']);
		$sql = "UPDATE listing SET book_price = ? WHERE listing_id = ?;";
		if(!updateUserDetails($connect, $sql, $listingID, $newbookprice, "", 1)){
			echo "Error updating book title";
		}

	}if(!empty($_POST['book-authors'])){

		$newbookauthors = htmlspecialchars($_POST['book-authors']);
		$sql = "UPDATE listing SET book_authors = ? WHERE listing_id = ?;";
		array_push($edited, "Author");
		if(!updateUserDetails($connect, $sql, $listingID, $newbookauthors, "", 1)){
			echo "Error updating book price";
		}

	}if(!empty($_POST['book-isbn'])){

		$newbookisbn = htmlspecialchars($_POST['book-isbn']);
		$sql = "UPDATE listing SET book_isbn = ? WHERE listing_id = ?;";
		array_push($edited, "ISBN Number");
		if(!updateUserDetails($connect, $sql, $listingID, $newbookisbn, "", 1)){
			echo "Error updating book isbn";
		}

	}if(!empty($_POST['book-course'])){

		$newbookcourse = htmlspecialchars($_POST['book-course']);
		$sql = "UPDATE listing SET book_course = ? WHERE listing_id = ?;";
		array_push($edited, "Book Course");
		if(!updateUserDetails($connect, $sql, $listingID, $newbookcourse, "", 1)){
			echo "Error updating book course";
		}

	}if(!empty($_POST['book-subjectcode'])){

		$newbooksub = htmlspecialchars($_POST['book-subjectcode']);
		$sql = "UPDATE listing SET book_subjectcode = ? WHERE listing_id = ?;";
		array_push($edited, "Book Subject Code");
		if(!updateUserDetails($connect, $sql, $listingID, $newbooksub, "", 1)){
			echo "Error updating book subject code";
		}

	}if(!empty($_POST['book-desc'])){

		$newbookdesc = htmlspecialchars($_POST['book-desc']);
		$sql = "UPDATE listing SET book_description = ? WHERE listing_id = ?;";
		if(!updateUserDetails($connect, $sql, $listingID, $newbookdesc, "", 1)){
			echo "Error updating book description";
		}

	}

	//print_r($edited);
	//echo $message;


	//Notify users if admin changed the details
	if(isset($_SESSION['adminID'])){

		$editlist = join(", ", $edited);
		$messageuser = "The ".$editlist." of your book listing ".$bookTitle." was edited by an admin";
		$messageadmin = "You updated the ".$editlist." of book listing ID ".$listingID;
		$date = date('Y-m-d');
		$time = date('H:i:s');

		insertNoti($connect, $sellerID, $date, $time, $messageuser, 1);
		insertAdminActivity($connect, $_SESSION['adminID'], $messageadmin, $date, $time);


	}

	header("Location: viewProduct.php?productid=".$listingIDenc);

?>