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



	<title>View Users</title>

	<script>
	$(document).ready(function(){
	  $("#filterUsers").on("keyup", function() {
	    var value = $(this).val().toLowerCase();
	 
	      $("#usersTable tr").filter(function() {
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
					<h1 class="display-6 w-100">Registered Users (<?php echo getUserCount($connect);?>)</h1>
					<button class="btn btn-outline-info text-dark border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
				    <i class="bi bi-funnel"></i>Filter Users
				  </button></p>


				<div class="collapse" id="collapseExample">
					<div class="card card-body bg-grey border-0">
					    <input class="form-control" id = "filterUsers" type="text" placeholder="User details..">
					 </div>
				</div>

					<div class="table-responsive mt-3">


						<table class="table table-striped align-middle text-center">
						  <thead>
						    <tr class="table-primary">
						      <th scope="col">Pic</th>
						      <th scope="col">User ID</th>
						      <th scope="col">Course</th>
						      <th scope="col">Name</th>
						      <th scope="col">E-Mail</th>
						      <th scope="col">Phone No.</th>
						      <th scope="col">Date Joined</th>
						    </tr>
						  </thead>
						  <tbody id="usersTable">

						  	<?php 
						  		$users = getAllUsers($connect);
						  		foreach ($users as $row) {
						  			$userID = $row['user_id'];
						  			$courseID = $row['course_id'];
						  			$firstname = $row['user_fname'];
						  			$lastname = $row['user_lname'];
						  			$email = $row['user_email'];
						  			$phone = $row['phone_num'];
						  			$date = $row['register_date'];
						  			$dateFormat = date('d M Y', strtotime($date));
						  			$profilepic = $row['user_picpath'];
						  			$courseDetails = getCourseDetails($connect, $courseID);
						  			foreach ($courseDetails as $row) {
						  				$coursecode = $row['course_code'];
						  				$coursename = $row['course_name'];
						  			}

						  			//$profilepic = getProfilePic($connect, $userID);

						  			echo '<tr>
									      <th scope="row">

									     	 <img src="profile/'.$profilepic.'" class="mx-auto d-block pic-sizing">

									  	  </th>


									      <td>'.$userID.'</td>
									      <td>'.$coursecode.' '.$coursename.'</td>
									      <td>'.$firstname.' '.$lastname.'</td>
									      <td>'.$email.'</td>
									      <td>'.$phone.'</td>
									      <td>'.$dateFormat.'</td>
									      
									    </tr>';


						  		}

						  	?>


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