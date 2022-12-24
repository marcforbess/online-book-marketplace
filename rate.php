<?php 
	date_default_timezone_set("Asia/Kuching");

	include_once 'include/connectdb.php';
	include_once 'sql_functions.php';
	session_start();

	$userID = $_SESSION['userID'];
	$tsc_id = htmlspecialchars($_GET['transactionid']);
	$info = getInfoFromTscID($connect, $tsc_id);

	foreach ($info as $row) {
		
		$sellerID = $row['sellerID'];
		$sellerpic = $row['sellerImg'];
		$sellerfname = $row['sellerfname'];
		$sellername = $row['sellerfname'].' '.$row['sellerlname'];
		$bookpic = $row['bookImg'];
		$booktitle = $row['bookTitle'];
		$bookisbn = $row['bookISBN'];
		$datetime = $row['tsc_datetime'];
		$dtFormat = date('d M Y g:i A',strtotime($datetime));

	}



		if(isset($_POST['submit-rating'])){

			$datetime = date('Y-m-d H:i:s');
			$date = date('Y-m-d');
			$time = date('H:i:s');

			$rbValue = htmlspecialchars($_POST['rb-value']);
			$rbReview = htmlspecialchars($_POST['rb-review']);
			$ruValue = htmlspecialchars($_POST['ru-value']);
			$ruReview = htmlspecialchars($_POST['ru-review']);



			//change rate status of tsc id to 1
			//insert into rate book
			//insert into rate user
			updateRateStatus($connect, $tsc_id);
			insertRating($connect, $bookisbn, $userID, $rbValue, $rbReview, $datetime, 0);
			insertRating($connect, $sellerID, $userID, $ruValue, $ruReview, $datetime, 1);
			$message = "You received a rating from ".$_SESSION['userfname'];
			insertNoti($connect, $sellerID, $date, $time, $message, 1);

			header("Location:transactions.php?tab2active=true");



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
	<link rel="stylesheet" type="text/css" href="css/searchresult.css">
	<link rel="stylesheet" type="text/css" href="css/rate.css">
	<link rel="icon" href="somepics/book-pack.svg">


	<!--BOOTSTRAP CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<title>Rate</title>

	<script src="https://kit.fontawesome.com/98355d8df9.js" crossorigin="anonymous"></script>


	
</head>
<body>

	<header>
		<?php 
			include("real_navbar.php");
		?>
		
	</header>

	<main>

		<div class="container-fluid">

			<div class="container-fluid bg-grey mt-3 border-rad container-setting">
				<h1 class="display-6 px-3 py-2">Rate Book & Seller</h1>

			<div class="container">
				<form method="POST">
				<div class="row">

					<div class="col-md">
						
						<div class="container-fluid bg-light border-rad container-setting py-3 text-center">
							<?php
								echo '<img src="listing/'.$bookpic.'" class="mx-auto d-block listing-sizing">

							<h1 class="display-6 py-2">'.$booktitle.'</h1>
							<p class="text-muted">Purchased on '.$dtFormat.'</p>';

							?>

							<div class="container">
								<!--<p>Rating: <span id="rb-value">2.50</span></p>-->
								
								<p>Rating Value: <strong><span id="rb-value"></span></strong></p>
								<input type="range" class="form-range w-50 mx-auto d-block" min="0" max="5" step="0.1" id="bookRange" name="rb-value">
								<!--class="form-range w-50 mx-auto d-block"-->

								<div class="form-floating mt-5">
								  <textarea class="form-control border-0 text-area-size" placeholder="Leave a comment here" id="floatingTextarea2" name="rb-review" required></textarea>
								  <label for="floatingTextarea2" class="text-muted">Write a review about this book</label>
								</div>


								<!--<label for="customRange3" class="form-label">Example range</label>-->

								
								
							</div>
							
							
						</div>
						
					</div>

					<div class="col-md">
						
						<div class="container-fluid bg-light border-rad">
							<div class="container-fluid bg-light border-rad container-setting py-3 text-center">

							<?php 
							echo '<img src="profile/'.$sellerpic.'" class="mx-auto d-block pic-sizing">

								<h1 class="display-6 py-2">'.$sellername.'</h1>
								<p class="text-muted"><br></p>';

							?>

							<div class="container">
								<!--<p>Rating: <span id="rb-value">2.50</span></p>-->
								
								<p>Rating Value: <strong><span id="ru-value"></span></strong></p>
								<input type="range" class="form-range w-50 mx-auto d-block" min="0" max="5" step="0.1" id="userRange" name="ru-value">
								<!--class="form-range w-50 mx-auto d-block"-->

								<div class="form-floating mt-5">
								  <textarea class="form-control border-0 text-area-size" placeholder="Leave a comment here" id="floatingTextarea2" name="ru-review" required></textarea>
								  <label for="floatingTextarea2" class="text-muted">Write a review about <?php echo $sellerfname;?></label>
								</div>


								<!--<label for="customRange3" class="form-label">Example range</label>-->

								
								
							</div>
							
							
						</div>
							
						</div>
						
					</div>


					
				</div>

				<div class="container-fluid mt-3 text-center">
					<button class="btn btn-submit w-100" type="submit" name="submit-rating">Submit Rating</button>	
				</div>
				

			</form>
			</div>

				
			</div>
			
		</div>
		

	</main>



<!-- CUSTOM JAVASCRIPT -->
<script type="text/javascript" src="js/javascript.js"></script>

<script type="text/javascript">
		var bookrange = document.getElementById('bookRange');
		var rbvalue = document.getElementById('rb-value');
		rbvalue.innerHTML = bookrange.value;

		bookrange.oninput = function() {
		  rbvalue.innerHTML = this.value;
		}


		var userrange = document.getElementById('userRange');
		var ruvalue = document.getElementById('ru-value');
		ruvalue.innerHTML = userrange.value;

		userrange.oninput = function() {
		  ruvalue.innerHTML = this.value;
		}
	</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>