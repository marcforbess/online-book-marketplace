<?php 
	
	include_once 'include/connectdb.php';
	include_once 'sql_functions.php';
	session_start();
	$adminID = $_SESSION['adminID'];

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
	<link rel="stylesheet" type="text/css" href="css/admindashboard.css">
	<!--<link rel="stylesheet" type="text/css" href="css/loginstyle.css">
	<link rel="stylesheet" type="text/css" href="css/signupstyle.css">
	<link rel="stylesheet" type="text/css" href="css/homepage.css"> -->
	<link rel="icon" href="somepics/adminicon.png">

	<!--BOOTSTRAP CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<title>Admin Home</title>


	<script type="text/javascript">


	function loadPendingCount(id, targetfile){

    setInterval(function(){

      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById(id).innerHTML = this.responseText;

        }

      };
      console.log("Success retireving stuff");
      xhttp.open("GET", targetfile, true);
      xhttp.send();


    },200);

}
  loadPendingCount("pending-count", "getPending.php");
  loadPendingCount("user-count", "getUserCount.php");
  loadPendingCount("listing-count", "getListingCount.php");




	</script>


</head>
<body>

	<header>
		<?php 
			
			if(isset($_SESSION['adminID'])){

				//header("Location:test_index.php");
				include("real_navbar.php");

			} else {
				header("Location:index.php");
			}
			//include("real_navbar.php");
		?>
	</header>

	<main>
		
		<div class="container-fluid">

			<div class="row mt-3">

				<div class="col-xl-4 mb-3">

					<a href="listingApproval.php" class="text-decoration-none"><div class="card card-mod gradient-blue text-white px-3 py-3 border-0">	
						
						<h3 class="card-title">Pending Listing Approvals</h3>
						<i class="fa-solid fa-list-check icon-setting"></i>		
					    
					    <hr class="divider"></hr>
					    <!--<h2 class="card-text text-sizing py-2 px-3">4</h2>-->
				   		<span class="card-text text-sizing py-2 px-3" id = "pending-count">Loading..</span>   	
					
					</div></a>
			

				</div>

				<div class="col-xl-4 mb-3">

					<a href="viewUsers.php" class="text-decoration-none"><div class="card card-mod gradient-orange text-white px-3 py-3 border-0">	
						
						<h3 class="card-title">Number of Users</h3>
						<i class="fa-solid fa-people-group icon-setting"></i>		
					    
					    <hr class="divider"></hr>
					    <!--<h2 class="card-text text-sizing py-2 px-3">4</h2>-->
				   		<span class="card-text text-sizing py-2 px-3" id="user-count">Loading..</span>   	
					
					</div></a>
					
			

				</div>

				<div class="col-xl-4 mb-3">
					
					<a href="viewListing.php" class="text-decoration-none"><div class="card card-mod gradient-green text-white px-3 py-3 border-0">	
						
						<h3 class="card-title">Number of Listings</h3>
						<i class="fa-solid fa-book icon-setting"></i>		
					    
					    <hr class="divider"></hr>
					    <!--<h2 class="card-text text-sizing py-2 px-3">4</h2>-->
				   		<span class="card-text text-sizing py-2 px-3" id="listing-count">Loading..</span>   	
					
					</div></a>		

			

				</div>

			
				

			</div>

			<div class="row">

				<div class="col-md-4">
					<div class="container-fluid admin-details-container grey-bg pb-4">
						<h1 class="display-6 px-2 py-2">My Details</h1>

				<?php
						$adminDetails = getAdminDetails($connect, $adminID);
						foreach ($adminDetails as $row) {

							$adminpic = $row['profilepic'];
							$admintypeint = $row['admin_type'];
							$adminfirstname = $row['admin_fname'];
							$adminlastname = $row['admin_lname'];
							$adminemail = $row['admin_email'];
							$datejoined = $row['admin_registerdate'];
							$dateFormat = date('d M Y', strtotime($datejoined));
							
						}

						if($admintypeint==1){

							$admintype = "Super Admin";

						} else {

							$admintype = "Admin";
						}



						echo '<div class="container">
							<div class="container-fluid">
								<img src="adminprofile/'.$adminpic.'" class="rounded-circle mx-auto d-block admin-img-sizing pe-cursor" onclick = "uploadBookPicTrigger()" id="picPlaceholder">

								<form action="changeProfilePic.php" method = "POST" enctype="multipart/form-data">
									<div class="input-group mt-3">
									  <input type="file" name="uploadprofilepic" class="form-control" id="bookImage" onchange = "displayPicture(this)" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
									  <button class="btn btn-outline-success" type="submit" id="submitprofilepic" name="submitprofilepic">Save Changes</button>
									</div>
								</form>

							</div>


							<div class="container-fluid px-3 mt-3 bg-light border-rad py-2">

								<div class="row">
									<div class="col-sm">
										<label><strong>Name</strong></label>
										<p>'.$adminfirstname.' '.$adminlastname.'</p>
									</div>

									<div class="col-sm">
										<label><strong>User Type</strong></label>
										<p>'.$admintype.'</p>
										
									</div>
									
								</div>

								<div class="row">
									<div class="col-sm">
										<label><strong>E-Mail Address</strong></label>
										<p>'.$adminemail.'</p>
										
									</div>

									<div class="col-sm">
										<label><strong>Date Joined</strong></label>
										<p>'.$dateFormat.'</p>
										
									</div>
									
								</div>
								
							</div>
							
						</div>';

					?>

						

					</div>


				</div>

				<div class="col-md-8 mb-3">

					<div class="container-fluid my-activities-container grey-bg">
						<h1 class="display-6 px-2 py-2">My Activities</h1>

						<div class="table-responsive-sm mt-3 mx-5 text-center">
						  <table class="table align-middle table-bordered">
						    <thead>
						    	<tr class="table-danger">
						    		<th scope="col">No</th>
						    		<th scope="col">Activity</th>
						    		<th scope="col">Date/Time</th>
						    	</tr>
						    </thead>

						    <tbody>

						    	<?php 
						    			$count = 1;
						    			$activity = getAdminActivity($connect, $adminID);

						    			foreach ($activity as $row) {
						    				
						    					$date = $row['activity_date'];					    					
						    					$time = $row['activity_time'];
						    					$timeFormat = date('g:i A', strtotime($time));
			  									$dateFormat = date('d M Y', strtotime($date));
						    					$message = $row['activity_message'];


						    					echo '<tr>
												    		<th scope="row">'.$count.'</th>
												    		<td>'.$message.'</td>
												    		<td>'.$dateFormat.' '.$timeFormat.'</td>
												    	</tr>';

												 	$count++;

						    			}
						    	?>
						    	
						    </tbody>

						  </table>
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