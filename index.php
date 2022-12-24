
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
	<link rel="stylesheet" type="text/css" href="css/homepage.css">
	<link rel="icon" href="somepics/book-pack.svg">

	<!--BOOTSTRAP CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<title>Final Year Project</title>

	<!-- AJAX -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

		
	<!--	$(document).ready(function() {

			$("#signup-btn").submit(function(e) {

				e.preventDefault();

			});

		}); 

//AJAX FOR SIGN UP
/*	$(document).ready(function (){
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
});  	-->





</head>


<body>

	<header>
		<?php 
		include("real_navbar.php");


	?>
	
	</header>
	
	<main>
		
		<div class="container-fluid container-padding"> 

			<div class="row row-mobile">

		<!--		<div class="col-2 filter-mobile">
					<p>The filters go here</p>

					<div class="container-fluid sticky-top">

						<div class="accordion" id="accordionExample">


							<div class="accordion-item">
						    <h2 class="accordion-header" id="headingTwo">
						      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						        <label><i class="bi bi-funnel"></i><i class="bi bi-filter-left"></i>Filter</label>
						      </button>
						    </h2>
						    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
						      <div class="accordion-body accordion-setting">

						      <form action="filter_search.php" method="POST">
						      	<div class="form-floating">
										  <select class="form-select select-box mb-3" id="floatingSelect" aria-label="Floating label select example" required>
										  	<option value="" selected>-</option>
										    <?php 

					             /*   $getcourse = "SELECT * FROM course";
					                $result = mysqli_query($connect, $getcourse);
					                while($fetchedrows = mysqli_fetch_array($result)){
					                  echo "<option value = '".$fetchedrows[0]."'>".$fetchedrows[1]."</option>"; 
					                } */

					              ?>
										  </select>
										  <label for="floatingSelect">Book Course</label>
									</div>

									<div class="form-floating mb-3">
									  <select class="form-select select-box" id="floatingSelect" aria-label="Floating label select example" required>
									  	<option value="" selected>-</option>
									    <option value="1">For Sale</option>
									    <option value="0">For Rent</option>
									  </select>
									  <label for="floatingSelect">Type</label>
									</div>

									<div class="form-floating mb-3">
									  <select class="form-select select-box" id="floatingSelect" aria-label="Floating label select example" required>
									  	<option value="" selected>-</option>
									    <option value="pristine">Pristine</option>
									    <option value="used">Used</option>
									  </select>
									  <label for="floatingSelect">Book Condition</label>
									</div>

									<div class="form-floating mb-3">
									  <select class="form-select select-box" id="floatingSelect" aria-label="Floating label select example" required>
									  	<option value="" selected>-</option>
									    <option value="1">Low to High</option>
									    <option value="0">High to Low</option>
									  </select>
									  <label for="floatingSelect">Price Range</label>
									</div>

									<div class="text-center">
										<button type="submit" name="submit-filter" class="filter-btn border-0">Filter</button>	
									</div>
						      
						      </div>
						    </form>

						    </div>

						  </div>


						</div>
							
					</div>

						
				</div> -->
					
				<div class="col p-2 inline">
					<!--<p>The products go here</p>
					<h1 class="px-5 mb-3">Books For You</h1>-->
					<div class="px-3 mb-3">
						<img src="somepics/banner.png" class="w-100 img-fluid">
					</div>

					<h1 class="px-5 mb-3">Top Books in course, top rated books, recently added </h1>	
					<section class="product-layout justify-content-center">

						<?php

							//If user is not logged in

							if(!isset($_SESSION['userID'])){

								$getAllListingQuery = "SELECT * FROM listing WHERE book_approved = 1;";
								$getAllListingQueryResult = mysqli_query($connect, $getAllListingQuery);

											//If there are no listings
											if(mysqli_num_rows($getAllListingQueryResult) == 0){

													echo '<p>Oops! It seems there are no listings available right now</p>';

											} else { //There are listings

															while($fetchedListing = mysqli_fetch_assoc($getAllListingQueryResult)){

																	$imgPath = $fetchedListing['book_imgpath'];
																	$bookTitle = $fetchedListing['book_title'];
																	$bookID = $fetchedListing['listing_id'];
																	$listingDate = $fetchedListing['listing_date'];
																	$bookPrice = $fetchedListing['book_price'];
																	$bookCourseInt = $fetchedListing['book_course']; 
																	$bookCourseCode = "";
																	$bookCourseName = "";

																	$getBookCourseQuery = "SELECT * FROM course WHERE course_id = '$bookCourseInt' LIMIT 1";
																			$getBookCourseResult = mysqli_query($connect, $getBookCourseQuery);

																			if(mysqli_num_rows($getBookCourseResult) == 1){

																				$fetchedBookCourseCode = mysqli_fetch_assoc($getBookCourseResult);
																				$bookCourseName = $fetchedBookCourseCode['course_name'];
																				$bookCourseCode = $fetchedBookCourseCode['course_code'];

																			} else{
																				echo 'Error retrieving course';
																			}


																			echo '<a class="link-colors" href="viewProduct.php?&productid='.urlencode(base64_encode($bookID)).'">
																					<div class="card max-card-size">
																			    <img src="listing/'.$imgPath.'" class="card-img-top img-sizing mx-auto d-block" alt="...">
																			    
																			     <div class="card-body text-center">
																			      <h5 class="card-title text-truncate">'.$bookTitle.'</h5>
																			      <div class="card-text text-truncate">'.$bookCourseCode.' '.$bookCourseName.'</div><br>
																			      <label class="card-text card-price"><strong>RM'.$bookPrice.'</strong></label>
																			      
																		    		</div>
																					</div>
																				</a>';



															}

											}

							} else { //If user is logged in, display book code goes here

								$loggedinUserID = $_SESSION['userID'];
								$getAllListingQuery = "SELECT * FROM listing WHERE user_id != '$loggedinUserID' AND book_approved = 1;"; //WHERE book_approved = 1;";
								$getAllListingQueryResult = mysqli_query($connect, $getAllListingQuery);

											//If there are no listings
											if(mysqli_num_rows($getAllListingQueryResult) == 0){

													echo '<p>Oops! It seems there are no listings available right now</p>';

											} else { //There are listings

															while($fetchedListing = mysqli_fetch_assoc($getAllListingQueryResult)){

																	$imgPath = $fetchedListing['book_imgpath'];
																	$bookTitle = $fetchedListing['book_title'];
																	$bookID = $fetchedListing['listing_id'];
																	$listingDate = $fetchedListing['listing_date'];
																	$bookPrice = $fetchedListing['book_price'];
																	$bookCourseInt = $fetchedListing['book_course']; 
																	$bookCourseCode = "";
																	$bookCourseName = "";

																	$getBookCourseQuery = "SELECT * FROM course WHERE course_id = '$bookCourseInt' LIMIT 1";
																			$getBookCourseResult = mysqli_query($connect, $getBookCourseQuery);

																			if(mysqli_num_rows($getBookCourseResult) == 1){

																				$fetchedBookCourseCode = mysqli_fetch_assoc($getBookCourseResult);
																				$bookCourseName = $fetchedBookCourseCode['course_name'];
																				$bookCourseCode = $fetchedBookCourseCode['course_code'];

																			} else{
																				echo 'Error retrieving course';
																			}


																			echo '<a class="link-colors" href="viewProduct.php?&productid='.urlencode(base64_encode($bookID)).'">
																					<div class="card max-card-size">
																			    <img src="listing/'.$imgPath.'" class="card-img-top img-sizing mx-auto d-block" alt="...">
																			    
																			     <div class="card-body text-center">
																			      <h5 class="card-title text-truncate">'.$bookTitle.'</h5>
																			      <div class="card-text text-truncate">'.$bookCourseCode.' '.$bookCourseName.'</div><br>
																			      <label class="card-text card-price"><strong>RM'.$bookPrice.'</strong></label>
																			      
																		    		</div>
																					</div>
																				</a>';
											}


							}

					}



						?>

							
							<!--<a class="link-colors" href="#">
								<div class="card max-card-size">
						    <img src="somepics/avatar.png" class="card-img-top img-sizing mx-auto d-block" alt="...">
						    
						     <div class="card-body text-center">
						      <h5 class="card-title text-truncate">The Python Book</h5>
						      <label class="card-text">HC00</label><br>
						      <label class="card-text card-price"><strong>RM45</strong></label>
						      
					    		</div>
								</div>
							</a> -->

							






					</section> 







			</div>
		</div> 

			<!--<div class="card-custom">

				<div class="seller-details">
					<div class="row">

						<div class="col text-center">
							<img src="profile/avatar2.jpeg" class="seller-tiny-pic">
						</div>

						<div class="col-8 mt-3">
							<label><strong>Amazon Web</strong></label>
							<p class="small-font">Posted on 11-12-2020</p>
						</div>
						
					</div>
			
				</div>

				<img src="somepics/python.jpg" class="listing-img-size mx-auto d-block">
				<label class="add-ml"><strong>The Python Book</strong></label>
				<p class="add-ml">HC00</p>
				<p class="add-ml" style="color:firebrick;">RM 45</p>
				
			</div> -->

			<?php 

				/*if(isset($_SESSION['userID'])){
					echo "Test";


				} else{

					$getListingQuery = "SELECT * FROM listing WHERE listing_type = 1";
					$getListingQueryResult = mysqli_query($connect, $getListingQuery);


					//If there are no listings
					if(mysqli_num_rows($getListingQueryResult) == 0){

							echo '<p>Oops, it looks like there are no listings available yet</p>';

					} else{

					

						while($fetchedListing = mysqli_fetch_assoc($getListingQueryResult)){

							$imgPath = $fetchedListing['book_imgpath'];
							$bookTitle = $fetchedListing['book_title'];
							$listingDate = $fetchedListing['listing_date'];
							$bookPrice = $fetchedListing['book_price'];
							$bookCourseInt = $fetchedListing['book_course']; 
							$bookCourseCode = "";
							$bookCourseName = "";

							$getBookCourseQuery = "SELECT * FROM course WHERE course_id = '$bookCourseInt' LIMIT 1";
									$getBookCourseResult = mysqli_query($connect, $getBookCourseQuery);

									if(mysqli_num_rows($getBookCourseResult) == 1){

										$fetchedBookCourseCode = mysqli_fetch_assoc($getBookCourseResult);
										$bookCourseName = $fetchedBookCourseCode['course_name'];
										$bookCourseCode = $fetchedBookCourseCode['course_code'];

									} else{
										echo 'Error retrieving course';
									}

							//echo '<div class="container-fluid d-flex flex-wrap container-padding">';

							echo '<div class="card max-card-size">
								    <img src="listing/'.$imgPath.'" class="card-img-top img-sizing mx-auto d-block" alt="listing picture">
								    
								    <div class="card-body">
								      <h5 class="card-title">'.$bookTitle.'</h5>
								      <p class="card-text">'.$bookCourseCode.' '.$bookCourseName.'</p>
								      <p style = "color:red;" class="card-text"><strong>RM'.$bookPrice.'</strong></p>
								      <p class="text-right"><i class="bi bi-heart-fill heart-icon"></i></p>
								      <p class="card-text"><small class="text-muted">Posted by Amazon Web</small></p>
							    	</div>
									</div>';


						}

					}


				} //end of else */
				?>



	<!--	<div class="card">
	    <img src="somepics/python.jpg" class="card-img-top" alt="...">
	    
	    <div class="card-body">
	      <h5 class="card-title">The Python Book</h5>
	      <p class="card-text">HC00</p>
	      <p class="card-text"><strong>RM45</strong></p>
	      <p class="text-right"><i class="bi bi-heart-fill heart-icon"></i></p>
	      <p class="card-text"><small class="text-muted">Posted by Amazon Web</small></p>
    	</div>
		</div> -->


		






	</div>



	</main>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


<!-- CUSTOM JAVASCRIPT -->
<script type="text/javascript" src="js/javascript.js"></script>

</body>


</html>