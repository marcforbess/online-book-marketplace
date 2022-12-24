<?php 

	include_once 'include/connectdb.php';
	session_start();
	$loginstatus = "";
	$adminloginstatus = "";


			if(isset($_POST['submit'])){
					$useremail = htmlspecialchars($_POST['useremail']);
					$userpassword = htmlspecialchars($_POST['password']);
					$usertype = htmlspecialchars($_POST['usertype']);

					if($usertype == "users"){
						$checkdetails_query = "SELECT * FROM users WHERE user_email = ? LIMIT 1;";
						//$checkdetails_result = mysqli_query($connect, $checkdetails_query);

						$stmt = mysqli_stmt_init($connect);

						if(!mysqli_stmt_prepare($stmt, $checkdetails_query)){

							echo "Error when connecting to db";


						//This else is when the prepared statement connection is successful 
						} else {

							mysqli_stmt_bind_param($stmt, "s", $useremail);
							mysqli_stmt_execute($stmt);
							$checkdetails_result = mysqli_stmt_get_result($stmt);

							//If credentials match
							if(mysqli_num_rows($checkdetails_result) == 1){
							$fetchedrow = mysqli_fetch_assoc($checkdetails_result);
							$hashedPw = $fetchedrow['user_password'];
							$checkedPw = password_verify($userpassword, $hashedPw);
							if($checkedPw/*$userpassword == pass $fetchedrow['user_password']*/){

								
								$_SESSION['userID'] = $fetchedrow['user_id'];
								$_SESSION['userCourseID'] = $fetchedrow['course_id'];
								$_SESSION['userfname'] = $fetchedrow['user_fname'];
								$_SESSION['userlname'] = $fetchedrow['user_lname'];
								$_SESSION['useremail'] = $fetchedrow['user_email'];
								$_SESSION['datejoined'] = date('d M Y', strtotime($fetchedrow['register_date']));
								$_SESSION['userphonenum'] = $fetchedrow['phone_num'];
								$_SESSION['userpicpath'] = $fetchedrow['user_picpath'];
								$loginstatus = true;

								//header("Location:testing3.php");
								//echo '<span style="color:green; margin-left:8px">Login Successful!</span>';

							} else{ //if email match but password wrong
								//$loginerror = "Incorrect password. Please try again.";
								echo '<span style="color:red; margin-left:8px">Incorrect password. Please try again</span>';
								$loginstatus = false;


								} 


							} else{ //If email does not match

									//$loginerror = "Incorrect e-mail or password. Please try again.";
									echo '<span style="color:red; margin-left:8px">Incorrect E-Mail. Please try again</span>';
									$loginstatus = false;


							}  


						}

						

					} else if($usertype == "admin"){

						$checkdetails_query = "SELECT * FROM admin WHERE admin_email = ? LIMIT 1;";
						//$checkdetails_result = mysqli_query($connect, $checkdetails_query);

						$stmt = mysqli_stmt_init($connect);

						if(!mysqli_stmt_prepare($stmt, $checkdetails_query)){

							echo "Error when connecting to db";


						//This else is when the prepared statement connection is successful 
						} else {

							mysqli_stmt_bind_param($stmt, "s", $useremail);
							mysqli_stmt_execute($stmt);
							$checkdetails_result = mysqli_stmt_get_result($stmt);

							//If credentials match
							if(mysqli_num_rows($checkdetails_result) == 1){
							$fetchedrow = mysqli_fetch_assoc($checkdetails_result);
							$hashedPw = $fetchedrow['admin_password'];
							$checkedPw = password_verify($userpassword, $hashedPw);
							if($checkedPw){

								
								$_SESSION['adminID'] = $fetchedrow['admin_id'];
								$_SESSION['adminType'] = $fetchedrow['admin_type'];
								//$_SESSION['userCourseID'] = $fetchedrow['course_id'];
								$_SESSION['adminfname'] = $fetchedrow['admin_fname'];
								$_SESSION['adminlname'] = $fetchedrow['admin_lname'];
								$_SESSION['adminemail'] = $fetchedrow['admin_email'];
								$_SESSION['admin_datejoined'] = $fetchedrow['admin_registerdate'];
								$_SESSION['adminpicpath'] = $fetchedrow['profilepic'];
								//$_SESSION['userphonenum'] = $fetchedrow['phone_num'];
								//$_SESSION['userpicpath'] = "";
								$adminloginstatus = true;

								//header("Location:testing3.php");
								//echo '<span style="color:green; margin-left:8px">Login Successful!</span>';

							} else{ //if email match but password wrong
								//$loginerror = "Incorrect password. Please try again.";
								echo '<span style="color:red; margin-left:8px">Incorrect password. Please try again</span>';
								$adminloginstatus = false;


								} 


							} else{ //If email does not match

									//$loginerror = "Incorrect e-mail or password. Please try again.";
									echo '<span style="color:red; margin-left:8px">Incorrect E-Mail. Please try again</span>';
									$adminloginstatus = false;


							}  


						}

















								
					} 

					
				}











			/*	if(isset($_POST['submit'])){
					$useremail = $_POST['useremail'];
					$userpassword = $_POST['password'];
					$usertype = $_POST['usertype'];

					if($usertype == "users"){
						$checkdetails_query = "SELECT * FROM users WHERE user_email = '$useremail' LIMIT 1";
						$checkdetails_result = mysqli_query($connect, $checkdetails_query);

						//If credentials match
						if(mysqli_num_rows($checkdetails_result) == 1){
						$fetchedrow = mysqli_fetch_assoc($checkdetails_result);
						if($userpassword == $fetchedrow['user_password']){
							$_SESSION['userID'] = $fetchedrow['user_id'];
							$_SESSION['userCourseID'] = $fetchedrow['course_id'];
							$_SESSION['userfname'] = $fetchedrow['user_fname'];
							$_SESSION['userlname'] = $fetchedrow['user_lname'];
							$_SESSION['useremail'] = $fetchedrow['user_email'];
							$_SESSION['datejoined'] = $fetchedrow['register_date'];
							$_SESSION['userphonenum'] = $fetchedrow['phone_num'];
							$loginstatus = true;

							//header("Location:testing3.php");
							//echo '<span style="color:green; margin-left:8px">Login Successful!</span>';

						} else{ //if email match but password wrong
							//$loginerror = "Incorrect password. Please try again.";
							echo '<span style="color:red; margin-left:8px">Incorrect password. Please try again</span>';
							$loginstatus = false;
						}

					} else{ //If email does not match

						//$loginerror = "Incorrect e-mail or password. Please try again.";
						echo '<span style="color:red; margin-left:8px">Incorrect E-Mail. Please try again</span>';
						$loginstatus = false;
					} 
					} else if($usertype == "admin"){
						//Just need to copy the users one and just change according to admin table in db
					}

					
				} */

?>

<script>
	
	var loginstatus = "<?php echo $loginstatus ?>";
	var adminloginstatus = "<?php echo $adminloginstatus ?>";
	if(loginstatus==true){
		$(document).ready(function() {
		  window.location.href = "index.php";
		 });

	} else if(adminloginstatus==true){

		$(document).ready(function() {
		  window.location.href = "admin_index.php";
		 });

	}



</script>