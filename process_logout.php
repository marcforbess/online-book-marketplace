<?php 

session_start();
if(isset($_SESSION["userID"])){
	unset($_SESSION["userID"]);
	//unset($_SESSION["adminID"]);
	unset($_SESSION["userCourseID"]);
	unset($_SESSION["userfname"]);
	unset($_SESSION["userlname"]);
	unset($_SESSION["useremail"]);
	unset($_SESSION["userphonenum"]);
	unset($_SESSION['datejoined']);
	unset($_SESSION['userpicpath']);


} else if (isset($_SESSION["adminID"])){

	unset($_SESSION["adminID"]);
	unset($_SESSION["adminType"]);
	unset($_SESSION["adminfname"]);
	unset($_SESSION["adminlname"]);
	unset($_SESSION["adminemail"]);
	unset($_SESSION['admin_datejoined']);
	unset($_SESSION['adminpicpath']);


}

header("Location:index.php?Logout=sucess");

?>