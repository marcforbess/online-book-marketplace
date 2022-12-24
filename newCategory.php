<?php 
	include_once 'include/connectdb.php';
	include_once 'sql_functions.php';
	session_start();

	$errormsg = "";

	if(isset($_POST['submit-new-cat'])){

		$newCategory = htmlspecialchars($_POST['new-category']);
		$exist = checkCategoryExist($connect, $newCategory);
		if($exist == "true"){

			$errormsg = '<p class="text-danger px-2">Category already exists</p>';


		} else {

			addCategory($connect, $newCategory);
			$date = date('Y-m-d');
			$time = date('H:i:s');
			$message = "You added a new category : ".$newCategory;
			insertAdminActivity($connect, $_SESSION['adminID'], $message, $date, $time);
			$errormsg = '<p class="text-success px-2">Successfully Added New Category</p>';


		}


		//check if category already exists
		//if not, insert
		//update admin activity

	}


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
	<link rel="stylesheet" type="text/css" href="css/newcategory.css">
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
		  $("#filterCategory").on("keyup", function() {
		    var value = $(this).val().toLowerCase();
		 
		      $("#categoryTable tr").filter(function() {
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
				    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#new-course" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="bi bi-list-columns-reverse icon-mr"></i>New Category</button>
				  </li>
				  <li class="nav-item" role="presentation">
				    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#view-course" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="bi bi-card-list icon-mr"></i>All Categories</button>
				  </li>


				</ul>
			</div>

			<div class="tab-content" id="myTabContent">

				<div class="tab-pane fade show active" id="new-course" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

					<div class="container-fluid tab-body-setting">
						<h1 class="display-6 px-2 py-2">Add New Category</h1>
						<?php echo $errormsg;?>

						

						<div class="row">

							<div class="col-lg">

								<form method="POST">

									<div class="row">
									  <div class="col">
									  	
									    <input type="text" name="new-category" class="form-control" placeholder="Category Name" aria-label="Category Name" required>
									  </div>
									  
									</div>


									<button class="btn btn-addcourse mt-3 w-100" type="submit" name="submit-new-cat"><i class="bi bi-ui-checks icon-mr"></i>Add New Category</button>

									
								</form>

								<form action="editCourse.php" method="GET">
									<h1 class="display-6 px-2 py-2 mt-5">Edit Category</h1>


									<div class="form-floating mb-3">
									  <select name="edit-course-select" class="form-select" id="floatingSelect" aria-label="Floating label select example" required>
									  	<option value="" selected>-</option>
									    <?php 
									    	$allcat = getCategory($connect);
									    	foreach ($allcat as $row) {
									    		echo '<option value="'.$row['cat_id'].'">'.$row['cat_name'].'</option>';
									    
									    	}


									    ?>

									  </select>
									  <label for="floatingSelect">Select Category To Edit</label>
									</div>


									<div class="row">
									  <div class="col">
									  	
									    <input type="text" name="edit-category" class="form-control" placeholder="Edit Category Name" aria-label="Course Code" required>
									  </div>
									  
									</div>


									<button class="btn btn-editcourse mt-3 w-100" name="edit-course-btn" type="submit"><i class="bi bi-pencil-square icon-mr"></i>Edit Course</button>

									
								</form>






								
							</div>

							<div class="col-lg">

								<img src="somepics/illustration3.png" class="illustration-sizing mx-auto d-block" alt="illus">
								
							</div>
							


						</div>
						
					</div>


				</div>


  				<div class="tab-pane fade" id="view-course" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">

  					<div class="container-fluid tab-body-setting">
  						<h1 class="display-6 px-2 py-2">All Categories (<?php echo count(getCategory($connect)) ?>)</h1>

  						<p><button class="btn btn-outline-info text-dark border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
				    	<i class="bi bi-funnel"></i>Filter Category
				  		</button></p>

				  		<div class="collapse" id="collapseExample">
							<div class="card card-body bg-grey border-0">
							    <input class="form-control" id = "filterCategory" type="text" placeholder="Course details..">
							 </div>
						</div>

						<div class="table-responsive mt-3">


						<table class="table table-striped align-middle text-center">
						  <thead>
						    <tr class="table-purple">

						      <th scope="col">Category ID</th>
						      <th scope="col">Course Name</th>
						      
						      
						    </tr>
						  </thead>
						  <tbody id="categoryTable">

						  	<?php 

						  		$course = getCategory($connect);
						  		foreach ($course as $row) {
						  			$catID = $row['cat_id'];
						  			$catname = $row['cat_name'];


						  			echo '<tr>
								  		 <th scope="row">'.$catID.'</th>
										 <td>'.$catname.'</td>';
										

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