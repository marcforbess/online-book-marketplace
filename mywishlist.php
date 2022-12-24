<?php 
	include_once 'include/connectdb.php';
	include_once 'sql_functions.php';
	session_start();

	$userID = $_SESSION['userID'];

	$wishlistCount = getWishlistCount($connect, $userID);
	
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
	<link rel="icon" href="somepics/book-pack.svg">
	<!--<link rel="icon" href="https://icons.getbootstrap.com/assets/icons/search.svg"> -->

	<!--BOOTSTRAP CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<title>My Wishlist</title>

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
	
	<div class="container mb-3 mt-3">

		<div class="container w-container-bg container-setting">
			<h1 class="text-dark px-2 py-2">My Wishlist</h1>
			 

			<?php 

				if($wishlistCount == 0){

					echo '<p class="text-center icon-size"><i class="bi bi-folder-x"></i></p>';
					echo '<p class="text-center">Looks like you have no listings in your wishlist</p>';

				} else {


				echo '<button class="text-decoration-none clear-wl border-0" data-bs-toggle="modal" data-bs-target="#promptEntire"><p class="px-2"><strong>Clear My Wishlist</strong></p></button>';
				echo '<span class="text-muted">You have saved '.$wishlistCount.' listings</span>';


				$wishlistListingID = getWishlistListingID($connect, $userID);
				foreach ($wishlistListingID as $fetchedID) {

							$fetchedListingID = $fetchedID['listing_id'];

							$listingDetails = getListingDetails($connect, $fetchedListingID);
							foreach ($listingDetails as $fetchedRows) {
								include("include/listing_info.php");
							}
							

							$sellerDetails = getSellerDetails($connect, $fetchedListingID);
							foreach ($sellerDetails as $row) {
								$sellerfirstname = $row['user_fname'];
								$sellerlastname = $row['user_lname'];
							}

							$getBookCourse = getCourseDetails($connect, $bookCourseInt);
							foreach ($getBookCourse as $row) {
								$bookCourseCode = $row['course_code'];
								$bookCourseName = $row['course_name'];
							}


							echo '<div class="container horizontal-card horizontal-card-bg-wishlist w-100 mb-3 link-hover">
							<div class="row">
								<div class="col-lg-2 col-setting pic-padding">
									<img src= "listing/'.$bookImgPath.'" class="img-fluid-mod mx-auto d-block">
								</div>

								<div class="col-lg-10 details-mobile-padding">
									<div class="text-truncate title-padding">
										<a class = "text-decoration-none text-dark"href="viewProduct.php?&productid='.urlencode(base64_encode($fetchedListingID)).'"><h1 class="mobile-title-padding">'.$bookTitle.'</h1></a>
									</div>

									<div class="details pl-5">
										<span class="text-muted">Posted by '.$sellerfirstname.' '.$sellerlastname.' on '.$listingDate.'</span><br>
										<span>'.$listingType.'</span><br>
										<span>ISBN No: '.$bookISBN.'</span><br>
										<span>'.$bookCourseCode.'</span><br>
										<span class="book-price mb-5"><strong>RM'.$bookPrice.'</strong></span><br><br>
										<p><a href="processWishlist.php?wishlist-pg-active='.urlencode(base64_encode('true')).'&command='.urlencode(base64_encode('delete')).'&productid='.urlencode(base64_encode($fetchedListingID)).'" class="btn btn-info text-white"><i class="bi bi-trash-fill"></i>Remove from Wishlist</a></p>
									</div>
																				
								</div>

							</div>
						</div>';





				}



	}


			?>


			<!--<a><div class="container horizontal-card horizontal-card-bg-wishlist w-100 mb-3 link-hover">
			<div class="row">
				<div class="col-lg-2 col-setting pic-padding">
					<img src="somepics/callum.jpg" class="img-fluid-mod mx-auto d-block">
				</div>

				<div class="col-lg-10 details-mobile-padding">
					<div class="text-truncate title-padding">
						<h1 class="mobile-title-padding">The Hen and the Chicken</h1>	
					</div>

					<div class="details pl-5">
						<span>Hello World</span>
						<span class="text-muted">Posted by '.$sellerfirstname.' '.$sellerlastname.' on '.$listingDate.'</span><br>
						<span>'.$listingType.'</span><br>
						<span>ISBN No: '.$bookISBN.'</span><br>
						<span>'.$bookCourseCode.'</span><br>
						<span class="book-price mb-5"><strong>RM'.$bookPrice.'</strong></span><br><br>
						<p><button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#promptSingle"><i class="bi bi-trash-fill"></i>Remove from Wishlist</button></p>
					</div>
																
				</div>

			</div>
		</div></a> -->



		<!-- Modal For Removing Single Items
		<div class="modal fade" id="promptSingle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h1 class="modal-title w-100 fs-5 text-center text-white" id="exampleModalLabel">Remove from My Wishlist</h1>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body text-center">
		        Remove this item from your wishlist?
		      </div>
		      <div class="modal-footer justify-content-center">
		        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No, keep it</button>	        
		        <a href="processWishlist.php?command=delete&productid='.$listingID.'"><button type="button" class="btn btn-success">Yes, Confirm</button></a>;	        
		      </div>
		    </div>
		  </div>
		</div> -->

		<!-- Modal For Clearing Entire Wishlist-->
		<div class="modal fade" id="promptEntire" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h1 class="modal-title w-100 fs-5 text-center text-white" id="exampleModalLabel">Clear My Wishlist</h1>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body text-center">
		        This will remove all items from your wishlist
		      </div>
		      <div class="modal-footer justify-content-center">
		        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No, keep it</button>
		        <?php
		        echo '<a href="processWishlist.php?wishlist-pg-active='.urlencode(base64_encode('true')).'&command='.urlencode(base64_encode('removeall')).'&productid='.urlencode(base64_encode('none')).'"><button type="submit" class="btn btn-success">Yes, Confirm</button></a>';
		        ?>
		      </div>
		    </div>
		  </div>
		</div>









	</div>
		






	</div>


</main>



<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


<!-- CUSTOM JAVASCRIPT -->
<script type="text/javascript" src="js/javascript.js"></script>
</body>
</html>