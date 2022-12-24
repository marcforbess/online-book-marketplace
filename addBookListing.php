<?php 
	include_once 'include/connectdb.php';
	session_start();

	$chosenCourse = htmlspecialchars($_POST['book-condition']);

	if(isset($_POST['confirm'])){
		//echo 'This book is '.$chosenCourse;

	$userid = htmlspecialchars($_SESSION['userID']);
	$listingDate = date("Y-m-d");
	$listingType = htmlspecialchars($_POST['type-of-sale']);
	$bookCourse = htmlspecialchars($_POST['course-code']);
	$bookSubject = htmlspecialchars($_POST['subject-code']);
	$bookCondition = htmlspecialchars($_POST['book-condition']);
	$bookISBN = htmlspecialchars($_POST['isbn-no']);
	$bookAuthors = htmlspecialchars($_POST['author']);
	$bookTitle = htmlspecialchars($_POST['title']);
	$bookPrice = htmlspecialchars($_POST['price']);
	$bookDesc = htmlspecialchars($_POST['description']);
	//$picStatus = 1;
	$newpicname = "";
	$bookAvailable = 1;
	$autoinc = "";

	//ADMIN BOOK APPROVED STATUS LEGEND: 0-PENDING 1-ACCEPTED 2-REJECTED 3-SOLD? (Still unclear yet. Will decide soon)
	$bookApproved = 0;

	$bookpic = $_FILES['uploadbookpic'];

		//Get neccessary info about uploaded picture
		$bookpicName = $_FILES['uploadbookpic']['name'];
		$bookpicTmp = $_FILES['uploadbookpic']['tmp_name'];
		$bookpicSize = $_FILES['uploadbookpic']['size'];
		$bookpicError = $_FILES['uploadbookpic']['error'];
		$bookpicType = $_FILES['uploadbookpic']['type'];

		//Separate the filename from the format e.g. .jpg .png etc.
		//Ext stands for extension (basically the file extension or format)
		$bookpicExt = explode('.', $bookpicName);

		//This will take the file format and make it lowercase e.g. JPG -> jpg
		$bookpicExtLowercase = strtolower(end($bookpicExt)); 

		//Allowed format that is eligible for upload
		$allowedFormat = array('jpg', 'jpeg', 'png');
		$newpicname = "";

		//Check if the uploaded image extension is in the allowed array
		if(in_array($bookpicExtLowercase, $allowedFormat)){

			if($bookpicError == 0){

				if($bookpicSize < 1000000){	

					$newpicname = uniqid('', true).".".$bookpicExtLowercase;
					//$newpicname = "profile".$userid.".".$profilepicExtLowercase;
					$picdestination = 'listing/'.$newpicname;
					move_uploaded_file($bookpicTmp, $picdestination);
					echo '<h1>Book Listing Successfully Uploaded</h1><br>';
					//$changepicstatus = "UPDATE profilepic SET STATUS=1 WHERE user_id = '$userid'";
					//mysqli_query($connect, $changepicstatus);
					//header("Location: history_profile.php?success");

				} else{

					echo "File size too large";
				}

			} else{
				echo "An error has occurred";
			}

		} else{
			echo "Only jpg image formats are allowed";
		}





		$addBookQuery = "INSERT INTO listing (listing_id, user_id, listing_date, book_category, book_course, book_subjectcode, book_condition, book_isbn, book_authors, book_title, book_price, book_description, book_imgpath, book_available, book_approved) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$stmt = mysqli_stmt_init($connect);

		if(!mysqli_stmt_prepare($stmt, $addBookQuery)){

			echo 'Error connecting to db';

		} else {

			mysqli_stmt_bind_param($stmt, "sssssssssssssss", $autoinc, $userid, $listingDate, $listingType, $bookCourse, $bookSubject, $bookCondition, $bookISBN, $bookAuthors, $bookTitle, $bookPrice, $bookDesc, $newpicname, $bookAvailable, $bookApproved);
			mysqli_stmt_execute($stmt);

		}

		//mysqli_query($connect, $sqlquery);

		//echo 'Yo your listing is pending approval my mandem ';


		//Upload secondary pictures
		foreach ($_FILES['sidepics']['tmp_name'] as $key => $value){

			$sidePicsName = $_FILES['sidepics']['name'][$key];
			$sidePicsTmp = $_FILES['sidepics']['tmp_name'][$key];
			$picExtension = pathinfo($sidePicsName, PATHINFO_EXTENSION); //Get the extension of the pic uploaded

			if(in_array($picExtension, $allowedFormat)){

				$sidePicNewName = uniqid('', true).".".$picExtension;
				$sidepicdestination = 'listing/'.$sidePicNewName;
				move_uploaded_file($sidePicsTmp, $sidepicdestination);

				//GET LISTING ID
				$getListingIDQuery = "SELECT * FROM listing WHERE book_imgpath = '$newpicname' LIMIT 1;";
				$getListingIDQueryResult = mysqli_query($connect, $getListingIDQuery);

				if(mysqli_num_rows($getListingIDQueryResult) == 0){

					echo "Image path of primary picture not found";

				} else{

					$fetchedRow = mysqli_fetch_assoc($getListingIDQueryResult);
					$listing_id = $fetchedRow['listing_id'];

					$addSidePicsQuery = "INSERT INTO listing_sidepic(listing_id, sidepicture_path) VALUES ('$listing_id', '$sidePicNewName')";
					mysqli_query($connect, $addSidePicsQuery);


				}



				//$addSidePicsQuery = "INSERT INTO listing_sidepic(listing_id, sidepicture_path) VALUES ('$listing_id');";

			} 

		}











		//echo '<h3>Listing Type is '.$listingType.'</h3>';
		echo '<meta http-equiv="refresh" content="2;URL=\'history_profile.php\'">';




	} else{
		echo 'There was an error';
	} 


?>