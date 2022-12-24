<?php
	include_once 'include/connectdb.php';
	include_once 'sql_functions.php';
	session_start();

	$listingIDenc = htmlspecialchars($_GET['productid']);
	$command = htmlspecialchars(base64_decode(urldecode($_GET['command'])));
	$listingID = htmlspecialchars(base64_decode(urldecode($_GET['productid'])));
	$userID = htmlspecialchars($_SESSION['userID']);
	$wishlistPageActive = htmlspecialchars(base64_decode(urldecode($_GET['wishlist-pg-active'])));
	$wishlistQuery = "";

	if($command == 'add'){


		$wishlistQuery = "INSERT INTO wishlist(user_id, listing_id) VALUES (?,?);";
		$stmt = mysqli_stmt_init($connect);

		if(!mysqli_stmt_prepare($stmt, $wishlistQuery)){

			echo "Error when connecting to db";

		} else {

			mysqli_stmt_bind_param($stmt, "ss", $userID, $listingID);
			mysqli_stmt_execute($stmt);

			header("Location: viewProduct.php?productid=".$listingIDenc);

		}



	} else if($command == 'delete'){

		$wishlistQuery = "DELETE FROM wishlist WHERE user_id = ? AND listing_id = ?;";
		removeWishlist($connect, $wishlistQuery, $userID, $listingID, 1);
		if($wishlistPageActive == 'false'){
				header("Location: viewProduct.php?productid=".$listingIDenc);
			} else if($wishlistPageActive == 'true'){
				header("Location: mywishlist.php");
			}
		/*$stmt = mysqli_stmt_init($connect);

		if(!mysqli_stmt_prepare($stmt, $wishlistQuery)){

			echo "Error when connecting to db";

		} else {

			mysqli_stmt_bind_param($stmt, "ss", $userID, $listingID);
			mysqli_stmt_execute($stmt);

			if($wishlistPageActive == 'false'){
				header("Location: viewProduct.php?productid=".$listingID);
			} else if($wishlistPageActive == 'true'){
				header("Location: mywishlist.php");
			}

			//header("Location: viewProduct.php?productid=".$listingID);

		} */




	} else if($command == 'removeall'){

		$wishlistQuery = "DELETE FROM wishlist WHERE user_id = ?;";
		removeWishlist($connect, $wishlistQuery, $userID, $listingID, 0);
		header("Location: mywishlist.php");
		/*$stmt = mysqli_stmt_init($connect);

		if(!mysqli_stmt_prepare($stmt, $wishlistQuery)){

			echo "Error when connecting to db";

		} else {

			mysqli_stmt_bind_param($stmt, "s", $userID);
			mysqli_stmt_execute($stmt);

			header("Location: mywishlist.php");

		} */



	} else {

		echo "Access denied";
		header("Location: viewProduct.php?productid=".$listingIDenc);
	}

	//header("Location: viewProduct.php?productid=".$listingID);
	

?>