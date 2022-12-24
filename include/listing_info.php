<?php 

				$listingID = $fetchedRows['listing_id'];
				$sellerID = $fetchedRows['user_id'];
				$listingDate = date('d M Y', strtotime($fetchedRows['listing_date']));
				$bookCategoryInt = $fetchedRows['book_category'];
				$bookCategory = getCategoryName($connect, $bookCategoryInt);
				
				$bookTitle = $fetchedRows['book_title'];
				$bookCondition = $fetchedRows['book_condition'];
				$bookAuthors = $fetchedRows['book_authors'];
				$bookISBN = $fetchedRows['book_isbn'];
				$bookPrice = $fetchedRows['book_price'];
				$bookCourseInt = $fetchedRows['book_course'];
				$bookSubjectCode = $fetchedRows['book_subjectcode'];
				$bookDescription = $fetchedRows['book_description'];
				$bookImgPath = $fetchedRows['book_imgpath'];
				//array_push($imgarray, $bookImgPath);
				$bookCourseCode = "";
				$bookCourseName = ""; 


?>