<?php 
	include_once 'include/connectdb.php';
	include_once 'sql_functions.php';
	session_start();

	//Get them listing pics 
			$listingID = htmlspecialchars(base64_decode(urldecode($_GET['productid'])));
			$imgarray = array();

			$listingDetails = getListingDetails($connect, $listingID);

			if(count($listingDetails) == 0){

				header("Location:index.php?product=notfound");

			}

			foreach ($listingDetails as $fetchedRows) {

				include("include/listing_info.php");
				array_push($imgarray, $bookImgPath);
				$bookApproved = $fetchedRows['book_approved'];
				$rejectMessage = $fetchedRows['reject_message'];

				/*$sellerID = $fetchedRows['user_id'];
				$listingDate = $fetchedRows['listing_date'];
				$listingType = $fetchedRows['listing_type'];
				$bookTitle = $fetchedRows['book_title'];
				$bookCondition = $fetchedRows['book_condition'];
				$bookAuthors = $fetchedRows['book_authors'];
				$bookISBN = $fetchedRows['book_isbn'];
				$bookPrice = $fetchedRows['book_price'];
				$bookCourseInt = $fetchedRows['book_course'];
				$bookSubjectCode = $fetchedRows['book_subjectcode'];
				$bookDescription = $fetchedRows['book_description'];
				$bookImgPath = $fetchedRows['book_imgpath'];
				array_push($imgarray, $bookImgPath);
				$bookCourseCode = "";
				$bookCourseName = ""; */


			}

				//Get Seller Profile Pic and Details (Name, etc)
				//$sellerProfilePic = getProfilePic($connect, $sellerID);
				$sellerDetails = getSellerDetails($connect, $listingID);
				$sellerfirstname = "";

				foreach($sellerDetails as $row){

					$sellerfirstname = $row['user_fname'];
					$sellerlastname = $row['user_lname'];
					$sellerProfilePic = $row['user_picpath'];

				}


				//Get Course Details
					$fetchedCourseDetails = getCourseDetails($connect, $bookCourseInt);
					foreach ($fetchedCourseDetails as $row) {
							
							$bookCourseCode = $row['course_code'];
							$bookCourseName = $row['course_name'];
					}


				//Get sidepics 
				$sidepics = getSidePics($connect, $listingID);
				foreach ($sidepics as $row) {
						
						array_push($imgarray, $row['sidepicture_path']);

				}


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
	<link rel="stylesheet" type="text/css" href="css/viewproduct.css">
	<link rel="icon" href="somepics/book-pack.svg">

	<!--BOOTSTRAP CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<title><?php echo $bookTitle; ?></title>

	<!-- AJAX -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

	<script>
		


//AJAX FOR MAKING NORMAL OFFER
$(document).ready(function (){
    $("#normalOffer").click(function() {

    //Prevent default action of form
   // e.preventDefault();

    //Get variables from input field
    var command = 'normal-offer';
    var listingID = <?php echo $listingID;?>;
    var sender = <?php echo $_SESSION['userID'];?>;
    var recipientID = <?php echo $sellerID;?>;
    var recipientFirstName = '<?php echo $sellerfirstname;?>';
    var senderFirstName = '<?php echo $_SESSION['userfname'];?>';
    var offerprice = <?php echo $bookPrice ?>;

    
    $(".success-offer").load("process_offer.php", {

      //Variables passed to process_signup.php : Variables declared in this function (X:Y)
      command:command,
      listingID:listingID,
      sender:sender,
      recipientID:recipientID,
      recipientFirstName:recipientFirstName,
      senderFirstName:senderFirstName,
      offerprice:offerprice
  

    })

  });
});  	



//AJAX FOR MAKING CUSTOM OFFER
$(document).ready(function (){
    $("#customOfferForm").submit(function(e) {

    //Prevent default action of form
    e.preventDefault();

    //Get variables from input field
    var command = 'custom-offer';
    var listingID = <?php echo $listingID;?>;
    var sender = <?php echo $_SESSION['userID'];?>;
    var recipientID = <?php echo $sellerID;?>;
    var recipientFirstName = '<?php echo $sellerfirstname;?>';
    var senderFirstName = '<?php echo $_SESSION['userfname'];?>';
    var offerprice = $("#customOfferText").val();


    
    $(".success-offer").load("process_offer.php", {

      //Variables passed to process_signup.php : Variables declared in this function (X:Y)
      command:command,
      listingID:listingID,
      sender:sender,
      recipientID:recipientID,
      recipientFirstName:recipientFirstName,
      senderFirstName:senderFirstName,
      offerprice:offerprice
  

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

		
		<div class="container-fluid">

		<div class="carousel-setting mt-3">
			<div id="carouselExampleIndicators" class="carousel carousel-dark slide" data-bs-ride="true">
			  <div class="carousel-indicators">

			  	<?php 

			  		for($count = 0; $count < sizeof($imgarray) ; $count++){

			  			echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'.$count.'" class="active" aria-current="true" aria-label="Slide '.($count+1).'"></button>';

			  		}

			  	?>

			  	</div>



			    <!--<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
			    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
			    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>

			    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button> -->


			  <div class="carousel-inner">

			  	<?php 

			  		for($count = 0; $count < sizeof($imgarray) ; $count++){

			  			if($count == 0){

			  				echo '<div class="carousel-item active">
						      <img src="listing/'.$imgarray[$count].'" class="set-img-size img-fluid mx-auto d-block" alt="...">
						    </div>'; 

			  			} else{

			  				echo '<div class="carousel-item">
						      <img src="listing/'.$imgarray[$count].'" class="set-img-size img-fluid mx-auto d-block" alt="...">
						    </div>'; 

			  			}

					    //echo $imgarray[$count];

			  		}

			  	?>

			    <!--<div class="carousel-item active">
			      <img src="somepics/nihongo.jpg" class="set-img-size img-fluid mx-auto d-block" alt="...">
			    </div>
			    <div class="carousel-item">
			      <img src="somepics/python.jpg" class="set-img-size img-fluid mx-auto d-block" alt="...">
			    </div>
			    <div class="carousel-item">
			      <img src="somepics/androidprog.jpg" class="set-img-size img-fluid mx-auto d-block" alt="...">
			    </div>

			    <div class="carousel-item">
			      <img src="somepics/cplus.jpg" class="set-img-size img-fluid mx-auto d-block" alt="...">
			    </div> -->



			  </div>
			  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="visually-hidden">Previous</span>
			  </button>
			  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="visually-hidden">Next</span>
			  </button>
			</div>

		</div>

			<div class="container-fluid book-details mt-3">
				<h1 class="display-6 heading-labels"><strong>Book Details</strong></h1>

				<div class="row">

					<div class="col-xl-6 col-setting">
						
						<div class="d-flex justify-content-center">
							
							<div class="col seller-img">
							<?php 

								echo '<a href="profilesummary.php?vp='.urlencode(base64_encode($sellerID)).'"><img src="profile/'.$sellerProfilePic.'" class="set-seller-img-size"></a>';

								if(isset($_SESSION['userID']) && $_SESSION['userID'] == $sellerID){

									echo '<label class = "font-setting text-muted add-margin-left">Posted by You on '.$listingDate.'</label>';

								} else{

									echo '<label class = "font-setting text-muted add-margin-left">Posted by <a href="profilesummary.php?vp='.urlencode(base64_encode($sellerID)).'" class="text-decoration-none text-muted"><strong>'.$sellerfirstname.' '.$sellerlastname.'</strong></a> on '.$listingDate.'</label>';

								}
								
								
								
							?>

							</div>

						</div>

						<?php 

							echo '<h1 class="display-5"><strong>'.$bookTitle.'</strong></h1>';
							echo '<hr>';
							echo '<h5 style="color: #FA5353;"><strong>RM'.$bookPrice.'</strong></h5><br>';
							echo '<h6><strong>Category:</strong> '.$bookCategory.'</h6>';
							echo '<h6><strong>Condition:</strong> '.$bookCondition.'</h6>';
							echo '<h6><strong>Author(s):</strong> '.$bookAuthors.'</h6>';
							echo '<h6><strong>ISBN Number:</strong> '.$bookISBN.'</h6>';
							echo '<h6><strong>Book for Course:</strong> '.$bookCourseCode.' '.$bookCourseName.'</h6>';
							echo '<h6><strong>Subject Code:</strong> '.$bookSubjectCode.'</h6><br>';
							echo '<h6><strong>Book Description</strong></h6>';
							echo '<div class="set-desc-bg">';
							echo '<label>'.$bookDescription.'</label>';
							//echo '<label>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</label>';
							echo '</div>';


						?>
						
						

					</div>

					<div class="col-xl-6">

						
						<div class="card text-center">
							<?php
								if(isset($_SESSION['adminID'])){

									echo '<h5 class="card-header opacity-50">Admin Action</h5>';

								} else if(isset($_SESSION['userID']) && $_SESSION['userID'] === $sellerID){

									echo '<h5 class="card-header opacity-50">Action</h5>';

								}else {

									echo '<h5 class="card-header opacity-50">Interested?</h5>';
								}
							?>
						  <!--<h5 class="card-header opacity-50">Interested?</h5>-->
						  <div class="card-body">

						  	<?php 

						  		if(isset($_SESSION['userID']) && $bookApproved == 1 && $_SESSION['userID']!=$sellerID){
						  			$userID = $_SESSION['userID'];
						  			$checkWishlist = "SELECT * FROM wishlist WHERE user_id = '$userID' AND listing_id = '$listingID' LIMIT 1";

						  			$checkWishlistResult = mysqli_query($connect, $checkWishlist);

						  			if(mysqli_num_rows($checkWishlistResult) == 1){

						  					echo '<a href="processWishlist.php?wishlist-pg-active='.urlencode(base64_encode('false')).'&command='.urlencode(base64_encode('delete')).'&productid='.urlencode(base64_encode($listingID)).'"><button type="button" class="w-100 mb-3 btn btn-wishlist btn-lg text-truncate"><i class="bi bi-bookmark-heart-fill wishlist-icon"></i><strong>Remove From My Wishlist</strong></button></a>';

						  			} else {

						  					echo '<a href="processWishlist.php?wishlist-pg-active='.urlencode(base64_encode('false')).'&command='.urlencode(base64_encode('add')).'&productid='.urlencode(base64_encode($listingID)).'"><button type="button" class="w-100 mb-3 btn btn-wishlist btn-lg text-truncate"><i class="bi bi-bookmark-heart-fill wishlist-icon"></i><strong>Add to My Wishlist</strong></button></a>';
						  			}

						   			 echo '<button type="submit" class="w-100 mb-3 btn btn-offer btn-lg text-truncate" id="normalOffer"><i class="bi bi-tag-fill offer-icon"></i><strong>Make Offer for RM'.$bookPrice.'</strong></button>';

						   			 echo '<button type="submit" class="w-100 mb-3 btn btn-custom-offer btn-lg text-truncate" data-bs-toggle="collapse" data-bs-target="#customOfferCollapse"><i class="bi bi-cash-coin offer-icon"></i><strong>Make Custom Offer</strong></button>';

						   			 echo '<div class="collapse" id="customOfferCollapse">
										  <div class="card card-body border-0">
										    <div class="row g-3">
												  <div class="col-sm-8">
												  <form id="customOfferForm" name="customForm">
												    <input type="text" class="form-control w-100 text-center font-weight-bold" id ="customOfferText" placeholder="RM" aria-label="Custom Offer" name="offer-input" required>
												  </div>
												  <div class="col-sm-4">
												  		<button class="btn btn-send-custom w-100" id="customOffer" type="submit">Send</button>
												  </div>
												  </form>
												</div>
										  </div>
										</div>';
						   			// echo '<span class="success-offer"></span>';

						   			

						  		}	else if(isset($_SESSION['userID']) && $_SESSION['userID'] === $sellerID && $bookApproved == 1){

						  			//echo '<a href="editBookListing.php?title='.$bookTitle.'&productid='.$listingID.'"><button type="button" class="w-100 mb-3 btn btn-user-edit btn-lg text-truncate text-white"><strong>Edit Listing</strong></button></a>';

						  			echo '<a href="editBookListing.php?zvsm3Qw='.urlencode(base64_encode($listingID)).'"><button type="button" class="w-100 mb-3 btn btn-user-edit btn-lg text-truncate text-white"><strong>Edit Listing</strong></button></a>';

						  			/*echo '<form action="editBookListing.php?title='.$bookTitle.'&productid='.$listingID.'" method="POST">
											<button type="submit" class="w-100 mb-3 btn btn-user-edit btn-lg text-truncate text-white"><strong>Edit Listing</strong></button>

						  				</form>';*/


						  			echo '<a href="#"><button type="button" class="w-100 mb-3 btn btn-delete-listing btn-lg text-truncate text-white"><strong>Delete Listing</strong></button></a>';



						  		} else if((isset($_SESSION['userID']) && $_SESSION['userID'] === $sellerID && $bookApproved == 3) || (isset($_SESSION['userID']))&&$bookApproved==3 || (isset($_SESSION['adminID']) && $bookApproved==3)){

						  			echo '<div class="alert alert-success" role="alert">
											 			This book listing has already been sold!
										  		</div>';



						  		} else if(isset($_SESSION['userID']) && $bookApproved == 0){

						  			echo '<div class="alert alert-warning" role="alert">
											 			This listing is currently pending approval
										  		</div>';



						  		} else if(isset($_SESSION['adminID']) && $bookApproved == 0) {

						  				echo '<a href="processPending.php?action=approve&productid='.$listingID.'"><button type="button" class="w-100 mb-3 btn btn-success btn-lg text-truncate"><strong>Approve Listing</strong></button></a>';

						  				echo '<button type="button" class="w-100 mb-3 btn btn-danger btn-lg text-truncate" data-bs-toggle="modal" data-bs-target="#rejectlisting"><strong>Reject Listing</strong></button>';




						  		} else if(isset($_SESSION['adminID']) && $bookApproved == 1) {

						  			echo '<a href="editBookListing.php?zvsm3Qw='.urlencode(base64_encode($listingID)).'"><button type="button" class="w-100 mb-3 btn btn-info btn-lg text-truncate text-white"><strong>Edit Listing</strong></button></a>';



						  		} else if((isset($_SESSION['userID']) && $sellerID == $_SESSION['userID']) && $bookApproved == 2){

						  			echo '<div class="alert alert-danger" role="alert">
											 	This listing was rejected<hr>
											 	<strong>Reason: </strong>'.$rejectMessage.'<hr>
											 	<a href="" class="text-decoration-none">Remove Listing</a>
										  </div>';



						  		} else if(((isset($_SESSION['adminID']) || isset($_SESSION['userID'])) && $bookApproved == 2)){
						  			echo '<div class="alert alert-danger" role="alert">
											 	This listing was rejected
										  </div>';



						  		} else {

						  			echo '<div class="alert alert-warning" role="alert">
											 Please log in to view actions
										  </div>';
						  		}

						  	?>


						  </div>
						</div>



					</div>

					
				</div>

			</div>

			
		</div>

		<div class="toast-container position-fixed bottom-0 end-0 p-3">
	  <div id="normalOfferToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
	    <div class="toast-header">
	      <img src="somepics/book-pack.svg" width="20" height="20" class="rounded me-2" alt="...">
	      <strong class="me-auto text-truncate">Offer for <?php echo $bookTitle;?></strong>
	      <small><?php date_default_timezone_set("Asia/Kuching"); echo date('h:i');?></small>
	      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
	    </div>
	    <div class="toast-body">
	      <span class="success-offer"></span>
	    </div>
	  </div>
	</div>


	<div class="toast-container position-fixed bottom-0 end-0 p-3">
	  <div id="customOfferToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
	    <div class="toast-header">
	      <img src="somepics/book-pack.svg" width="20" height="20" class="rounded me-2" alt="...">
	      <strong class="me-auto text-truncate">Offer for <?php echo $bookTitle;?></strong>
	      <small><?php date_default_timezone_set("Asia/Kuching"); echo date('h:i');?></small>
	      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
	    </div>
	    <div class="toast-body">
	      <span class="success-offer"><span style="color:red">Please enter your custom offer!<span></span>
	    </div>
	  </div>
	</div>

	<!-- Modal -->
<div class="modal fade" id="rejectlisting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-1 w-100 text-center text-white" id="exampleModalLabel">Reject Book Listing</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="processPending.php?action=reject&productid=<?php echo $listingID; ?>" method="POST">
      <div class="modal-body">
        <textarea class="border-0 w-100 ta-height" placeholder="Please state reason for rejection" name="reject-msg" required></textarea>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-outline-danger rounded-pill" data-bs-dismiss="modal"><i class="bi bi-x-lg icon-mr"></i> Close</button>
        <button class="btn btn-outline-success rounded-pill"><i class="bi bi-check-circle icon-mr"></i> Confirm</button>
    </form>
      </div>
    </div>
  </div>
</div>




	</main>



<script>
const toastTrigger = document.getElementById('normalOffer')
const toastLiveExample = document.getElementById('normalOfferToast')
if (toastTrigger) {
  toastTrigger.addEventListener('click', () => {
    const toast = new bootstrap.Toast(toastLiveExample)

    toast.show()
  })
}


const toastTriggerCustom = document.getElementById('customOffer')
//const textInput = document.getElementById('customOfferText').value;
var input = document.forms["customForm"]["offer-input"].value;
const toastLiveExampleCustom = document.getElementById('customOfferToast')
if (toastTriggerCustom) {
  toastTriggerCustom.addEventListener('click', () => {

  			const toastCustomOffer = new bootstrap.Toast(toastLiveExampleCustom)

    		toastCustomOffer.show()
  	
   
  })

} 


</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


<!-- CUSTOM JAVASCRIPT -->
<script type="text/javascript" src="js/javascript.js"></script>
</body>
</html>