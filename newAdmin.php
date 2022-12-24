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
	<link rel="stylesheet" type="text/css" href="css/newadmin.css">
	<!--<link rel="stylesheet" type="text/css" href="css/loginstyle.css">
	<link rel="stylesheet" type="text/css" href="css/signupstyle.css">
	<link rel="stylesheet" type="text/css" href="css/homepage.css"> -->
	<link rel="icon" href="somepics/adminicon.png">

	<!--BOOTSTRAP CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">



	<title>Register New Admin</title>

	<!-- AJAX -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

	<script>
		$(document).ready(function(){
		  $("#filterAdmin").on("keyup", function() {
		    var value = $(this).val().toLowerCase();
		 
		      $("#adminTable tr").filter(function() {
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
				    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#new-admin" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="bi bi-person-plus-fill icon-mr"></i>Register Admin</button>
				  </li>
				  <li class="nav-item" role="presentation">
				    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#view-admin" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="bi bi-people-fill icon-mr"></i>View All Admins</button>
				  </li>


				</ul>
			</div>

			<div class="tab-content" id="myTabContent">

				<div class="tab-pane fade show active" id="new-admin" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

					<div class="container-fluid tab-body-setting">
						<h1 class="display-6 px-2 py-2">Register New Admin</h1>

						<div class="row">

							<div class="col-lg">

								<form>

									<div class="row">
									  <div class="col">
									    <input type="text" class="form-control" placeholder="First name" aria-label="First name">
									  </div>
									  <div class="col">
									    <input type="text" class="form-control" placeholder="Last name" aria-label="Last name">
									  </div>
									</div>

									<input class="form-control mt-3" type="text" placeholder="E-Mail Address" aria-label="default input example">
									<input class="form-control mt-3" type="text" placeholder="Phone Number" aria-label="default input example">
									<input class="form-control mt-3" type="password" placeholder="Password" aria-label="default input example">

									<button class="btn btn-regadmin mt-3 w-100" type="submit"><i class="bi bi-person-check-fill icon-mr"></i>Register Admin</button>
									
								</form>
								
							</div>

							<div class="col-lg">

								<img src="somepics/illustration.png" class="illustration-sizing mx-auto d-block" alt="illus">
								
							</div>
							


						</div>
						
					</div>


				</div>


  				<div class="tab-pane fade" id="view-admin" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">

  					<div class="container-fluid tab-body-setting">
  						<h1 class="display-6 px-2 py-2">Administrators (<?php echo getAdminCount($connect); ?>)</h1>

  						<p><button class="btn btn-outline-warning text-dark border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
				    	<i class="bi bi-funnel"></i>Filter Admin
				  		</button></p>

				  		<div class="collapse" id="collapseExample">
							<div class="card card-body bg-grey border-0">
							    <input class="form-control" id = "filterAdmin" type="text" placeholder="Admin details..">
							 </div>
						</div>

						<div class="table-responsive mt-3">


						<table class="table table-striped align-middle text-center">
						  <thead>
						    <tr class="table-warning">

						      <th scope="col">Pic</th>
						      <th scope="col">Admin ID</th>
						      <th scope="col">Type</th>
						      <th scope="col">Name</th>
						      <th scope="col">E-Mail</th>
						      <th scope="col">Date Joined</th>
						      <th scope="col">Registered By (ID)</th>
						      
						    </tr>
						  </thead>
						  <tbody id="adminTable">

						  	<?php 

						  		$alladmin = getAllAdmin($connect);
						  		foreach ($alladmin as $row) {
						  			$pic = $row['profilepic'];
						  			$adminID = $row['admin_id'];
						  			$typeInt = $row['admin_type'];
						  			if($typeInt == 1){
						  				$type = "Super Admin";
						  			} else{
						  				$type = "Admin";
						  			}

						  			$name = $row['admin_fname'].' '.$row['admin_lname'];
						  			$email = $row['admin_email'];
						  			$date = $row['admin_registerdate'];
						  			$dateFormat = date('d M Y', strtotime($date));
						  			$registeredBy = $row['registered_by'];

						  			$registeredByDetails = getAdminDetails($connect, $registeredBy);
						  			foreach ($registeredByDetails as $row) {
						  				$registeredByName = $row['admin_fname'].' '.$row['admin_lname'];
						  			}


						  			echo '<tr>
							  		<th scope="row">

										 <img src="adminprofile/'.$pic.'" class="mx-auto d-block pic-sizing">

									</th>


									 <td>'.$adminID.'</td>
									 <td>'.$type.'</td>
									 <td>'.$name.'</td>
									 <td>'.$email.'</td>
									 <td>'.$dateFormat.'</td>
									 <td>'.$registeredByName.' ('.$registeredBy.')</td>

										      
								</tr>';




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