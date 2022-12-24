<?php
	include_once 'include/connectdb.php';
	include_once 'sql_functions.php';
	session_start();

	$userid = htmlspecialchars(base64_decode(urldecode($_GET['vp'])));
	$userexist = checkUserExist($connect, $userid);
	if(isset($_SESSION['userID']) && ($userid == $_SESSION['userID'])){

		header("Location:history_profile.php");

	} else if(!isset($_GET['vp']) || $userexist == 0){

		header("Location:index.php?notfound");

	} 

	$userdetails = getDetailsFromID($connect, $userid);
	foreach ($userdetails as $row) {
		$username = $row['user_fname'].' '.$row['user_lname'];
		$fname = $row['user_fname'];
		$usercourse = $row['course_id'];
		$userpic = $row['user_picpath'];
		$registerdate = date('d M Y', strtotime($row['register_date']));

	}

	$coursedetails = getCourseDetails($connect, $usercourse);
		foreach ($coursedetails as $fetchedrow) {
			$coursename = $fetchedrow['course_name'];
			$coursecode = $fetchedrow['course_code'];
		}

	$avgrating = getAverageRating($connect, $userid);
	$reviewcount = getReviewsCount($connect, $userid);





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
	<link rel="stylesheet" type="text/css" href="css/profilesummary.css">
	<link rel="icon" href="somepics/book-pack.svg">


	<!--BOOTSTRAP CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<title><?php echo $username."'s Profile";?></title>

	<script src="https://kit.fontawesome.com/98355d8df9.js" crossorigin="anonymous"></script>

	<!-- AJAX -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


</head>
<body>

	<header>
		<?php 
			include("real_navbar.php");

		?>
	</header>

	<main>

		<div class="container-fluid container-setting">

			<div class="container-fluid mt-3 bg-grey border-rad">

				<div class="row">

					<div class="col-md-4 py-3">

						<div class="container-fluid">

							<div class="card">
							  
							  <div class="card-body text-center">
							    
							    <img src="profile/<?php echo $userpic; ?>" class="pic-sizing mx-auto d-block">
							    <p class="card-text"><h1><?php echo $username; ?></h1></p>
							    <p><strong><?php echo $avgrating;?></strong><i class="bi bi-star-fill text-warning"></i>(<?php echo $reviewcount; ?>)</p><hr>
							    <p><?php echo $coursecode.' '.$coursename.' Student'; ?></p><hr>
							    <p>Joined <?php echo $registerdate;?></p>
							    
							    
							  </div>
							</div>

							
						</div>
						
					</div>

					<div class="col-md py-3">

						<div class="container-fluid  review-container">

						<div class="card border-0 mb-3">

						<?php 

						if($reviewcount == 0){

							echo '<i class="bi bi-emoji-frown text-center fs-1 py-2"></i>';
							echo '<p class="text-center text-muted py-2">'.$fname.' has no reviews yet. Come back later!</p>';

						} else{

							$reviews = getReviews($connect, $userid);
							foreach ($reviews as $row) {

								$buyerID = $row['ratingFrom'];
			      				$buyerDetails = getDetailsFromID($connect, $buyerID);
			      					foreach ($buyerDetails as $fetchedrow) {
			      						$buyername = $fetchedrow['user_fname'].' '.$fetchedrow['user_lname'];
			      					}
			      				$rating = $row['user_rating'];
			      				$review = $row['user_review'];
			      				$datetime = $row['ru_datetime'];
			      				$dtFormat = date('d M Y g:i A', strtotime($datetime));

			      				echo '<div class="card-body">
						    <h5 class="card-title">'.$rating.' <i class="bi bi-star-fill text-warning"></i></h5>
						    <p class="card-text">
						    	
						    	<figure>
								  <blockquote class="blockquote">
								    <p>'.$review.'</p>
								  </blockquote>
								  <figcaption class="blockquote-footer">
								    '.$dtFormat.' by  <cite title="Source Title">'.$buyername.'</cite>
								  </figcaption>
								</figure>
						    </p>
						  </div>
						</div>	';

								

							}



						}

							


						?>


						  <!--<div class="card-body">
						    <h5 class="card-title">'.$rating.' <i class="bi bi-star-fill text-warning"></i></h5>
						    <p class="card-text">
						    	
						    	<figure>
								  <blockquote class="blockquote">
								    <p>'.$review.'</p>
								  </blockquote>
								  <figcaption class="blockquote-footer">
								    '.$dtFormat.' by  <cite title="Source Title">'.$buyername.'</cite>
								  </figcaption>
								</figure>
						    </p>
						  </div>
						</div>-->




							

							
						</div>
						
					</div>
					
				</div>

				<div class="row mt-3">

					<div class="col-md bg-grey border-rad">

						<h1 class="display-6"><?php echo $fname;?>'s Book Listings</h1>

						<div class="container-fluid d-flex listing-container-setting py-2 justify-content-start">

							<?php 
								$listingcount = getAvailableListing($connect, $userid, 1);

								if($listingcount == 0){

									
									echo '<p class="text-muted">No book listings currently available. Come back later!</p>';


								} else {

									$userlisting = getAvailableListing($connect, $userid, 0);
									foreach ($userlisting as $row) {
										$listingid = $row['listing_id'];
										$bookpic = $row['book_imgpath'];
										$booktitle = $row['book_title'];
										$bookcourseint = $row['book_course'];
										$bookprice = $row['book_price'];

										$coursedetails = getCourseDetails($connect, $bookcourseint);
										foreach ($coursedetails as $fetchedrow) {
											$bookcn = $fetchedrow['course_name'];
											$bookcc = $fetchedrow['course_code'];
										}




										echo '<a href="viewProduct.php?productid='.$listingid.'" class="text-decoration-none text-dark"><div class="card product-card-style flex-shrink-0 border-0">
										  <div class="card-body">
										  	<img src="listing/'.$bookpic.'" class="listing-sizing mx-auto d-block"><br>
										    <h5 class="card-title text-truncate text-center">'.$booktitle.'</h5>
										    <p class="card-text text-center text-truncate">'.$bookcc.' '.$bookcn.'</p>
										    <p class="card-text text-center text-truncate"><strong>RM'.$bookprice.'</strong></p>
										  </div>
										</div></a>';








									}


								}


							?>

							<!--<div class="card product-card-style flex-shrink-0 border-0">
							  <div class="card-body">
							  	<img src="somepics/python.jpg" class="listing-sizing mx-auto d-block"><br>
							    <h5 class="card-title text-truncate text-center">The Python Book</h5>
							    <p class="card-text text-center text-truncate">HC00 Software Engineering</p>
							    <p class="card-text text-center text-truncate"><strong>RM45</strong></p>
							  </div>
							</div>-->




							


							
							
						</div>

					




							
							
					</div>
					
					
				</div>
				
			</div>
			
		</div>
		
	</main>





<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>