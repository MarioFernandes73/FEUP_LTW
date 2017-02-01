<?php
$result = getRestaurantItem($db, array($_POST['id']));
?>

<div id="content">
		<h1> Edit Restaurant </h1>
		<div>
			<form action="action_edit_restaurant.php" class="big_form" method="post" enctype="multipart/form-data">
			
			<!-- Security --> 
			
				<?php
				echo '<input type="hidden" name="csrf" value="' . $_SESSION['csrf_token'] . '">';
				?>
                
			<!-- To prevent $_GET information to pass from php to php -->
				
				<input type="hidden" class="max_width" name="id" required="required" value="<?php echo $_POST['id']?>">	
				
			<!-- Name,Adress,Average Price, Description -->	
				
				<fieldset>
					<legend>General Information</legend>
					
					<p> Note: For security purposes, only numbers, letters and simple punctuation such as '.' ',' '!' '_' '?' are allowed </p>
					<p><label>Name: 
						<input type="text" class="max_width" name="name" required="required" pattern="[A-Za-z0-9 _.,!?/$]*" value="<?php echo $result['name']?>">
					</label></p>
                    <p><label>Address:
                            <input id="pac-input" class="max_width" type="text" name="address" placeholder="Enter a location" required="required" value="<?php echo $result['address']?>">
                            <!-- <input type="text" class="max_width" name="address" required="required"> -->
                        </label></p>
                    <p><label>Average Price: </label></p>
                    <input type="number" min="1" max="200" step="1" name="avg_price" value="<?php echo $result['avg_price']?>">
                    <p><label>Description:</label></p>
					<textarea type="text" class="max_width" name="description" required="required"><?php echo $result['description']?></textarea>
				</fieldset>
				
			<!-- Function Time - Checkes the boxes of the weekdays that are checked for the restaurant -->

				<fieldset>
					<legend>Opening Hours</legend>
					Hours: <input name="open_time" type="time" value="<?php echo $result['open_time']?>"> - <input name="close_time" type="time" value = "<?php echo $result['close_time']?>"><br><br>
					<ul class="simple_list">					
						<li><input class="select_all" type="checkbox" data-group=".group1">All Checked<br><br></li>
						<li><input class="group1" name="days[]" type="checkbox" value="monday"
						    <?php if($result['monday']) echo 'checked="checked"';?>
                            >Monday</li>
						<li><input class="group1" name="days[]" type="checkbox" value="tuesday"
                                <?php if($result['tuesday']) echo 'checked="checked"';?>
                            >Tuesday</li>
						<li><input class="group1" name="days[]" type="checkbox" value="wednesday"
                                <?php if($result['wednesday']) echo 'checked="checked"';?>
                            >Wednesday</li>
						<li><input class="group1" name="days[]" type="checkbox" value="thursday"
                                <?php if($result['thursday']) echo 'checked="checked"';?>
                            >Thursday</li>
						<li><input class="group1" name="days[]" type="checkbox" value="friday"
                                <?php if($result['friday']) echo 'checked="checked"';?>
                            >Friday</li>
						<li><input class="group1" name="days[]" type="checkbox" value="saturday"
                                <?php if($result['saturday']) echo 'checked="checked"';?>
                            >Saturday</li>
						<li><input class="group1" name="days[]" type="checkbox" value="sunday"
                                <?php if($result['sunday']) echo 'checked="checked"';?>
                            >Sunday</li>
					</ul>
				</fieldset>
				
			<!-- Categories - Checkes the boxes of the categories that are checked for the restaurant -->
				
				<fieldset>
					<legend> Categories </legend>
					
					<ul class="simple_list">
						<li><input class="select_all" type="checkbox" data-group=".group2">All Checked<br><br></li>
					
					<?php
					include_once getcwd() . "/database/search.php";
					
					$resultCategories = getAllCategories($db);
                    /*$categories = getRestaurantFood($db,$_POST['id']);

                    foreach( $categories as $row) {
                        echo '<p>' .$row['id_category'] . '</p>';
                    }*/

                    foreach( $resultCategories as $row) {
						echo '<li><input class="group2" name="categories[]" type="checkbox" value="' . $row['id_category'] . '">' . $row['id_category'] .'<br></li>';
					 }
					?>
					</ul>
				</fieldset>
				
			<!-- Uplocad Images - It will override the existing ones -->
				
				<fieldset>
					<legend> Images Upload </legend>
                    <p>The photos inserted will override the existing ones, please make sure to upload all the photos you want to appear or upload none if you want to keep the existing ones.</p>
					<input type="file" name="upload[]" multiple>
				</fieldset>
				
				<input type="submit" class="button_1 button" value="Edit restaurant" />
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