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
	<title>Sell My Book</title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

	<!--CUSTOM CSS -->
	<!--<link rel="stylesheet" type="text/css" href="css/bootstrap.css"> -->
	<link rel="stylesheet" type="text/css" href="css/navstyling.css">
	<!--<link rel="stylesheet" type="text/css" href="css/loginstyle.css">
	<link rel="stylesheet" type="text/css" href="css/signupstyle.css"> -->
	<!--<link rel="stylesheet" type="text/css" href="css/history_profile.css"> -->
	<link rel="stylesheet" type="text/css" href="css/book_profiling.css">
	<link rel="icon" href="somepics/book-pack.svg">

	<!--BOOTSTRAP CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	

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
	
	<div class="container-fluid grey-bg">

		<!--UPLOAD PIC -->
	
	<form action="addBookListing.php" method="POST" enctype="multipart/form-data">
		<div class="container container-setting">
			<h1 class="display-6 h1-padding">Book Picture (Upload up to 5)</h1>


		<!-- PIC 1 -->
			<div class="text-center">
				<img src="somepics/no_img.jpg" class="img-fluid rounded user-img-setting pe-cursor" onclick = "uploadBookPicTrigger()" id="picPlaceholder">
			</div>

			<div class="text-center choose-files">
				<input type="file" name="uploadbookpic" id="bookImage" onchange="displayPicture(this)" required>
			</div>

		<!-- PIC 2 -->

			<div class="text-center">
				<img src="somepics/no_img.jpg" class="img-fluid rounded user-img-setting pe-cursor" onclick = "uploadBookPicTrigger2()" id="picPlaceholder2">
			</div>

			<div class="text-center choose-files">
				<input type="file" name="sidepics[]" id="bookImage2" onchange="displayPicture2(this)" >
			</div>


			<!-- PIC 3 -->

			<div class="text-center">
				<img src="somepics/no_img.jpg" class="img-fluid rounded user-img-setting pe-cursor" onclick = "uploadBookPicTrigger3()" id="picPlaceholder3">
			</div>

			<div class="text-center choose-files">
				<input type="file" name="sidepics[]" id="bookImage3" onchange="displayPicture3(this)" >
			</div>


			<!-- PIC 4 -->
			<div class="text-center">
				<img src="somepics/no_img.jpg" class="img-fluid rounded user-img-setting pe-cursor" onclick = "uploadBookPicTrigger4()" id="picPlaceholder4">
			</div>

			<div class="text-center choose-files">
				<input type="file" name="sidepics[]" id="bookImage4" onchange="displayPicture4(this)" >
			</div>


			<!-- PIC 5 -->
			<div class="text-center">
				<img src="somepics/no_img.jpg" class="img-fluid rounded user-img-setting pe-cursor" onclick = "uploadBookPicTrigger5()" id="picPlaceholder5">
			</div>

			<div class="text-center choose-files">
				<input type="file" name="sidepics[]" id="bookImage5" onchange="displayPicture5(this)" >
			</div>
		


















			<script>
				
				$("#bookImage").on("change", function() {
				    if ($("#bookImage")[0].files.length > 2) {

				    	alert("You can select only 2 images");
				    	$('#confirm-listing').attr('disabled', 'disabled');
			
				    } else{

				    	$("#confirm-listing").removeAttr('disabled');

				    }
				});				
			</script>
			
		</div>

		<!--THE LISTING DETAILS -->
		<div class="container container-setting">
			<h1 class="display-6 h1-padding">Listing Details</h1>

			<div class="row">

				<div class="col">

					<label class="selectlabel">Book Category</label><br>
					<select name="type-of-sale" class="w-100 select-box" required>
							<option value="" selected>Select Category</option>
							
							<?php 
								$category = getCategory($connect);
								foreach ($category as $row) {
									echo '<option value = "'.$row['cat_id'].'">'.$row['cat_name'].'</option>';
								}
							?>
					</select><br> 

				</div>

				<div class="col">
					
					<label class="selectlabel">Book Course Code</label><br>
					<select name="course-code" class="w-100 select-box" required>
						<?php
							$getcourse = "SELECT * FROM course";
							$result = mysqli_query($connect, $getcourse);
							while($fetchedrows = mysqli_fetch_array($result)){
								echo "<option value = '".$fetchedrows[0]."'>".$fetchedrows[1].' '.$fetchedrows[2]."</option>";
							}
						?>
						
					</select><br>

				</div>

				<div class="col">
					
					<label class="selectlabel">Select Book Condition</label><br>
					<select name="book-condition" class="w-100 select-box" required>
						<option value="Pristine">Pristine</option>
						<option value="Used">Used</option>
					</select><br> 

				</div>

				<div class="col">
					
					<label class="subjectlabel">Enter Subject Code</label><br>
					<input type="text" class="input-box" name="subject-code" placeholder="e.g. KTXXX03" required> 

				</div>

				
			</div>

		</div>

		<!-- BOOK DETAILS -->
		<div class="container container-setting">
			<h1 class="display-6 h1-padding">Book Details</h1>

			<div class="container text-center">
				
				<div class="form-floating mb-3">

				 	<input type="text" name="isbn-no" class="form-control form-control-sm rounded-corners" id="isbn-no" placeholder="ISBN Number" required>
				  	<label for="isbn-no">ISBN No. Format: XXX-X-XX-XXXXXX-X</label>

				</div>

				<div class="form-floating mb-3">

				 	<input type="text" name="author" class="form-control form-control-sm rounded-corners" id="author" placeholder="Author(s)" required>
				  	<label for="author">Book Author(s)</label>

				</div>

				<div class="form-floating mb-3">

				 	<input type="text" name="title" class="form-control form-control-sm rounded-corners" id="title" placeholder="Book Title" required>
				  	<label for="author">Book Title</label>

				</div>

				<div class="form-floating mb-3">

				 	<input type="number" min="0.00" max="10000.00" step="0.10" name="price" class="form-control form-control-sm rounded-corners" id="price" placeholder="RM" required>
				  	<label for="author">RM</label>

				</div>

				<div class="form-floating mb-3">
				  <textarea class="form-control textarea-height" name="description" placeholder="Book Description" id="floatingTextarea2" required></textarea>
				  <label for="floatingTextarea2">Book Description</label>
				</div>

				<button type="submit" id="confirm-listing" onclick="checkFileLength(this)" name="confirm" class="confirm-book mt-3 w-25">CONFIRM LISTING</button>


			</div>
			
		</div>
	</form>
			

	</div>

</main>



<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


<!-- CUSTOM JAVASCRIPT -->
<script type="text/javascript" src="js/javascript.js"></script>
</body>
</html>