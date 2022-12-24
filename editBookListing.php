<?php 
	include_once 'include/connectdb.php';
	include_once 'sql_functions.php';
	session_start();

	//$bookTitle = $_GET['title'];
	//$listingID = $_GET['productid'];
	$listingID = htmlspecialchars(base64_decode(urldecode($_GET['zvsm3Qw'])));

	/*if(!empty($listingID)){
		echo $listingID;
	}else {
		echo "Not found";
	}*/
	



	if(!isset($_SESSION['userID']) && !isset($_SESSION['adminID'])){
		header("Location:index.php?unauthorizedaccess");
	}

	//$listingDetails = getListingDetails($connect, $listingID);


	$listingDetails = getListingDetails($connect, $listingID);

		if(count($listingDetails) == 0){

			header("Location:index.php?product=notfound");

		}

	foreach ($listingDetails as $fetchedRows) {
		include("include/listing_info.php");
		
	}

	//Get Course Details
	$fetchedCourseDetails = getCourseDetails($connect, $bookCourseInt);
		foreach ($fetchedCourseDetails as $row) {
							
			$bookCourseCode = $row['course_code'];
			$bookCourseName = $row['course_name'];
		}

	$sellerDetails = getSellerDetails($connect, $listingID);
				$sellerfirstname = "";

				foreach($sellerDetails as $row){

					$sellerfirstname = $row['user_fname'];
					$sellerlastname = $row['user_lname'];
					$sellerProfilePic = $row['user_picpath'];

				}

				$sellername = $sellerfirstname.' '.$sellerlastname;



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
	<link rel="stylesheet" type="text/css" href="css/searchresult.css">
	<link rel="stylesheet" type="text/css" href="css/editbooklisting.css">
	<link rel="icon" href="somepics/book-pack.svg">


	<!--BOOTSTRAP CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	

	<script src="https://kit.fontawesome.com/98355d8df9.js" crossorigin="anonymous"></script>
	<title>Edit <?php echo $bookTitle; ?></title>
</head>
<body>

	<header>
		<?php 
			include('real_navbar.php');
		?>
	</header>

	<main>

		<div class="container-fluid mt-3">
			<div class="container-fluid bg-grey border-rad">
				<h1 class="display-6 px-3 py-2">Edit <strong><?php echo $bookTitle; ?></strong></h1>
				<?php 
					if(isset($_SESSION['adminID'])){

						echo '<div class="container-fluid px-3 py-2">

						<img src="profile/'.$sellerProfilePic.'" class="pic-sizing">
						<span class="text-muted px-3">Posted by '.$sellername.' on '.date('d M Y', strtotime($listingDate)).'</span>

						</div>';

						

					}
				?>
				<div class="container-fluid">
					<div class="row mt-3">

						<div class="col-xl-3 py-3 px-3">

							<?php 
								echo '<img src="listing/'.$bookImgPath.'" class="mx-auto d-block listing-sizing">';
							?>
							
							
						</div>

						<div class="col-md">

							<div class="container-fluid px-3 py-3">


								<form action="process_editbooklisting.php" method="POST">

								<input type="hidden" id="listingID" name="listing-id" value="<?php echo $listingID; ?>">
								<input type="hidden" id="oriBookTitle" name="ori-btitle" value="<?php echo $bookTitle; ?>">
								<input type="hidden" id="sellerID" name="seller-id" value="<?php echo $sellerID; ?>">
								<div class="mb-3 row">
							    <label for="bookTitle" class="col-sm-2 col-form-label text-center px-0">Book Title</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="bookTitle" placeholder="<?php echo $bookTitle; ?>" name = "book-title">
							    </div>
							  </div>

							  <?php if(isset($_SESSION['userID'])){ ?>
							  <div class="mb-3 row">
							    <label for="bookPrice" class="col-sm-2 col-form-label text-center px-0">Book Price (RM)</label>
							    <div class="col-sm-10">
							      <input type="number" min="0.00" max="10000.00" step="0.10" class="form-control" id="bookPrice" placeholder="<?php echo $bookPrice; ?> -Input number only" name="book-price">
							    </div>
							  </div>
							<?php } ?>

							  <div class="mb-3 row">
							    <label for="bookAuthors" class="col-sm-2 col-form-label text-center px-0">Book Author(s)</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="bookAuthors" placeholder="<?php echo $bookAuthors; ?>" name="book-authors">
							    </div>
							  </div>

							  <div class="mb-3 row">
							    <label for="bookISBN" class="col-sm-2 col-form-label text-center px-0">Book ISBN</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="bookISBN" placeholder="<?php echo $bookISBN; ?>" name="book-isbn">
							    </div>
							  </div>

							  <div class="mb-3 row">
							    <label for="bookCourse" class="col-sm-2 col-form-label text-center px-0">Book for Course</label>
							    <div class="col-sm-10">
							      <select id="bookCourse" class="form-select text-muted" name="book-course">
							      	<option value="" selected>--Current Book Course (<?php echo $bookCourseCode.' '.$bookCourseName; ?>)--</option>
							      	<?php
										$getcourse = "SELECT * FROM course";
										$result = mysqli_query($connect, $getcourse);
										while($fetchedrows = mysqli_fetch_array($result)){
											echo "<option value = '".$fetchedrows[0]."'>".$fetchedrows[1].' '.$fetchedrows[2]."</option>";
										}
									?>
							      	
							      </select>
							    </div>
							  </div>

							  <div class="mb-3 row">
							    <label for="bookSubject" class="col-sm-2 col-form-label text-center px-0">Book Subject Code</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="bookSubject" placeholder="<?php echo $bookSubjectCode; ?>" name="book-subjectcode">
							    </div>
							  </div>

							  <?php if(isset($_SESSION['userID'])){ ?>
							  <div class="mb-3 row">
							    <label for="bookDescription" class="col-sm-2 col-form-label text-center px-0">Book Description</label>
							    <div class="col-sm-10">
							      <textarea class="form-control textarea-height" id="bookDescription" placeholder="<?php echo $bookDescription; ?>" name="book-desc"></textarea>
							    </div>
							  </div>
							  <?php } ?>

							  <div class="mt-3 row px-3 py-3">

							  	<button class="btn btn-outline-success rounded-pill w-50" name="submit-edit">Save Changes</button>
							  </div>

							  

								
							</form>
								
							</div>

							
						</div>
						
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	</main>





<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>