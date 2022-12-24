<?php 
	
	include_once 'include/connectdb.php';
	include_once 'sql_functions.php';
	session_start();

	echo '<h1>Incoming Offers</h1>';
 
			  			$userID = $_SESSION['userID'];

			  			$inOfferCount = getInOfferCount($connect, $userID);
			  			echo '<span class="text-muted px-2">You have '.$inOfferCount.' incoming offers</span>';

			  			if($inOfferCount > 0){
			  				
			  				$incomingOffers = getIncomingOffers($connect, $userID);

			  			foreach ($incomingOffers as $row) {

			  				$offerID = $row['offer_id'];
			  				$listingID = $row['listing_id'];
			  				$buyerID = $row['offerFrom'];
			  				$offerDate = $row['offer_date'];
			  				$offerTime = $row['offer_time'];
			  				$offerPrice = $row['offer_price'];
			  				$timeFormat = date('g:i A', strtotime($offerTime));
			  				$dateFormat = date('d M Y', strtotime($offerDate));

			  				$buyerDetails = getDetailsFromID($connect, $buyerID);

			  				foreach($buyerDetails as $row) {
			  					$buyerfirstname = $row['user_fname'];
			  					$buyerlastname = $row['user_lname'];
			  					$buyerPic = $row['user_picpath'];
			  				}

			  				//$buyerPic = getProfilePic($connect, $buyerID);

			  				$getListingDetails = getListingDetails($connect, $listingID);
			  				foreach ($getListingDetails as $row) {
			  					$bookImgPath = $row['book_imgpath'];
			  					$bookTitle = $row['book_title'];
			  					//$bookPrice = $row['book_price'];
			  				}


			  		echo '	<div class="card mb-3">
			  		<div class="card-header bg-light">
					  	<img src="profile/'.$buyerPic.'" class="rounded-circle user-pic-sizing">
					    '.$buyerfirstname.' '.$buyerlastname.' made an offer 
					  </div>

					  <div class="card-body">

					  	<div class="row">

					  		<div class="col-xl-1 add-bg-grey">
					  			<img src="listing/'.$bookImgPath.'" class="mx-auto d-block img-sizing">
					  		</div>

					  		<div class="col-xl-11">

					  			<h4 class="card-title mt-3">'.$bookTitle.'</h4>
							    <p class="card-text">OFFERED TO ME FOR : <span class="text-danger"><strong>RM'.$offerPrice.'</strong></span></p>
							    <a href="accept_offer.php?booktitle='.$bookTitle.'&command=accept&offerid='.$offerID.'&productid='.$listingID.'&buyerid='.$buyerID.'" class="btn btn-accept mb-3 mobile-view-btn"><i class="bi bi-check-circle icon-ml"></i>Accept Offer</a>
							    <a href="accept_offer.php?booktitle='.$bookTitle.'&command=reject&offerid='.$offerID.'&buyerid='.$buyerID.'" class="btn btn-reject mb-3 mobile-view-btn"><i class="bi bi-x-circle icon-ml"></i>Reject Offer</a>
							    <a href="#" class="btn btn-chat mb-3 mobile-view-btn"><i class="bi bi-whatsapp icon-ml"></i>WhatsApp '.$buyerfirstname.'</a>
					  			
					  		</div>
					  		
					  	</div>


					    
					  </div>



					  <div class="card-footer text-muted bg-light">'.$dateFormat.' '.$timeFormat.'</div>
					  
					</div>';


			  				
			  			}

			  		} 
			  			


?>