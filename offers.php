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
	<link rel="stylesheet" type="text/css" href="css/searchresult.css">
	<link rel="stylesheet" type="text/css" href="css/offerpage.css">
	<link rel="icon" href="somepics/book-pack.svg">


	<!--BOOTSTRAP CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<title>Manage Offers</title>

	<!-- AJAX -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

	<script type="text/javascript">


	function loadOffers(id, targetfile){

    setInterval(function(){

      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById(id).innerHTML = this.responseText;

        }

      };
      console.log("Success retireving offers");
      xhttp.open("GET", targetfile, true);
      xhttp.send();


    },200);

}
  //loadPendingCount("pending-count", "getPending.php");
	
	loadOffers("incoming-offers", "getInOffers.php");
	loadOffers("outgoing-offers", "getOutOffers.php");

  




	</script>




</head>
<body>

	<header>
		<?php 
			include("real_navbar.php");
		?>
	</header>


	<main>
		
		<!--<div class="container-fluid">

			<div class="row mt-3 row-setting">

				<div class="col-xl offer-col-setting add-outline">
					<h1>Hello World</h1>

				</div>

				<div class="col-xl offer-col-setting add-outline">
					<h1>Hello World Two The Sequel</h1>
				</div>
				
			</div>
			
		</div> -->

		<div class="container-fluid">



			<ul class="nav nav-pills nav-justified mb-3 mt-3" id="pills-tab" role="tablist">
			  <li class="nav-item" role="presentation">

			  	<?php 
			  		if(isset($_GET['tab2active'])){

			  			echo '<button class="nav-link tab-setting" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="bi bi-arrow-left-square icon-ml"></i>OFFERS FOR ME</button>';

			  		} else {

			  			echo '<button class="nav-link active tab-setting" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="bi bi-arrow-left-square icon-ml"></i>OFFERS FOR ME</button>';

			  		}
			  	?>
			   <!-- <button class="nav-link active tab-setting" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="bi bi-arrow-left-square icon-ml"></i>OFFERS FOR ME</button>-->
			  </li>
			  <li class="nav-item" role="presentation">

			  	<?php 

			  		if(isset($_GET['tab2active'])){

			  			echo '<button class="nav-link active tab-setting" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="bi bi-arrow-right-square icon-ml"></i><span class="btn-ml">OFFERS I MADE</span></button>';

			  		} else {

			  			echo '<button class="nav-link tab-setting" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="bi bi-arrow-right-square icon-ml"></i><span class="btn-ml">OFFERS I MADE</span></button>';
			  		}
			  	?>
			    <!--<button class="nav-link tab-setting" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="bi bi-arrow-right-square icon-ml"></i><span class="btn-ml">OFFERS I MADE</span></button>-->
			  </li>
			  
			</ul>
			<div class="tab-content" id="pills-tabContent">

				<?php 
					if(isset($_GET['tab2active'])){

						echo '<div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">';

					} else {

						echo '<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">';

					}
				?>

			  <!--<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">-->
			  	

			  	<div class="container-fluid tab-body-setting" id="incoming-offers">
			  		
			  		<!--<div class="container-fluid add-outline">
			  			<p>Hello World</p>
			  			
			  		</div> -->
		<!--	  		<div class="card">
					  <div class="card-header bg-light">
					  	<img src="somepics/avatar.png" class="rounded-circle user-pic-sizing">
					    Amazon Web made an offer 
					  </div>

					  <div class="card-body">

					  	<div class="row">

					  		<div class="col-xl-1 add-bg-grey">
					  			<img src="somepics/python.jpg" class="mx-auto d-block img-sizing">
					  		</div>

					  		<div class="col-xl-11">

					  			<h4 class="card-title mt-3">The Python Book</h4>
							    <p class="card-text">PRICE : <span class="text-danger"><strong>RM50</strong></span></p>
							    <a href="#" class="btn btn-accept mb-3 mobile-view-btn"><i class="bi bi-check-circle icon-ml"></i>Accept Offer</a>
							    <a href="#" class="btn btn-reject mb-3 mobile-view-btn"><i class="bi bi-x-circle icon-ml"></i>Reject Offer</a>
							    <a href="#" class="btn btn-chat mb-3 mobile-view-btn"><i class="bi bi-whatsapp icon-ml"></i>WhatsApp Amazon</a>
					  			
					  		</div>
					  		
					  	</div>


					    
					  </div>



					  <div class="card-footer text-muted bg-light">
					    2022-11-10 8:49pm
					  </div>
					</div> -->











								  		
			  	</div>




			  </div>




			  <?php 
					if(isset($_GET['tab2active'])){

						echo '<div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">';

					} else {

						echo '<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">';

					}
				?>

			  <!--<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">-->

			

			  	<div class="container-fluid tab-body-setting" id="outgoing-offers">
			  		

			

			 <!-- 		<div class="card">
					  <div class="card-header bg-light">
					  	<img src="somepics/avatar.png" class="rounded-circle user-pic-sizing">
					    Offer sent to Amazon Web 
					  </div>

					  <div class="card-body">

					  	<div class="row">

					  		<div class="col-xl-1 add-bg-grey">
					  			<img src="somepics/python.jpg" class="mx-auto d-block img-sizing">
					  		</div>

					  		<div class="col-xl-11">

					  			<h4 class="card-title mt-3">The Python Book</h4>
							    <p class="card-text">PRICE : <span class="text-danger"><strong>RM50</strong></span></p>

							    
							    <a href="#" class="btn btn-reject"><i class="bi bi-exclamation-circle icon-ml"></i>Cancel My Offer</a>
					  			
					  		</div>
					  		
					  	</div>


					    
					  </div>

					  

					  <div class="card-footer text-muted bg-light">
					    2022-11-10 8:49pm 
					  </div>
					</div> -->





			  		
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