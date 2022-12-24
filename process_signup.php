<?php 
	include_once 'include/connectdb.php';
	session_start();
	//$registererror = "";

/*	if(isset($_POST['submit'])){

		//Variables got from AJAX function
		$course = $_POST['course'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$phonenum = $_POST['phonenum'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$registerdate = date("Y-m-d");

		$checkexisting_query = "SELECT * FROM users WHERE user_email = '$email' LIMIT 1";
			$checkexisting_result = mysqli_query($connect, $checkexisting_query);

			//Check if user has already registered
			if(mysqli_num_rows($checkexisting_result) == 1){
				//$registererror = "Email has already been registered. Please use another email";
				$script =  "<script> $(document).ready(function(){ $('#signupForm').modal('show'); }); </script>";
				echo '<span style="color:red">Email has already been registered. Please use another email</span>';

			//Register new user
			} else{
				//$registererror = "";
				$insertuser = "INSERT INTO users (course_id, user_id, user_fname, user_lname, user_email, user_password, phone_num, register_date) VALUES ('$course', null, '$firstname', '$lastname', '$email', '$password', '$phonenum', '$registerdate')";
					mysqli_query($connect, $insertuser);

				//Get user id to insert into profile picture table in database
				$getuserid = "SELECT * FROM users WHERE user_email = '$useremail' LIMIT 1";
				$getuserid_result = mysqli_query($connect, $getuserid);
				if(mysqli_num_rows($getuserid_result) == 1){
					$fetchedrow = mysqli_fetch_assoc($getuserid_result);
					$userid = $fetchedrow['user_id'];
					//echo "The user ID is ".$userid;

					//After get user ID, insert the user ID into the profile pic database
					$insertIntoProfilePic = "INSERT INTO profilepic(pic_id, user_id, status) VALUES (null, '$userid', 0)";

					mysqli_query($connect, $insertIntoProfilePic);

				} else{
					echo "Error";
				}


				header("Location:test_index.php?register=success");
				//header("register=sucess");
			}

		} */
	

/*	if(isset($_POST['submit-register'])){
			$course_option_value = $_POST['user-course'];
			$userfname = $_POST['firstname'];
			$userlname = $_POST['lastname'];
			$userphonenum = $_POST['phonenum'];
			$useremail = $_POST['email'];
			$userpassword = $_POST['password'];
			$registerdate = date("Y-m-d");

			//CHeck if user is in database
			$checkexisting_query = "SELECT * FROM users WHERE user_email = '$useremail' LIMIT 1";
			$checkexisting_result = mysqli_query($connect, $checkexisting_query);

			//Check if user has already registered
			if(mysqli_num_rows($checkexisting_result) == 1){
				$registererror = "Email has already been registered. Please use another email";

			//Register new user
			} else{
				$registererror = "";
				$insertuser = "INSERT INTO users (course_id, user_id, user_fname, user_lname, user_email, user_password, phone_num, register_date) VALUES ('$course_option_value', null, '$userfname', '$userlname', '$useremail', '$userpassword', '$userphonenum', '$registerdate')";
					mysqli_query($connect, $insertuser);

				//Get user id to insert into profile picture table in database
				$getuserid = "SELECT * FROM users WHERE user_email = '$useremail' LIMIT 1";
				$getuserid_result = mysqli_query($connect, $getuserid);
				if(mysqli_num_rows($getuserid_result) == 1){
					$fetchedrow = mysqli_fetch_assoc($getuserid_result);
					$userid = $fetchedrow['user_id'];
					//echo "The user ID is ".$userid;

					//After get user ID, insert the user ID into the profile pic database
					$insertIntoProfilePic = "INSERT INTO profilepic(pic_id, user_id, status) VALUES (null, '$userid', 0)";

					mysqli_query($connect, $insertIntoProfilePic);

				} else{
					echo "Error";
				}


				header("Location:test_index.php?register=success");
				//header("register=sucess");
			}

		} */
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<!-- AJAX -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

	<!-- CUSTOM JAVASCRIPT -->
	<script type="text/javascript" src="js/javascript.js"></script>

	<script>
		
	$(document).ready(function() {

  	$("button").click(function(){

    $.get("test.txt", function(data, status) {

          $("#text").html(data);
          alert(status);
    })

  });

});

	</script>


</head>
<body>
	<button type="submit" id="submit">Click Me</button>
	<p id="text"></p>
</body>
</html>