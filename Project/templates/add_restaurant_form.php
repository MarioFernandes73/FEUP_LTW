	<div id="content">
	
		<h1> Create Restaurant </h1>
		
		<div>
			
			<form action="action_add_restaurant.php" class="big_form" method="post" enctype="multipart/form-data" > <!-- onsubmit="return mySubmitFunction()"> -->
			
			<!-- Security -->
			
				<?php
				echo '<input type="hidden" name="csrf" value="' . $_SESSION['csrf_token'] . '">';
				?>
			
			<!-- Name, Address (with geocode API), average price and description -->
			
				<fieldset>
					<legend>General Information</legend>
					<p> Note: For security purposes, only numbers, letters and simple punctuation such as '.' ',' '!' '_' '?' are allowed </p>
					
					<p><label>Name: 
						<input type="text" class="max_width" name="name" pattern="[A-Za-z0-9 _.,!?/$]*" required="required">
					</label></p>
					<p><label>Address: 
						<input id="pac-input" class="max_width" type="text" name="address" placeholder="Enter a location" required="required">
						<!-- <input type="text" class="max_width" name="address" required="required"> -->
					</label></p>
					<p><label>Average Price: </label></p>
					<input type="number" value="10" min="1" max="200" step="1" name="avg_price">
					<p><label>Description:</label></p>
					<textarea type="text" class="max_width bit_textArea" name="description" required="required"></textarea>
				</fieldset>
				
			<!-- Function Time -->

				<fieldset>
					<legend>Opening Hours</legend>
					Hours: <input name="open_time" type="time" value='00:00'> - <input name="close_time" type="time" value = '23:59'><br><br>
					<ul class="simple_list">					
						<li><input class="select_all" type="checkbox" checked="checked" data-group=".group1">All Checked<br><br></li>
						<li><input class="group1" name="days[]" type="checkbox" checked="checked" value="monday">Monday</li>
						<li><input class="group1" name="days[]" type="checkbox" checked="checked" value="tuesday">Tuesday</li>
						<li><input class="group1" name="days[]" type="checkbox" checked="checked" value="wednesday">Wednesday</li>
						<li><input class="group1" name="days[]" type="checkbox" checked="checked" value="thursday">Thursday</li>
						<li><input class="group1" name="days[]" type="checkbox" checked="checked" value="friday">Friday</li>
						<li><input class="group1" name="days[]" type="checkbox" checked="checked" value="saturday">Saturday</li>
						<li><input class="group1" name="days[]" type="checkbox" checked="checked" value="sunday">Sunday</li>
					</ul>
				</fieldset>
				
			<!-- Categories -->
			
				<fieldset>
					<legend> Categories </legend>
					
					<ul class="simple_list">
						<li><input class="select_all" type="checkbox" checked="checked" data-group=".group2">All Checked<br><br></li>
					
					<?php
					include_once getcwd() . "/database/connection.php";
					include_once getcwd() . "/database/search.php";
					
					$result = getAllCategories($db);
					
					foreach( $result as $row) {
						echo '<li><input class="group2" name="categories[]" type="checkbox" checked="checked" value="' . $row['id_category'] . '">' . $row['id_category'] .'<br></li>';
					 }
					?>
					</ul>
				</fieldset>
				
			<!-- Image Uploads -->
			
				<fieldset>
					<legend> Images Upload </legend>
					<input type="file" name="upload[]" multiple>
        		</fieldset>
				
				<input type="submit" id="submit_button" class="button_1 button" value="Create restaurant"/>
			</form>
		</div>
	</div>
	
	    <script>
      function initMap() {
        
        var input = /** @type {!HTMLInputElement} */(
            document.getElementById('pac-input'));

        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function() {
          var place = autocomplete.getPlace();          	    	console.log(place);

          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          } else {}

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

        });

      }
        	    /*function mySubmitFunction() {
        	    	var input = (document.getElementById('pac-input'));

        var autocomplete = new google.maps.places.Autocomplete(input);
	    	console.log("teste");
          var place = autocomplete.getPlace();
          	    	console.log(place);

          if (place == null) {
          	
          		window.alert('Enter a valid address');
          		return false;}
        	    }*/
    </script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtWK2oxBU_WhzpUnS6uhHsJoylnJz-Kvc&libraries=places&callback=initMap"
        async defer></script>