<div class="row">

			<div class="col-sm-4 col-setting add-red-border">
				<img src="somepics/no_img.jpg" class="user-img-setting img-fluid-mod img-sizing mx-auto d-block" onclick = "uploadBookPicTrigger()" id="picPlaceholder">

				<div class="container book-details-1">
					<input type="file" name="choose-listing-pic mx-auto d-block"><br>

					<select name="sell-or-rent" class="select-box add-mt">
						<option value="1">For Sale</option>
						<option value="0">For Rent</option>
					</select><br>

					<label class="selectlabel add-mt">Book Course Code</label><br>
					<select name="course-code" class="select-box">
						<?php
							$getcourse = "SELECT * FROM course";
							$result = mysqli_query($connect, $getcourse);
							while($fetchedrows = mysqli_fetch_array($result)){
								echo "<option value = '".$fetchedrows[0]."'>".$fetchedrows[1]."</option>";
							}
						?>
						
					</select><br>

					<label class="selectlabel add-mt">Select Book Condition</label><br>
					<select name="book-condition" class="select-box">
						<option value="pristine">Pristine</option>
						<option value="used">Used</option>
					</select><br>

					<label class="selectlabel add-mt">Enter Subject Code</label><br>
					<input type="text" class="select-box" name="subject-code" placeholder="e.g. KTXXX03" required>

					

				</div>
				
			</div>
 
			<div class="col-sm-8 col-setting add-red-border">
				<p>Hello World</p>

			</div>
			

		</div>

			<!--<div class="add-red-border">
				
				<img src="somepics/no_img.jpg" alt="no image" class="img-fluid float-start user-img-setting"> 

			
				<div class="input-group">

				  <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
				  <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Button</button>

				</div>
								
			</div> -->