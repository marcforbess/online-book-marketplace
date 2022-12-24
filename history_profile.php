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
	<title>Profile</title>
	<!--BOOTSTRAP ICONS-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

	<!--CUSTOM CSS -->
	<!--<link rel="stylesheet" type="text/css" href="css/bootstrap.css"> -->
	<link rel="stylesheet" type="text/css" href="css/navstyling.css">
	<link rel="stylesheet" type="text/css" href="css/loginstyle.css">
	<link rel="stylesheet" type="text/css" href="css/signupstyle.css">
	<link rel="stylesheet" type="text/css" href="css/history_profile.css">
	<link rel="icon" href="somepics/book-pack.svg">

	<!--BOOTSTRAP CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<title>Final Year Project</title>

	<!-- AJAX -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


	<script>
	
	//Ajax for changing password
	$(document).ready(function (){
    $("#change-password").submit(function(e) {

    //Prevent default action of form
    e.preventDefault();

    //Get variables from input field
    
    var commandPw = 'edit-password';
    var oldpw = $("#old-pw").val();
    var newpw = $("#new-pw").val();
    var confirmpw = $("#confirm-pw").val();
    
    
    $(".error-msg").load("editProfile.php", {

      //Variables passed to process_signup.php : Variables declared in this function (X:Y)
      commandPw:commandPw,
      oldpw:oldpw,
      newpw:newpw,
      confirmpw:confirmpw

    })

  });
});

	//Ajax for changing Name
	$(document).ready(function (){
    $("#change-name").submit(function(e) {

    //Prevent default action of form
    e.preventDefault();

    //Get variables from input field
    
    var commandName = 'edit-name';
    var oldfname = '<?php echo $_SESSION['userfname'] ?>';

    var oldlname = '<?php echo $_SESSION['userlname'] ?>';
    
    var newfname = $("#new-first-name").val();
    var newlname = $("#new-last-name").val();
    
    
    $(".error-msg").load("editProfile.php", {

      //Variables passed to process_signup.php : Variables declared in this function (X:Y)
      commandName:commandName,
      oldfname:oldfname,
      oldlname:oldlname,
      newfname:newfname,
      newlname:newlname

    })

  });
});


	//Ajax for changing Phone Number
	$(document).ready(function (){
    $("#change-phone").submit(function(e) {

    //Prevent default action of form
    e.preventDefault();

    //Get variables from input field
    
    var commandPhone = 'edit-phone';
    var oldphone = '<?php echo $_SESSION['userphonenum'] ?>';
    var newphone = $("#new-phone-num").val();
    
    
    $(".error-msg").load("editProfile.php", {

      //Variables passed to process_signup.php : Variables declared in this function (X:Y)
      commandPhone:commandPhone,
      oldphone:oldphone,
      newphone:newphone

    })

  });
});


	//Ajax for changing Course
	$(document).ready(function (){
    $("#change-course").submit(function(e) {

    //Prevent default action of form
    e.preventDefault();

    //Get variables from input field
    
    var commandCourse = 'edit-course';
    var oldcourse = '<?php echo $_SESSION['userCourseID'] ?>';
    var newcourse = $("#floatingSelect").val();
    
    
    $(".error-msg").load("editProfile.php", {

      //Variables passed to process_signup.php : Variables declared in this function (X:Y)
      commandCourse:commandCourse,
      oldcourse:oldcourse,
      newcourse:newcourse

    })

  });
});












	</script>








</head>
<body>

<header>
<?php 
	include("real_navbar.php");

	if(isset($_SESSION['userID'])){

			//Take some session variables from login

			$usercourseID = $_SESSION['userCourseID'];
			$datejoined = $_SESSION['datejoined'];
			$phonenum = $_SESSION['userphonenum'];
			$fetchedcoursecode = "";
			$fetchedcoursename = "";

			$getCourse = getCourseDetails($connect, $usercourseID);
			foreach ($getCourse as $row) {
				$fetchedcoursecode = $row['course_code'];
				$fetchedcoursename = $row['course_name'];
			}


		}
?>

</header>

<main>
	
	<div class="container-fluid">
	  <div class="row place-gap">

	  	<!-- This column is for personal details -->
	    <div class="col-sm col-setting">
	    	<!--<h1 class="display-5 heading-labels"><strong>My Profile</strong></h1> -->
	      <!--<div class="user-pic"> -->

	      	<?php 

	      		/*if($userprofilepic==0){
					echo '<img src="profile/avatar2.jpeg" class="img-fluid-mod img-sizing mx-auto d-block pe-cursor" onclick = "uploadBookPicTrigger()" id="picPlaceholder">';
				} else{
					echo "<img src='profile/profile".$userid.".jpg?'".mt_rand()." class='img-fluid-mod img-sizing mx-auto d-block pe-cursor' onclick='uploadBookPicTrigger()' id='picPlaceholder'> ";
					//echo "<img src='profile/profile".$userid.".jpg' class='avatar'></div>";
					//echo "<img src='profile/profile".$userid.".jpg' class='avatar'>";
					//echo '<img src="profile/avatar2.jpeg">';
				} */
				echo '<img src="profile/'.$_SESSION['userpicpath'].'" class="img-fluid-mod img-sizing mx-auto d-block pe-cursor" onclick = "uploadBookPicTrigger()" id="picPlaceholder">';

	      	?>

	      	<form action="changeProfilePic.php" method = "POST" enctype="multipart/form-data">
	      	<div class="container">
	      	<div class="input-group add-mt-15">
	      		<!--id="inputGroupFile04" -->
			  <input type="file" class="form-control" name="uploadprofilepic" id="bookImage" onchange = "displayPicture(this)" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
			  <button class="btn btn-outline-success" name="submitprofilepic" type="submit" id="inputGroupFileAddon04">Save Changes</button>
			</div>
			</div>
			</form>
	      	<!--<img src="profile/avatar2.jpeg" class="img-fluid img-sizing mx-auto d-block"> -->
	      <!--</div> -->

	      <!--<h1 class="heading-username align-personal-details"><strong>Amazon Web</strong></h1> -->
	      <?php 

	      	echo '<div class="container-fluid">
					<h1 class="heading-username align-name-heading">'.$_SESSION['userfname'].' '.$_SESSION['userlname'].'<button class="btn border-0 btn-outline-info add-ml" data-bs-toggle="modal" data-bs-target="#editName"><i class="bi bi-pencil-square"></i></button></h1>
					<div class = "align-personal-details">
					<p><a href="#" class="text-decoration-none text-info" data-bs-toggle="modal" data-bs-target="#editPassword">Change Password</a></p>
					<label><b>My E-Mail</b></label><br>
					<p>'.$_SESSION['useremail'].'</p>
					<label><b>Phone Number</b><button class="btn border-0 btn-outline-info add-ml" data-bs-toggle="modal" data-bs-target="#editPhoneNum"><i class="bi bi-pencil-square"></i></button></label><br>
					<p>'.$phonenum.'</p>
					<label><b>My Course</b></label><button class="btn border-0 btn-outline-info add-ml" data-bs-toggle="modal" data-bs-target="#editCourse"><i class="bi bi-pencil-square"></i></button><br>
					<p>'.$fetchedcoursecode.' '.$fetchedcoursename.'</p>
					<label><b>Date Joined</b></label><br>
					<p>'.$datejoined.'</p>
					</div>
				</div>';

	      ?>
	      
	    </div>

	    <!-- This column is for listing history -->
	    <div class="col-sm col-setting add-pb-1rem overflow-auto">
	    	<h1 class="display-6 heading-labels"><strong>My Listings</strong></h1>
	    	
	    	<!--<div class="container listing-container hide-overflow">
	    		<div class="row"> -->

	    			<?php 
	    					//PHP Code to get user listing history (if any)
	    					if(isset($_SESSION['userID'])){


							$userID = $_SESSION['userID'];
							$myListingCount = getMyListingCount($connect, $userID);

							//If the user has no listings
							if($myListingCount == 0){
								echo '<div class="container-fluid align-icon-center"><i class="bi bi-folder-x no-listing-icon"></i></div>';
								echo '<p style = "padding: 20px 20px;">Looks like you have no listings! Create a listing at the Sell My Book Section then come back.</p>';

							//If the user has listings
							} else{


									$getMyListingDetails = getMyListing($connect, $userID);

									foreach ($getMyListingDetails as $fetchedListing) {
										include("include/mylisting_info.php");

										$getBookCourse = getCourseDetails($connect, $bookCourseInt);
										foreach ($getBookCourse as $row) {
											$bookCourseName = $row['course_name'];
											$bookCourseCode = $row['course_code'];
										}


									echo '<a href="viewProduct.php?productid='.urlencode(base64_encode($listingID)).'" class="text-decoration-none text-dark"><div class="container listing-container hide-overflow">
	    								<div class="row">';

										echo '<div class="col-4">
					    				<img src="listing/'.$imagePath.'" class="img-thumbnail mylisting-img add-mt-15">
					    				
					    				</div>';

						    			echo '<div class="col-8 mylisting-details">

						    				<h5 class="add-mt-15"><strong>'.$bookTitle.'</strong></h5>
						    				<label>'.$bookCategory.'</label><br>
						    				<label><strong>'.$bookCourseCode.'</strong> '.$bookCourseName.'</label><br>
						    				<label>Posted on <strong>'.$listingDate.'</strong></label><br>
						    				<label><strong>RM'.$bookPrice.'</strong></label>';

						    				//Pending Approval (Not Approved and Not Rejected)
											if($bookApprovalStatus == 0){
												echo '<h5 style="color: #FAAE54">PENDING APPROVAL</h5>';

											} else if($bookApprovalStatus == 1){ //Approved 

												echo '<h5 style="color: #7ED957">ACTIVE</h5>';

											} else if($bookApprovalStatus == 2){ //Rejected

												echo '<h5 style="color: #FF5757">REJECTED</h5>';

											} else if($bookApprovalStatus == 3){

												echo '<h5 style="color: #FF5757">SOLD</h5>';

											}

						    				echo '</div>';
						    				echo '<br>';


						    			echo '</div>';
						    			echo '</div></a>';






							}


						}

					} 



	    				?>
	    			
	    			<!--<div class="col-4">
	    				<img src="somepics/python.jpg" class="img-thumbnail mylisting-img add-mt-15">
	    				
	    			</div> -->

	    			<!--<div class="col-8 mylisting-details">

	    				<h6 class="add-mt-15"><strong>Rich Dad Poor Dad is the thingy where the poor dad is actually just a regular man</strong></h6>

	    			</div> -->

	    		<!-- </div>  Here is for row -->

	    	<!--</div> Here is for container-->
	      
	    </div>

	    <?php 
	    	$reviewCount = getReviewsCount($connect, $userID);
	    ?>
	    <div class="col-sm col-setting add-pb-1rem overflow-auto">
	      <h1 class="display-6 heading-labels"><strong>My Reviews (<?php echo $reviewCount;?>)</strong></h1>

	      <div class="container-fluid mt-3">

	      	<?php 
	      		if($reviewCount == 0){

	      			echo '<div class="container-fluid align-icon-center"><i class="bi bi-folder-x no-listing-icon"></i></div>';
					echo '<p class="text-center">No reviews yet</p>';


	      		} else {

	      			$reviews = getReviews($connect, $userID);

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



	      				echo '<div class="card border-0 mb-3">	  
						  <div class="card-body">
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
						</div>';


	      				

	      			}


	      		}
	      	?>

	      	<!--<div class="card border-0 mb-3">	  
			  <div class="card-body">
			    <h5 class="card-title">5.0 <i class="bi bi-star-fill text-warning"></i></h5>
			    <p class="card-text">
			    	
			    	<figure>
					  <blockquote class="blockquote">
					    <p>A well-known quote, contained in a blockquote element.</p>
					  </blockquote>
					  <figcaption class="blockquote-footer">
					    21 Aug 2022 by  <cite title="Source Title">Jenny Tals</cite>
					  </figcaption>
					</figure>
			    </p>
			  </div>
			</div>-->







	      	
	      </div>


	    </div>
	  </div>
	</div>



	<!-- Edit Name Modal !-->
	<div class="modal fade" id="editName" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h1 class="modal-title fs-2 w-100 text-center text-white" id="exampleModalLabel">Edit Name</h1>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	      	<p class="error-msg"></p>
	        <form action="editProfile.php?command=edit-name" method="POST" id="change-name">
	        	<div class="row">
				  <div class="col">
				    <input type="text" class="form-control" id = "new-first-name"placeholder="First Name" aria-label="First name" required>
				  </div>
				  <div class="col">
				    <input type="text" class="form-control" id="new-last-name" placeholder="Last name" aria-label="Last name" required>
				  </div>
				</div>
	        
	      </div>
	      <div class="modal-footer w-100 justify-content-center">
	        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
	        <button type="submit" class="btn btn-success">Save Name</button>
	      </div>
	  </form>
	    </div>
	  </div>
	</div>


	<!-- Change Password Modal !-->
	<div class="modal fade" id="editPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h1 class="modal-title fs-2 w-100 text-center text-white" id="exampleModalLabel">Change Password</h1>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	      	<p class="error-msg"></p>
	        <form action="editProfile.php?command=edit-password" method="POST" id="change-password">
	        	<input class="form-control mb-3" type="password" placeholder="Old Password" aria-label="default input example" id="old-pw" required>

	        	<input class="form-control mb-3" type="password" placeholder="New Password" aria-label="default input example" id="new-pw" required>

	        	<input class="form-control" type="password" placeholder="Confirm New Password" aria-label="default input example" id="confirm-pw" required>

	        
	      </div>
	      <div class="modal-footer w-100 justify-content-center">
	        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
	        <button type="submit" class="btn btn-success">Save Password</button>
	      </div>
	 	 </form>
	    </div>
	  </div>
	</div>



	<!-- Edit Phone Number Modal !-->
	<div class="modal fade" id="editPhoneNum" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h1 class="modal-title fs-2 w-100 text-center text-white" id="exampleModalLabel">Edit Phone Number</h1>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	      	<p class="error-msg"></p>
	        <form action="editProfile.php?command=edit-phone" method="POST" id="change-phone">
	        	<input class="form-control" id="new-phone-num" type="text" placeholder="Format: 01XXXXXXXX" aria-label="default input example" required>

	        
	      </div>
	      <div class="modal-footer w-100 justify-content-center">
	        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
	        <button type="submit" class="btn btn-success">Save Number</button>
	      </div>
	 	 </form>
	    </div>
	  </div>
	</div>


	<!-- Edit Course Modal !-->
	<div class="modal fade" id="editCourse" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h1 class="modal-title fs-2 w-100 text-center text-white" id="exampleModalLabel">Change Course</h1>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	      	<p class="error-msg"></p>
	        <form action="editProfile.php?command=edit-course" method="POST" id="change-course">
	        	<div class="form-floating mb-3">
				  <select name="change-course-select" class="form-select" id="floatingSelect" aria-label="Floating label select example">
					<?php 
						$allcourse = getAllCourse($connect);
						foreach ($allcourse as $row) {
							echo '<option value="'.$row['course_id'].'">'.$row['course_code'].' '.$row['course_name'].'</option>';
									    
						}


					?>

					</select>
				<label for="floatingSelect">Select Course</label>
				</div>
	        
	      </div>
	      <div class="modal-footer w-100 justify-content-center">
	        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
	        <button type="submit" class="btn btn-success">Change Course</button>
	      </div>
	 	 </form>
	    </div>
	  </div>
	</div>













</main>




<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


<!-- CUSTOM JAVASCRIPT -->
<script type="text/javascript" src="js/javascript.js"></script>
</body>
</html>