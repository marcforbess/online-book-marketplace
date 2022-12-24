<?php 
	date_default_timezone_set("Asia/Kuching");

	include_once 'include/connectdb.php';
	include_once 'sql_functions.php';
	session_start();

	$userID = $_SESSION['userID'];

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
	<link rel="stylesheet" type="text/css" href="css/transactions.css">
	<link rel="icon" href="somepics/book-pack.svg">


	<!--BOOTSTRAP CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<title>My Transactions</title>

	<script src="https://kit.fontawesome.com/98355d8df9.js" crossorigin="anonymous"></script>

	<!-- AJAX -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

	<script>
	$(document).ready(function(){
	  $("#filterSold").on("keyup", function() {
	    var value = $(this).val().toLowerCase();
	 
	      $("#soldTable tr").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
	   
	  });
	});

	$(document).ready(function(){
	  $("#filterBought").on("keyup", function() {
	    var value = $(this).val().toLowerCase();
	 
	      $("#boughtTable tr").filter(function() {
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

		<div class="container-fluid">

			<div class="container-fluid mt-3">

				<ul class="nav nav-pills nav-justified mb-3 tab-setting" id="pills-tab" role="tablist">

					<li class="nav-item" role="presentation">

					<?php 
						if(isset($_GET['tab2active'])){

							echo '<button class="nav-link" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#sold" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa-solid fa-handshake-simple icon-mr"></i>Book Listings Sold</button>';


						} else {

							echo '<button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#sold" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa-solid fa-handshake-simple icon-mr"></i>Book Listings Sold</button>';


						}
					?>
				  
				  </li>
				  <li class="nav-item" role="presentation">

				  	<?php 
						if(isset($_GET['tab2active'])){

							echo '<button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#bought" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fa-sharp fa-solid fa-basket-shopping icon-mr"></i>Book Listings Bought</button>';


						} else {

							echo '<button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#bought" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fa-sharp fa-solid fa-basket-shopping icon-mr"></i>Book Listings Bought</button>';


						}
					?>


				   <!-- <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#bought" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fa-sharp fa-solid fa-basket-shopping icon-mr"></i>Book Listings Bought</button> -->
				  </li>


				</ul>
			</div>

			<div class="tab-content" id="myTabContent">

				<?php 
					if(isset($_GET['tab2active'])){

						echo '<div class="tab-pane fade" id="sold" role="tabpanel" aria-labelledby="home-tab" tabindex="0">';

					} else {

						echo '<div class="tab-pane fade show active" id="sold" role="tabpanel" aria-labelledby="home-tab" tabindex="0">';

					}
				?>

				<!--<div class="tab-pane fade show active" id="sold" role="tabpanel" aria-labelledby="home-tab" tabindex="0"> -->

					<div class="container-fluid tab-body-setting">
						<h1 class="display-6 px-2 py-2">Books I Sold</h1>

						<p><button class="btn btn-outline-light text-dark border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
				    	<i class="bi bi-funnel"></i>Filter Sold Books
				  		</button></p>

				  		<div class="collapse" id="collapseExample">
							<div class="card card-body bg-grey border-0">
							    <input class="form-control" id = "filterSold" type="text" placeholder="Type in transaction details..">
							 </div>
						</div>

						<div class="table-responsive mt-3">


						<table class="table table-striped align-middle text-center">
						  <thead>
						    <tr class="table-light">

						      <th scope="col">Book Pic</th>
						      <th scope="col">Book Title</th>
						      <th scope="col">Buyer Pic</th>
						      <th scope="col">Buyer Name</th>
						      <th scope="col">Sold For</th>
						      <th scope="col">Date/Time</th>
						      <th scope="col">Contact</th>
						      
						    </tr>
						  </thead>
						  <tbody id="soldTable">

						  	<?php 
						  		$soldbooks = getMyTransactions($connect, $userID, 0);

						  		foreach ($soldbooks as $row) {
						  				
						  			$bookpic = $row['bookImg'];
						  			$booktitle = $row['bookTitle'];
						  			$buyerpic = $row['buyerImg'];
						  			$buyername = $row['buyerfname'].' '.$row['buyerlname'];
						  			$date = $row['offer_date'];
						  			$time = $row['offer_time']; 
						  			$timeFormat = date('g:i A', strtotime($time));
			  						$dateFormat = date('d M Y', strtotime($date));
			  						$datetime = $dateFormat.' '.$timeFormat;
			  						$price = $row['offerPrice'];
			  						$phonenum = $row['buyerphone'];
			  						$ratestatus = $row['rate_status'];


			  						echo '<tr>
						  		<th scope="row">

									 <img src="listing/'.$bookpic.'" class="mx-auto d-block listing-sizing">

								</th>


								 <td>'.$booktitle.'</td>
								 <td><img src = "profile/'.$buyerpic.'" class="mx-auto d-block pic-sizing"></td>
								 <td>'.$buyername.'</td>
								 <td><strong>RM'.$price.'</strong></td>
								 <td>'.$datetime.'</td>
								 <td><a href="#" class="btn btn-success rounded-circle"><i class="bi bi-whatsapp"></i></a></td>';

									      
							echo '</tr>';


						  		}
						  	?>

						  	

						  	<!--<tr>
						  		<th scope="row">

									 <img src="somepics/python.jpg" class="mx-auto d-block pic-sizing">

								</th>


								 <td>1</td>
								 <td class="text-truncate">The Python Book</td>
								 <td>Amazon Web (2)</td>
								 <td>For Rent</td>
								 <td>HC00 Software Engineering</td>
								 <td>KT34403</td>

									      
							</tr> -->


						  </tbody>
						</table>


						
					</div>






						
						
					</div>


				</div>


				<?php 

					if(isset($_GET['tab2active'])){

						echo '<div class="tab-pane fade show active" id="bought" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">';

					} else {

						echo '<div class="tab-pane fade" id="bought" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">';
					}

				?>
  				<!--<div class="tab-pane fade" id="bought" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">-->

  					<div class="container-fluid tab-body-setting">
  						<h1 class="display-6 px-2 py-2">Books I Bought</h1>

  						<p><button class="btn btn-outline-light text-dark border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
				    	<i class="bi bi-funnel"></i>Filter Sold Books
				  		</button></p>

				  		<div class="collapse" id="collapseExample">
							<div class="card card-body bg-grey border-0">
							    <input class="form-control" id = "filterBought" type="text" placeholder="Type in transaction details..">
							 </div>
						</div>

						<div class="table-responsive mt-3">


						<table class="table table-striped align-middle text-center">
						  <thead>
						    <tr class="table-light">

						      <th scope="col">Book Pic</th>
						      <th scope="col">Book Title</th>
						      <th scope="col">Seller Pic</th>
						      <th scope="col">Seller Name</th>
						      <th scope="col">Bought For</th>
						      <th scope="col">Date/Time</th>
						      <th scope="col">Contact</th>
						      <th scope="col">Rate</th>
						      
						    </tr>
						  </thead>
						  <tbody id="boughtTable">

						  	<?php 
						  		$soldbooks = getMyTransactions($connect, $userID, 1);

						  		foreach ($soldbooks as $row) {
						  			$tscid = $row['tsc_id'];
						  			$bookpic = $row['bookImg'];
						  			$booktitle = $row['bookTitle'];
						  			$buyerpic = $row['sellerImg'];
						  			$buyername = $row['sellerfname'].' '.$row['sellerlname'];
						  			$date = $row['offer_date'];
						  			$time = $row['offer_time']; 
						  			$timeFormat = date('g:i A', strtotime($time));
			  						$dateFormat = date('d M Y', strtotime($date));
			  						$datetime = $dateFormat.' '.$timeFormat;
			  						$price = $row['offerPrice'];
			  						$phonenum = $row['sellerphone'];
			  						$ratestatus = $row['rate_status'];
			  						$isbn = $row['bookISBN'];
			  						$sellerID = $row['sellerID'];


			  						echo '<tr>
						  		<th scope="row">

									 <img src="listing/'.$bookpic.'" class="mx-auto d-block listing-sizing">

								</th>


								 <td>'.$booktitle.'</td>
								 <td><img src = "profile/'.$buyerpic.'" class="mx-auto d-block pic-sizing"></td>
								 <td>'.$buyername.'</td>
								 <td><strong>RM'.$price.'</strong></td>
								 <td>'.$datetime.'</td>
								 <td><a href="#" class="btn btn-success rounded-circle"><i class="bi bi-whatsapp"></i></a></td>';

								 if($ratestatus == 0){

								 	echo '<td><a href="rate.php?transactionid='.$tscid.'" class="btn btn-info text-white"><i class="fa-solid fa-star icon-mr text-warning"></i>Rate</a></td>';

								 } else {

								 	echo '<td><strong><span class="text-info">Rated</span></strong></a>';
								 }

									      
							echo '</tr>';


						  		}
						  	?>

						  	

						  	<!--<tr>
						  		<th scope="row">

									 <img src="somepics/python.jpg" class="mx-auto d-block pic-sizing">

								</th>


								 <td>1</td>
								 <td class="text-truncate">The Python Book</td>
								 <td>Amazon Web (2)</td>
								 <td>For Rent</td>
								 <td>HC00 Software Engineering</td>
								 <td>KT34403</td>

									      
							</tr> -->


						  </tbody>
						</table>


						
					</div>

  						







  						
  					</div>


  				</div>

				
			</div>

			
			


















		</div>
		
	</main>



<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>