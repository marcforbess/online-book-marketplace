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
	<link rel="stylesheet" type="text/css" href="css/viewusers.css">
	<!--<link rel="stylesheet" type="text/css" href="css/loginstyle.css">
	<link rel="stylesheet" type="text/css" href="css/signupstyle.css">
	<link rel="stylesheet" type="text/css" href="css/homepage.css"> -->
	<link rel="icon" href="somepics/adminicon.png">

	<!--BOOTSTRAP CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

	<!-- AJAX -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


	<title>View Listings</title>

		<script>
		$(document).ready(function(){
		  $("#filterListing").on("keyup", function() {
		    var value = $(this).val().toLowerCase();
		 
		      $("#listingsTable tr").filter(function() {
		      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		    });
		   
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


		<div class="container-fluid my-3">
			<div class="container-fluid">

				<p><div class="container-fluid bg-grey border-rad container-setting py-2 px-3">
					<h1 class="display-6 w-100">Book Listings (<?php echo getListingCount($connect);?>)</h1>
					<button class="btn btn-outline-danger text-dark border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
				    <i class="bi bi-funnel"></i>Filter Listings
				  </button></p>


				<div class="collapse" id="collapseExample">
					<div class="card card-body bg-grey border-0">
					    <input class="form-control" id = "filterListing" type="text" placeholder="Listing details..">
					 </div>
				</div>

					<div class="table-responsive mt-3">


						<table class="table table-hover align-middle text-center">
						  <thead>
						    <tr class="table-warning">
						      <th scope="col">Pic</th>
						      <th scope="col">Listing ID</th>
						      <th scope="col">Book Title</th>
						      <th scope="col">Posted By (User ID)</th>
						      <th scope="col">Book Category</th>
						      <th scope="col">Book Course</th>
						      <th scope="col">Book Subject Code</th>
						      <th scope="col">Condition</th>
						      <th scope="col">ISBN No.</th>
						      <th scope="col">Authors</th>
						      <th scope="col">Price</th>
						      <th scope="col">Date</th>
						    </tr>
						  </thead>
						  <tbody id="listingsTable">

						  	<tr>

						  		<?php 
						  			$listing = getAllListing($connect);

						  			foreach ($listing as $fetchedRows) {

						  				include("include/listing_info.php");
						  				$dateFormat = date('d M Y', strtotime($listingDate));
						  				$sellerDetails = getDetailsFromID($connect, $sellerID);
						  				foreach ($sellerDetails as $row) {

						  					$sellerfname = $row['user_fname'];
						  					$sellerlastname = $row['user_lname'];

						  				}

						  				$coursedetails = getCourseDetails($connect, $bookCourseInt);
						  				foreach ($coursedetails as $row) {
						  					$bookCourseCode = $row['course_code'];
						  					$bookCourseName = $row['course_name'];
						  				}

						  				echo '<th scope="row">

										<img src="listing/'.$bookImgPath.'" class="mx-auto d-block listing-sizing">

										</th>


										 <td>'.$listingID.'</td>
										 <td class="text-truncate"><a href="viewProduct.php?productid='.urlencode(base64_encode($listingID)).'" class="text-decoration-none text-primary">'.$bookTitle.'</a></td>
										 <td>'.$sellerfname.' '.$sellerlastname.' ('.$sellerID.')</td>
										 <td>'.$bookCategory.'</td>
										 <td>'.$bookCourseCode.' '.$bookCourseName.'</td>
										 <td>'.$bookSubjectCode.'</td>
										 <td>'.$bookCondition.'</td>
										 <td>'.$bookISBN.'</td>
										 <td>'.$bookAuthors.'</td>
										 <td><strong>RM'.$bookPrice.'</strong></td>
										 <td>'.$dateFormat.'</td>

											      
										 </tr>';




						  			}
						  		?>
							<!--	 <th scope="row">

									 <img src="somepics/python.jpg" class="mx-auto d-block listing-sizing">

								</th>


								 <td>1</td>
								 <td class="text-truncate"><a href="viewProduct.php?productid=1">The Python Book</a></td>
								 <td>Amazon Web (2)</td>
								 <td>For Rent</td>
								 <td>HC00 Software Engineering</td>
								 <td>KT34403</td>
								 <td>Pristine</td>
								 <td>978-4-2645-8162-8</td>
								 <td>Python Davidson</td>
								 <td>RM50</td>
								 <td>21 Aug 2022</td>

									      
								 </tr> -->


						  </tbody>
						</table>


						
					</div>


				</div>
				
			</div>
			
		</div>






		
	</main>





<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


</body>
</html>
