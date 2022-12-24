<?php 
include_once 'include/connectdb.php';
include_once 'sql_functions.php';


session_start();

	
	if(isset($_POST['submitprofilepic']) && isset($_SESSION['userID'])){
		$userid = $_SESSION['userID'];


		$profilepic = $_FILES['uploadprofilepic'];

		//Get neccessary info about uploaded picture
		$profilepicName = $_FILES['uploadprofilepic']['name'];
		$profilepicTmp = $_FILES['uploadprofilepic']['tmp_name'];
		$profilepicSize = $_FILES['uploadprofilepic']['size'];
		$profilepicError = $_FILES['uploadprofilepic']['error'];
		$profilepicType = $_FILES['uploadprofilepic']['type'];

		//Separate the filename from the format e.g. .jpg .png etc.
		//Ext stands for extension (basically the file extension or format)
		$profilepicExt = explode('.', $profilepicName);

		//This will take the file format and make it lowercase e.g. JPG -> jpg
		$profilepicExtLowercase = strtolower(end($profilepicExt)); 

		//Allowed format that is eligible for upload
		$allowedFormat = array('jpg', 'jpeg','png');

		//Check if the uploaded image extension is in the allowed array
		if(in_array($profilepicExtLowercase, $allowedFormat)){

			if($profilepicError == 0){

				if($profilepicSize < 2000000){

					//$newpicname = uniqid('', true).".".$profilepicExtLowercase;
					$newpicname = "profile".$userid.".".$profilepicExtLowercase;
					$picdestination = 'profile/'.$newpicname;

					$userdetails = getDetailsFromID($connect, $userid);
					foreach ($userdetails as $row) {
						
						$picstatus = $row['pic_status'];
						$userpicpath = $row['user_picpath'];

					}

					if($picstatus == 1){

						$pic_delete = "profile/".$userpicpath;

		                 	if(!unlink($pic_delete)){
		                 		echo "Error unable to delete file";
		                 	}

					}


					move_uploaded_file($profilepicTmp, $picdestination);
					$changepicstatus = "UPDATE users SET pic_status=1, user_picpath = '$newpicname' WHERE user_id = '$userid'";
					mysqli_query($connect, $changepicstatus);
					$_SESSION['userpicpath'] = $newpicname;
					//echo "Yo my guy";
					//echo '<meta http-equiv="refresh" content="5;URL=\'history_profile.php\'">';
					header("Location: history_profile.php?success");

				} else{

					echo "File size too large";
				}

			} else{
				echo "An error has occurred";
			}

		} else{
			echo "Only jpg image formats are allowed";
		}
	


} else if(isset($_POST['submitprofilepic']) && isset($_SESSION['adminID'])){


	$adminid = $_SESSION['adminID'];


		$profilepic = $_FILES['uploadprofilepic'];

		//Get neccessary info about uploaded picture
		$profilepicName = $_FILES['uploadprofilepic']['name'];
		$profilepicTmp = $_FILES['uploadprofilepic']['tmp_name'];
		$profilepicSize = $_FILES['uploadprofilepic']['size'];
		$profilepicError = $_FILES['uploadprofilepic']['error'];
		$profilepicType = $_FILES['uploadprofilepic']['type']; 

		//Separate the filename from the format e.g. .jpg .png etc.
		//Ext stands for extension (basically the file extension or format)
		$profilepicExt = explode('.', $profilepicName);

		//This will take the file format and make it lowercase e.g. JPG -> jpg
		$profilepicExtLowercase = strtolower(end($profilepicExt)); 

		//Allowed format that is eligible for upload
		$allowedFormat = array('jpg', 'jpeg','png');

		//Check if the uploaded image extension is in the allowed array
		if(in_array($profilepicExtLowercase, $allowedFormat)){

			if($profilepicError == 0){

				if($profilepicSize < 2000000){

					//$newpicname = uniqid('', true).".".$profilepicExtLowercase;
					$newpicname = "profile".$adminid.".".$profilepicExtLowercase;
					$picdestination = 'adminprofile/'.$newpicname;


					//If user has no profile picture, then set to default profile picture
		              $checkprofilepicstatus = "SELECT * FROM admin WHERE admin_id = '$adminid' LIMIT 1";
		              $checkprofilepicstatusresult = mysqli_query($connect, $checkprofilepicstatus);


		              if(mysqli_num_rows($checkprofilepicstatusresult) == 1){
		                $fetchedStatus = mysqli_fetch_assoc($checkprofilepicstatusresult);
		                $picpath = $fetchedStatus['profilepic'];

		                //If user hasnt set profile pic
		                if($fetchedStatus['profilepicstatus'] == 1){

		                	//$pic_path = $_SESSION['userpicpath'];
		                 	$pic_delete = "adminprofile/".$picpath;

		                 	if(!unlink($pic_delete)){
		                 		echo "Error unable to delete file";
		                 	}


		                } 

					move_uploaded_file($profilepicTmp, $picdestination);
					$changepicstatus = "UPDATE admin SET profilepicstatus=1, profilepic = '$newpicname' WHERE admin_id = '$adminid'";
					mysqli_query($connect, $changepicstatus);
					//echo "Yo my guy";
					//echo '<meta http-equiv="refresh" content="5;URL=\'history_profile.php\'">';
					header("Location: admin_index.php?success");

				} else{

					echo "File size too large";
				}

			} else{
				echo "An error has occurred";
			}

		} else{
			echo "Only jpg image formats are allowed";
		}
	}













}








?>
