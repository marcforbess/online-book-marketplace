<?php 
	
	$listingID = $fetchedListing['listing_id'];
	$imagePath = $fetchedListing['book_imgpath'];
	$bookTitle = $fetchedListing['book_title'];
	$listingDate = date('d M Y',strtotime($fetchedListing['listing_date']));
	$bookCategoryInt = $fetchedListing['book_category'];
	$bookCategory = getCategoryName($connect, $bookCategoryInt);
									
	$bookPrice = $fetchedListing['book_price'];
	$bookCourseInt = $fetchedListing['book_course'];
	$bookApprovalStatus = $fetchedListing['book_approved'];

?>