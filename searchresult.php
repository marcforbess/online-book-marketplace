<?php 
	include_once 'include/connectdb.php';
	include_once 'sql_functions.php';
	session_start();
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--BOOTSTRAP ICONS-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

	<!--CUSTOM CSS -->
	<!--<link rel="stylesheet" type="text/css" href="css/bootstrap.css"> -->
	<link rel="stylesheet" type="text/css" href="css/navstyling.css">
	<link rel="stylesheet" type="text/css" href="css/loginstyle.css">
	<link rel="stylesheet" type="text/css" href="css/signupstyle.css">
	<link rel="stylesheet" type="text/css" href="css/searchresult.css">
	<!--<link rel="icon" href="somepics/book-pack.svg"> -->
	<link rel="icon" href="https://icons.getbootstrap.com/assets/icons/search.svg"> 

	<!--BOOTSTRAP CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<title>Search</title>

	<!-- AJAX -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

	<script>
		

//AJAX FOR SIGN UP
	$(document).ready(function (){
    $("#form-signup").submit(function(e) {

    //Prevent default action of form
    e.preventDefault();

    //Get variables from input field
    
    var submit = $("#signup-btn").val();
    var course = $("#user-course").val();
    var firstname = $("#firstname").val();
    var lastname = $("#lastname").val();
    var phonenum = $("#phonenum").val();
    var email = $("#signup-email").val();
    var password = $("#passwordsignup").val();
    $(".error-message-signup").load("validate_signup.php", {

      //Variables passed to process_signup.php : Variables declared in this function (X:Y)
      submit:submit,
      course:course,
      firstname:firstname,
      lastname:lastname,
      phonenum:phonenum,
      email:email,
      password:password 

    })

  });
});  	


//AJAX FOR LOGIN
$(document).ready(function (){
    $("#form-login").submit(function(e) {

    //Prevent default action of form
    e.preventDefault();

    //Get variables from input field
    
    var submit = $("#login-btn").val();
    var usertype = $("#user-type").val();
    var useremail = $("#login-email").val();
    var password = $("#password").val();
    
    $(".error-message-login").load("validate_login.php", {

      //Variables passed to process_signup.php : Variables declared in this function (X:Y)
      submit:submit,
      usertype:usertype,
      useremail:useremail,
      password:password

    })

  });
});  	
	</script>
	


</head>
<body>

	<header>
		<?php 
		include("real_navbar.php");


	?>
	
	</header>

	<main>


			<?php 

				//$userID = $_SESSION['userID'];
				$searchInput = htmlspecialchars($_GET['search-query']);
				$searchStmt = "%".$searchInput."%";
				$searchBy = $_GET['search-by'];
				$searchQuery = ""; 


				if($searchBy == 'title'){

						if(isset($_SESSION['userID'])){

							/*$searchQuery = "SELECT * FROM listing WHERE user_id != ? AND book_approved = 1 AND (book_title LIKE ? OR book_authors LIKE ? OR book_subjectcode LIKE ?);";*/

							$searchQuery = "SELECT listing.*, course.* FROM listing INNER JOIN course WHERE (listing.book_course = course.course_id AND listing.book_approved = 1) AND (listing.user_id !=?) AND (book_title LIKE ? OR book_authors LIKE ? OR book_subjectcode LIKE ? OR course_code LIKE ? OR course_name LIKE ? OR book_isbn LIKE ?);
";

						} else {

							/*$searchQuery = "SELECT * FROM listing WHERE book_approved = 1 AND (book_title LIKE ? OR book_authors LIKE ? OR book_subjectcode LIKE ?);"; */

							$searchQuery = "SELECT listing.*, course.* FROM listing INNER JOIN course WHERE (listing.book_course = course.course_id AND listing.book_approved = 1) AND (book_title LIKE ? OR book_authors LIKE ? OR book_subjectcode LIKE ? OR course_code LIKE ? OR course_name LIKE ? OR book_isbn LIKE ?);
";
						}


					$stmt = mysqli_stmt_init($connect);

								if(!mysqli_stmt_prepare($stmt, $searchQuery)){

										echo "Error connecting to db for prepared stmt";

								} else {

									if(isset($_SESSION['userID'])){

										$userID = $_SESSION['userID'];
										mysqli_stmt_bind_param($stmt, "sssssss", $userID, $searchStmt, $searchStmt, $searchStmt,$searchStmt,$searchStmt,$searchStmt);
									

									} else {

										mysqli_stmt_bind_param($stmt, "ssssss", $searchStmt, $searchStmt, $searchStmt, $searchStmt, $searchStmt, $searchStmt);
									
									}

										
										mysqli_stmt_execute($stmt);
										$searchQueryResult = mysqli_stmt_get_result($stmt);
										$searchCount = mysqli_num_rows($searchQueryResult);
									}



				} else if($searchBy == 'isbn'){

					if(isset($_SESSION['userID'])){

						$searchQuery = "SELECT * FROM listing WHERE user_id != ? AND book_approved = 1 AND book_isbn LIKE ?;";

					} else {

						$searchQuery = "SELECT * FROM listing WHERE book_approved = 1 AND book_isbn LIKE ?;";

					}
					//$searchQuery = "SELECT * FROM listing WHERE user_id != ? AND book_isbn LIKE ?;";

					$stmt = mysqli_stmt_init($connect);

								if(!mysqli_stmt_prepare($stmt, $searchQuery)){

										echo "Error connecting to db for prepared stmt";

								} else {

									if(isset($_SESSION['userID'])){

										$userID = $_SESSION['userID'];
										mysqli_stmt_bind_param($stmt, "ss", $userID, $searchStmt);

									} else {

										mysqli_stmt_bind_param($stmt, "s",$searchStmt);

									}

										//mysqli_stmt_bind_param($stmt, "ss", $userID, $searchStmt);
										mysqli_stmt_execute($stmt);
										$searchQueryResult = mysqli_stmt_get_result($stmt);
										$searchCount = mysqli_num_rows($searchQueryResult);
									}

				}

										echo '<div class="container mb-3 mt-3">
													<p>Found '.$searchCount.' Search Result based on search "'.$searchInput.'"</p>
													
												</div>';

										echo '<div class="container container-setting">
													<h1>Search Result</h1>';

										while($fetchedRows = mysqli_fetch_assoc($searchQueryResult)){


																/*	$imgPath = $fetchedListing['book_imgpath'];
																	$bookTitle = $fetchedListing['book_title'];
																	$bookID = $fetchedListing['listing_id'];
																	$bookISBN = $fetchedListing['book_isbn'];
																	$listingDate = $fetchedListing['listing_date'];
																	$listingTypeInt = $fetchedListing['listing_type'];
																	$listingType = "";
																	if($listingTypeInt == 1){
																		$listingType = "For Sale";

																	} else {
																		$listingType = "For Rent";
																	}

																	$bookPrice = $fetchedListing['book_price'];
																	$bookCourseInt = $fetchedListing['book_course']; 
																	$bookSubjectCode = $fetchedListing['book_subjectcode'];
																	$bookCourseCode = "";
																	$bookCourseName = ""; */
																	include("include/listing_info.php");

																	$sellerDetails = getSellerDetails($connect, $listingID);
																	foreach ($sellerDetails as $fetchedSellerDetails) {
																		
																		$sellerfirstname = $fetchedSellerDetails['user_fname'];
																		$sellerlastname = $fetchedSellerDetails['user_lname'];

																	}
																	//$sellerfirstname = "";
																	//$sellerlastname = "";

															/*		//Get Seller Details
																	$getSellerIDQuery = "SELECT * FROM users WHERE user_id = '$sellerID' LIMIT 1;";
																	$getSellerIDQueryResult = mysqli_query($connect, $getSellerIDQuery);

																	if(mysqli_num_rows($getSellerIDQueryResult) == 1){

																		$fetchedSellerDetails = mysqli_fetch_assoc($getSellerIDQueryResult);
																		$sellerfirstname = $fetchedSellerDetails['user_fname'];
																		$sellerlastname = $fetchedSellerDetails['user_lname'];

																	} else {

																		echo "Error getting seller details";
																	} */

																	$getBookCourse = getCourseDetails($connect, $bookCourseInt);
																	foreach ($getBookCourse as $row) {

																		$bookCourseName = $row['course_name'];
																		$bookCourseCode = $row['course_code'];

																	}

														/*			$getBookCourseQuery = "SELECT * FROM course WHERE course_id = '$bookCourseInt' LIMIT 1";
																			$getBookCourseResult = mysqli_query($connect, $getBookCourseQuery);

																			if(mysqli_num_rows($getBookCourseResult) == 1){

																				$fetchedBookCourseCode = mysqli_fetch_assoc($getBookCourseResult);
																				$bookCourseName = $fetchedBookCourseCode['course_name'];
																				$bookCourseCode = $fetchedBookCourseCode['course_code'];

																			} else{
																				echo 'Error retrieving course';
																			} */


											echo '<a href="viewProduct.php?productid='.urlencode(base64_encode($listingID)).'" class="text-decoration-none text-dark">
															<div class="container horizontal-card horizontal-card-bg-search w-100 mb-3 link-hover">
															<div class="row">
																	
																<div class="col-lg-2 pic-padding">
																	<img src="listing/'.$bookImgPath.'" class="img-fluid-mod mx-auto d-block">
																</div>

																<div class="col-lg-10 details-mobile-padding">
																	<div class="text-truncate title-padding">
																		<h1 class="mobile-title-padding">'.$bookTitle.'</h1>	
																	</div>
																	<div class="details pl-5">
																		<span class="text-muted">Posted by '.$sellerfirstname.' '.$sellerlastname.' on '.$listingDate.'</span><br>
																		<span>'.$listingType.'</span><br>
																		<span>ISBN No: '.$bookISBN.'</span><br>
																		<span>'.$bookCourseCode.' '.$bookCourseName.' ('.$bookSubjectCode.')</span><br>
																		<span class="book-price"><strong>RM'.$bookPrice.'</strong></span><br>
																	</div>
																
																</div>

															</div>
															
														</div></a> ';




										}
								



			?>


			
		</div>


	</main>




<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


<!-- CUSTOM JAVASCRIPT -->
<script type="text/javascript" src="js/javascript.js"></script>
</body>
</html>