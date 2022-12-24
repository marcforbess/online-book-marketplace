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
	<link rel="stylesheet" type="text/css" href="css/newcourse.css">
	<!--<link rel="stylesheet" type="text/css" href="css/loginstyle.css">
	<link rel="stylesheet" type="text/css" href="css/signupstyle.css">
	<link rel="stylesheet" type="text/css" href="css/homepage.css"> -->
	<link rel="icon" href="somepics/adminicon.png">

	<!--BOOTSTRAP CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">



	<title>Add New Course</title>

	<!-- AJAX -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

	<script>
		$(document).ready(function(){
		  $("#filterCourse").on("keyup", function() {
		    var value = $(this).val().toLowerCase();
		 
		      $("#courseTable tr").filter(function() {
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
				    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#new-course" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="bi bi-clipboard2-plus icon-mr"></i>New Course</button>
				  </li>
				  <li class="nav-item" role="presentation">
				    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#view-course" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="bi bi-card-list icon-mr"></i>All Courses</button>
				  </li>


				</ul>
			</div>

			<div class="tab-content" id="myTabContent">

				<div class="tab-pane fade show active" id="new-course" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

					<div class="container-fluid tab-body-setting">
						<h1 class="display-6 px-2 py-2">Add New Course</h1>
						

						<div class="row">

							<div class="col-lg">

								<form>

									<div class="row">
									  <div class="col">
									  	
									    <input type="text" class="form-control" placeholder="Course Code" aria-label="Course Code">
									  </div>
									  <div class="col">
									    <input type="text" class="form-control" placeholder="Course Name" aria-label="Course Name">
									  </div>
									</div>


									<button class="btn btn-addcourse mt-3 w-100" type="submit"><i class="bi bi-clipboard2-check icon-mr"></i>Add New Course</button>
									
								</form>

								<form action="editCourse.php" method="GET">
									<h1 class="display-6 px-2 py-2 mt-5">Edit Course</h1>


									<div class="form-floating mb-3">
									  <select name="edit-course-select" class="form-select" id="floatingSelect" aria-label="Floating label select example" required>
									  	<option value="" selected>-</option>
									    <?php 
									    	$allcourse = getAllCourse($connect);
									    	foreach ($allcourse as $row) {
									    		echo '<option value="'.$row['course_id'].'">'.$row['course_code'].' '.$row['course_name'].'</option>';
									    
									    	}


									    ?>

									  </select>
									  <label for="floatingSelect">Select Course To Edit</label>
									</div>


									<div class="row">
									  <div class="col">
									  	
									    <input type="text" name="edit-course-code" class="form-control" placeholder="Edit Course Code" aria-label="Course Code">
									  </div>
									  <div class="col">
									    <input type="text" name="edit-course-name" class="form-control" placeholder="Edit Course Name" aria-label="Course Name">
									  </div>
									</div>


									<button class="btn btn-editcourse mt-3 w-100" name="edit-course-btn" type="submit"><i class="bi bi-pencil-square icon-mr"></i>Edit Course</button>

									
								</form>






								
							</div>

							<div class="col-lg">

								<img src="somepics/illustration2.png" class="illustration-sizing mx-auto d-block" alt="illus">
								
							</div>
							


						</div>
						
					</div>


				</div>


  				<div class="tab-pane fade" id="view-course" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">

  					<div class="container-fluid tab-body-setting">
  						<h1 class="display-6 px-2 py-2">All Courses (<?php echo getCourseCount($connect); ?>)</h1>

  						<p><button class="btn btn-outline-info text-dark border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
				    	<i class="bi bi-funnel"></i>Filter Course
				  		</button></p>

				  		<div class="collapse" id="collapseExample">
							<div class="card card-body bg-grey border-0">
							    <input class="form-control" id = "filterCourse" type="text" placeholder="Course details..">
							 </div>
						</div>

						<div class="table-responsive mt-3">


						<table class="table table-striped align-middle text-center">
						  <thead>
						    <tr class="table-success">

						      <th scope="col">Course ID</th>
						      <th scope="col">Course Code</th>
						      <th scope="col">Course Name</th>
						      
						    </tr>
						  </thead>
						  <tbody id="courseTable">

						  	<?php 

						  		$course = getAllCourse($connect);
						  		foreach ($course as $row) {
						  			$courseID = $row['course_id'];
						  			$coursecode = $row['course_code'];
						  			$coursename = $row['course_name'];


						  			echo '<tr>
								  		 <th scope="row">'.$courseID.'</th>
										 <td>'.$coursecode.'</td>
										 <td>'.$coursename.'</td>';
										

									//echo '<td><button class = "btn btn-edit" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-pencil-square icon-mr"></i>Edit</button></td>';


											      
									echo '</tr> ';



								

						  		}



						  	?>

						  	<!--<tr>
						  		 <th scope="row">1</th>
								 <td>HC00</td>
								 <td>Software Engineering</td>

									      
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