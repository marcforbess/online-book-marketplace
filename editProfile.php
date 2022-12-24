<?php 
	
	include_once 'include/connectdb.php';
	include_once 'sql_functions.php';
	session_start();

	$userID = $_SESSION['userID'];
	$updateStatus = false;

	if (isset($_POST['commandPw'])) {

		
		$oldpw = htmlspecialchars($_POST['oldpw']);
		$newpw = htmlspecialchars($_POST['newpw']);
		$confirm = htmlspecialchars($_POST['confirmpw']);
		$checkOld = checkUserPwd($connect, $userID, $oldpw);

		if($checkOld == 'false'){

			echo '<span style = "color:red;">Incorrect old password</span>';

		} else if($newpw !== $confirm){

			echo '<span style = "color:red;">Confirm Password does not match</span>';


		} else if($checkOld == 'false' && $newpw !== $confirm){

			echo '<span style = "color:red;">Incorrect Old Password and Confirmation</span>';


		} else if($checkOld == 'true' && $newpw == $oldpw){

			echo '<span style = "color:red;">Cannot use the same password</span>';

		} else {

			$hashedPw = password_hash($newpw, PASSWORD_DEFAULT);

			$sql = "UPDATE users SET user_password = ? WHERE user_id = ?;";
			if(updateUserDetails($connect, $sql, $userID, $hashedPw, "", 1) == 'true'){

				echo '<span style = "color:green;">Successfully updated password!</span>';
				$updateStatus = true;				

			}


		}





	} else if (isset($_POST['commandName'])) {

		//echo '<span style = "color:red;">Hello Bro this is working</span>';
		$oldfname = htmlspecialchars($_POST['oldfname']);
		$oldlname = htmlspecialchars($_POST['oldlname']);
		$newfname = htmlspecialchars($_POST['newfname']);
		$newlname = htmlspecialchars($_POST['newlname']);

		$oldcombined = $oldfname.' '.$oldlname;
		$newcombined = $newfname.' '.$newlname;
		
		if($oldcombined === $newcombined){

			echo '<span style = "color:red;">Cannot use the same name</span>';

		} else{

			$sql = "UPDATE users SET user_fname = ?, user_lname = ? WHERE user_id = ?;";
			if(updateUserDetails($connect, $sql, $userID, $newfname, $newlname, 0) == 'true'){

				echo '<span style = "color:green;">Successfully updated name!</span>';
				$_SESSION['userfname'] = $newfname;
				$_SESSION['userlname'] = $newlname;
				$updateStatus = true;				

			}


		}




	} else if (isset($_POST['commandPhone'])) {

		$oldphone = htmlspecialchars($_POST['oldphone']);
		$newphone = htmlspecialchars($_POST['newphone']);

		if ($oldphone === $newphone) {
			
			echo '<span style = "color:red;">Cannot use the same number</span>';

		} else if(checkPhoneNoExist($connect, $newphone) == 'true'){

			echo '<span style = "color:red;">Phone number already registered</span>';

		} else {

			$sql = "UPDATE users SET phone_num = ? WHERE user_id = ?;";
			if(updateUserDetails($connect, $sql, $userID, $newphone, "", 1) == 'true'){

				echo '<span style = "color:green;">Successfully updated phone number!</span>';
				$_SESSION['userphonenum'] = $newphone;
				$updateStatus = true;				

			}
		}
		

	} else if(isset($_POST['commandCourse'])){

		$oldcourse = htmlspecialchars($_POST['oldcourse']);
		$newcourse = htmlspecialchars($_POST['newcourse']);

		if ($oldcourse === $newcourse) {

			echo '<span style = "color:red;">Cannot choose same course</span>';

		} else {

			$sql = "UPDATE users SET course_id = ? WHERE user_id = ?;";
			if(updateUserDetails($connect, $sql, $userID, $newcourse, "", 1) == 'true'){

				echo '<span style = "color:green;">Successfully updated course!</span>';
				$_SESSION['userCourseID'] = $newcourse;
				$updateStatus = true;				

			}


		}

	}


?>

<script type="text/javascript">
	
	var updateStatus = "<?php echo $updateStatus; ?>";
	if(updateStatus == true){

		$(document).ready(function() {
		  window.location.href = "history_profile.php?update=success";
		 });


	}

</script>