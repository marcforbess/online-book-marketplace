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
	

	<script src="https://kit.fontawesome.com/98355d8df9.js" crossorigin="anonymous"></script>

	<!--CUSTOM CSS -->
	<!--<link rel="stylesheet" type="text/css" href="css/bootstrap.css"> -->
	<link rel="stylesheet" type="text/css" href="css/navstyling.css">
	<link rel="stylesheet" type="text/css" href="css/listingapproval.css">
	<link rel="stylesheet" type="text/css" href="css/offerpage.css">
	<!--<link rel="stylesheet" type="text/css" href="css/loginstyle.css">
	<link rel="stylesheet" type="text/css" href="css/signupstyle.css">
	<link rel="stylesheet" type="text/css" href="css/homepage.css"> -->
	<link rel="icon" href="somepics/adminicon.png">

	<!--BOOTSTRAP CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<title>Pending Approvals</title>

	<!-- AJAX -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


</head>
<body>

	<header>

		<?php 

			if(!isset($_SESSION['adminID'])){

				header("Location:index.php");

			}
			include("real_navbar.php");
		?>
		
	</header>

	<main>

		<div class="container-fluid">

			<div class="container-fluid mt-3 tab-body-setting">
			  		<h1 class="display-6 py-2">Pending Approval</h1>


			  		<?php 
			  			$pendingCount = getPendingCount($connect);
			  			echo '<p class="text-muted px-2">There are '.$pendingCount.' listings</p>';

			  			if($pendingCount != 0){

			  				$pending = getPendingListing($connect);

			  				foreach ($pending as $row) {

			  					$listingID = $row['listing_id'];
			  					$userID = $row['user_id'];
			  					$bookCourse = $row['book_course'];
			  					$bookImg = $row['book_imgpath'];
			  					$bookTitle = $row['book_title'];
			  					$listingdate = $row['listing_date'];
			  					$dateFormat = date('d M Y', strtotime($listingdate));
			  					//$userPic = getProfilePic($connect, $userID);
			  					$userDetails = getSellerDetails($connect, $listingID);

			  					foreach ($userDetails as $row) {
			  						
			  						$userfirstname = $row['user_fname'];
			  						$userlastname = $row['user_lname'];
			  						$userPic = $row['user_picpath'];
			  					}

			  					$courseDetails = getCourseDetails($connect, $bookCourse);
			  					foreach ($courseDetails as $row) {
			  						$coursecode = $row['course_code'];
			  						$coursename = $row['course_name'];
			  					}


			  					echo '<div class="card mb-3">
							  <div class="card-header bg-light">
							  	<img src="profile/'.$userPic.'" class="rounded-circle user-pic-sizing">
							    '.$userfirstname.' '.$userlastname.' wants to post a listing 
							  </div>

							  <div class="card-body">

							  	<div class="row">

							  		<div class="col-xl-1 add-bg-grey">
							  			<img src="listing/'.$bookImg.'" class="mx-auto d-block img-sizing">
							  		</div>

							  		<div class="col-xl-11">

							  			<h4 class="card-title mt-3">'.$bookTitle.'</h4>
							  			<p class="px-1"><strong>'.$coursecode.' </strong>'.$coursename.'</p>
							  			<p class="success"></p>
									    <a href="viewProduct.php?productid='.$listingID.'" class="btn btn-view-more mb-3 mobile-view-btn"><i class="fa-solid fa-circle-chevron-right icon-ml"></i>View Details</a>
							  			
							  		</div>
							  		
							  	</div>


							    
							  </div>



							  <div class="card-footer text-muted bg-light">
							    '.$dateFormat.'
							  </div>
							</div>';







			  				}

			  				

			  			}



			  		?>



			  			
			  		<!--<div class="card mb-3">
					  <div class="card-header bg-light">
					  	<img src="somepics/avatar.png" class="rounded-circle user-pic-sizing">
					    Amazon Web wants to post a listing 
					  </div>

					  <div class="card-body">

					  	<div class="row">

					  		<div class="col-xl-1 add-bg-grey">
					  			<img src="somepics/python.jpg" class="mx-auto d-block img-sizing">
					  		</div>

					  		<div class="col-xl-11">

					  			<h4 class="card-title mt-3">The Python Book</h4>
					  			<p class="px-1"><strong>HC00 </strong>Software Engineering</p>
							    <a href="#" class="btn btn-view-more mb-3 mobile-view-btn"><i class="fa-solid fa-circle-chevron-right icon-ml"></i>View Details</a>
					  			
					  		</div>
					  		
					  	</div>


					    
					  </div>



					  <div class="card-footer text-muted bg-light">
					    21 Aug 2022
					  </div>
					</div>-->


			











		</div>
		
	</main>




<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


<!-- CUSTOM JAVASCRIPT -->
<script type="text/javascript" src="js/javascript.js"></script>

</body>
</html>