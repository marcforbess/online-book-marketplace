<?php 
	include_once 'include/connectdb.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap2.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<title>Test Bootstrap</title>
</head>

<body>


<!-- NAVBAR -->
<nav class="navbar navbar-dark navbar-custom">
  <div class="container-fluid" id="aights"> 
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class = "navbar-brand" href="#"><img src="somepics/book-pack.svg" alt="Logo" width="100" height="60" class="align-text-bottom"></a>
    <!--<p class="navbar-brand">TEST LOGO PLACEMENT</p> -->
   <!-- <button type="button" class="btn btn-danger login-btn">Log in</button> -->

  </div>
</nav>

<!--MENU-->
<div class="offcanvas offcanvas-start hide" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
  <div class="offcanvas-header" style="color:white">
   <h2 class="offcanvas-title" id="offcanvasLabel"></h2>
    <button type="button" style="color:white" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div> 
  <div class="offcanvas-body">

	<div class="list-group menu">
	  <a href="#" class="list-group-item list-group-item-action border-0"><i class="bi bi-house-door-fill"></i>Home</a>
	  <a href="#" class="list-group-item list-group-item-action border-0"><i class="bi bi-person-fill"></i>History Profile</a>
	  <a href="#" class="list-group-item list-group-item-action border-0"><i class="bi bi-journal-plus"></i>Book Profiling</a>
	  <a href="#" class="list-group-item list-group-item-action border-0"><i class="bi bi-star-fill"></i>Rate</a>
	  <a href="#" class="list-group-item list-group-item-action border-0"><i class="bi bi-bookmark-heart-fill"></i>My Wishlist</a>

	</div>


  </div>
</div>



<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>