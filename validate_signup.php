<?php 
		

	include_once 'include/connectdb.php';
	session_start();
	//$registererror = "";
	$signupstatus = "";

	if(isset($_POST['submit'])){

		//Variables got from AJAX function
		$course = $_POST['course'];
		$firstname = htmlspecialchars($_POST['firstname']);
		$lastname = htmlspecialchars($_POST['lastname']);
		$phonenum = htmlspecialchars($_POST['phonenum']);
		$email = htmlspecialchars($_POST['email']);
		$password = htmlspecialchars($_POST['password']);
		$passwordHashed = password_hash($password, PASSWORD_DEFAULT);
		$registerdate = date("Y-m-d");
		$autoinc = "";

		$checkexisting_query = "SELECT user_email, phone_num FROM users WHERE user_email = ? OR phone_num = ? LIMIT 1";
			//$checkexisting_result = mysqli_query($connect, $checkexisting_query);
			$stmt = mysqli_stmt_init($connect);

			if(!mysqli_stmt_prepare($stmt, $checkexisting_query)){

				echo "Error connecting to db";

			} else {


				mysqli_stmt_bind_param($stmt, "ss", $email, $phonenum);
				mysqli_stmt_execute($stmt);
				$checkexisting_result = mysqli_stmt_get_result($stmt);


					//Check if user has already registered
					if(mysqli_num_rows($checkexisting_result) == 1){
						$signupstatus = false;
						//$registererror = "Email has already been registered. Please use another email";
						//$script =  "<script> $(document).ready(function(){ $('#signupForm').modal('show'); }); </script>";
						$checkEmailPhoneNum = mysqli_fetch_assoc($checkexisting_result);
						if($email == $checkEmailPhoneNum['user_email']){
							echo '<span style="color:red; margin-left:8px">Email has already been registered. Please use another email</span>';

						} else if($phonenum == $checkEmailPhoneNum['phone_num']){

							echo '<span style="color:red; margin-left:8px">Phone number is already registered. Please use another number</span>';

						}
						//echo '<span style="color:red; margin-left:8px">Email has already been registered. Please use another email</span>';

					//Register new user
					} else{
						$signupstatus = true;
						//$registererror = "";
						$picstatus = 0;
						$picpath = 'avatar.png';



						$insertuser = "INSERT INTO users (course_id, user_id, user_fname, user_lname, user_email, user_password, phone_num, register_date, pic_status, user_picpath) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
							//mysqli_query($connect, $insertuser);

							$stmt = mysqli_stmt_init($connect);

							if(!mysqli_stmt_prepare($stmt, $insertuser)){

								echo "Error connecting to db";

							} else {

								mysqli_stmt_bind_param($stmt, "ssssssssss", $course, $autoinc, $firstname, $lastname, $email, $passwordHashed, $phonenum, $registerdate, $picstatus, $picpath);
								mysqli_stmt_execute($stmt);


								//Get user id to insert into profile picture table in database
								$getuserid = "SELECT * FROM users WHERE user_email = ? LIMIT 1";
								//$getuserid_result = mysqli_query($connect, $getuserid);

								$stmt = mysqli_stmt_init($connect);

								if(!mysqli_stmt_prepare($stmt, $getuserid)){

									echo "Error connecting to db";

								} else{

									mysqli_stmt_bind_param($stmt, "s", $email);
									mysqli_stmt_execute($stmt);
									$getuserid_result = mysqli_stmt_get_result($stmt);


									if(mysqli_num_rows($getuserid_result) == 1){
									$fetchedrow = mysqli_fetch_assoc($getuserid_result);
									$userid = $fetchedrow['user_id'];
									$defaultpic = "avatar.png";
									//echo "The user ID is ".$userid;

									//After get user ID, insert the user ID into the profile pic database
									$insertIntoProfilePic = "INSERT INTO profilepic(pic_id, user_id, status, pic_path) VALUES (null, '$userid', 0, '$defaultpic')";

									mysqli_query($connect, $insertIntoProfilePic);

									} else{
										echo "Error";
									}


								}





							}




						//header("Location:test_index.php?register=success");
						//header("Refresh:0");

						/*echo '<script type="text/javascript">location.replace(http://localhost/test_bootstrap/test_index.php);</script>'; */
						//header("Refresh:0; url=test_index.php");
						//header("register=sucess");
					}

					//header("Location:test_index.php?register=success");

				} 




			}

			



	/*	if(isset($_POST['submit'])){

		//Variables got from AJAX function
		$course = $_POST['course'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$phonenum = $_POST['phonenum'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$registerdate = date("Y-m-d");

		$checkexisting_query = "SELECT user_email, phone_num FROM users WHERE user_email = '$email' OR phone_num = '$phonenum' LIMIT 1";
			$checkexisting_result = mysqli_query($connect, $checkexisting_query);

			//Check if user has already registered
			if(mysqli_num_rows($checkexisting_result) == 1){
				$signupstatus = false;
				//$registererror = "Email has already been registered. Please use another email";
				//$script =  "<script> $(document).ready(function(){ $('#signupForm').modal('show'); }); </script>";
				$checkEmailPhoneNum = mysqli_fetch_assoc($checkexisting_result);
				if($email == $checkEmailPhoneNum['user_email']){
					echo '<span style="color:red; margin-left:8px">Email has already been registered. Please use another email</span>';

				} else if($phonenum == $checkEmailPhoneNum['phone_num']){

					echo '<span style="color:red; margin-left:8px">Phone number is already registered. Please use another number</span>';

				}
				//echo '<span style="color:red; margin-left:8px">Email has already been registered. Please use another email</span>';

			//Register new user
			} else{
				$signupstatus = true;
				//$registererror = "";
				$insertuser = "INSERT INTO users (course_id, user_id, user_fname, user_lname, user_email, user_password, phone_num, register_date) VALUES ('$course', null, '$firstname', '$lastname', '$email', '$password', '$phonenum', '$registerdate')";
					mysqli_query($connect, $insertuser);

				//Get user id to insert into profile picture table in database
				$getuserid = "SELECT * FROM users WHERE user_email = '$email' LIMIT 1";
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


				//header("Location:test_index.php?register=success");
				//header("Refresh:0");

				/*echo '<script type="text/javascript">location.replace(http://localhost/test_bootstrap/test_index.php);</script>'; */
				//header("Refresh:0; url=test_index.php");
				//header("register=sucess");
			//}

			//header("Location:test_index.php?register=success");

	//	} 




?>

<script>
	
	var signupstatus = "<?php echo $signupstatus ?>";
	if(signupstatus==true){
		$(document).ready(function() {	
		  window.location.href = "index.php";
		 });
	}

</script>