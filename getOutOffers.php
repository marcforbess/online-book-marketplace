<?php 

	include_once 'include/connectdb.php';
	include_once 'sql_functions.php';
	session_start();
	$userID = $_SESSION['userID'];

	echo '<h1>Outgoing Offers</h1>';

				$outOfferCount = getOutOfferCount($connect, $userID);
				echo '<span class="text-muted px-2">You have '.$outOfferCount.' outgoing offers</span>';

				if($outOfferCount > 0){

					//echo "You have no outgoing offers";
					$outgoingOffers = getOutgoingOffers($connect, $userID);

					foreach ($outgoingOffers as $row) {

						$outOfferID = $row['offer_id'];
						$listingID = $row['listing_id'];
						$sellerID = $row['offerTo'];
						$offerDate = $row['offer_date'];
			  			$offerTime = $row['offer_time'];
			  			$offerStatus = $row['offerStatus'];
			  			$offerPrice = $row['offer_price'];
			  			$timeFormat = date('g:i A', strtotime($offerTime));
			  			$dateFormat = date('d M Y', strtotime($offerDate));

			  			$sellerDetails = getDetailsFromID($connect, $sellerID);
			  			foreach ($sellerDetails as $row) {
			  				$sellerfirstname = $row['user_fname'];
			  				$sellerlastname = $row['user_lname'];
			  				$sellerPic = $row['user_picpath'];
			  			}

			  			//$sellerPic = getProfilePic($connect, $sellerID);

			  			$getListingDetails = getListingDetails($connect, $listingID);
			  				foreach ($getListingDetails as $row) {
			  					$bookImgPath = $row['book_imgpath'];
			  					$bookTitle = $row['book_title'];
			  					//$bookPrice = $row['book_price'];
			  				}


			  			echo '
			  		<div class="card mb-3">
					  <div class="card-header bg-light">
					  	<img src="profile/'.$sellerPic.'" class="rounded-circle user-pic-sizing">
					    Offer sent to '.$sellerfirstname.' '.$sellerlastname.' 
					  </div>

					  <div class="card-body">

					  	<div class="row">

					  		<div class="col-xl-1 add-bg-grey">
					  			<img src="listing/'.$bookImgPath.'" class="mx-auto d-block img-sizing">
					  		</div>

					  		<div class="col-xl-11">

					  			<h4 class="card-title mt-3">'.$bookTitle.'</h4>
							    <p class="card-text">PRICE OFFERED: <span class="text-danger"><strong>'.$offerPrice.'</strong></span></p>';

							   if($offerStatus == 0){

							   	 echo '<a href="accept_offer.php?booktitle='.$bookTitle.'&command=cancel&offerid='.$outOfferID.'&sellerid='.$sellerID.'" class="btn btn-reject"><i class="bi bi-exclamation-circle icon-ml"></i>Cancel My Offer</a>';

							   } else if($offerStatus == 1){

							   		//echo '<span>OFFER PRICE ACCEPTED</span>';
							   		echo '<div class="alert alert-success" role="alert">
										  Offer Accepted by '.$sellerfirstname.'!<hr><a href="transactions.php?tab2active=true"class="text-decoration-none">View More</a>
										</div>';

							   } else if($offerStatus == 2){

							   		echo '<div class="alert alert-danger" role="alert">
										  Offer Rejected by '.$sellerfirstname.'<hr><a href="accept_offer.php?command=remove&offerid='.$outOfferID.'"class="text-decoration-none">Remove</a>
										</div>';


							   } else if($offerStatus == 3){

							   		echo '<div class="alert alert-warning" role="alert">
										  Oh no! Looks like this listing has been sold to somebody else<hr><a href="accept_offer.php?command=remove&offerid='.$outOfferID.'"class="text-decoration-none">Remove</a>
										</div>';


							   }
							   
					  			
					  	echo '</div>
					  		
					  	</div>


					    
					  </div>

					  

					  <div class="card-footer text-muted bg-light">'.$dateFormat.' '.$timeFormat.'</div>
					</div>'; 



					}

				} 



?>