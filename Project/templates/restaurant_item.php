<div id="content">

	<?php
	
		/*
		Security - only numeric values to be passed with get
		*/
		
		if(!is_numeric($_GET['id'])){
			header('Location: error.php');
		}
		else{
			
			/*
			Restaurant Information
			*/
	?>
			<div id="restaurant information">	
				<?php
					$result = getRestaurantItem($db, array($_GET['id']));
					$categories = getRestaurantFood($db,$_GET['id']);
					$photos = getRestaurantPhotos($db,$_GET['id']);
					$totalPhotos = count($photos);
					
					/*
					For Restaurant management
					*/
						
					if(isset($_SESSION['id_account']) && $result['id_owner'] == $_SESSION['id_account']){
				?>
						<form action="edit_restaurant.php" method="post">
							<?php echo '<input type="hidden" name="id" value=' . $_GET['id'] . '>' ?>
							<input  class="button_1 button" type="submit" value="Edit Restaurant">
						</form>
						<form action="action_delete_restaurant.php" method="post">
							<?php 
								echo '<input type="hidden" name="id" value=' . $_GET['id'] . '>' ;
								echo '<input type="hidden" name="csrf" value="' . $_SESSION['csrf_token'] . '">';
							?>
							<input class="button_1 button" type="submit" value="Delete Restaurant">
						</form>
				<?php
					}
					
					/*
					Restaurant Information Session
					*/
					
					echo '<h1 class="subtitle">' . $result['name'] . '</h1>';
					echo '<h3> Rating : ' . $result['stars'] . '</h3>';
					echo '<h3 id="address"> Address : ' . $result['address'] . '</h3>';
					echo '<h3> Description :</h3>';
					echo '<p>' . $result['description'] . '</p>';
					echo '<h3> Average Price : ' . $result['avg_price'] . '</h3>';
					
					echo '<p> Function Time : from ' . $result['open_time'] . ' to ' . $result['close_time'];
					
					if($result['monday']) echo ', <a class="simple_href" href="show_weekday.php?day=monday">Monday</a>';
					if($result['tuesday']) echo ', <a class="simple_href" href="show_weekday.php?day=tuesday">Tuesday</a>';
					if($result['wednesday']) echo ', <a class="simple_href" href="show_weekday.php?day=wednesday">Wednesday</a>';
					if($result['thursday']) echo ', <a class="simple_href" href="show_weekday.php?day=thursday"> Thursday</a>';
					if($result['friday']) echo ', <a class="simple_href" href="show_weekday.php?day=friday"> Friday</a>';
					if($result['saturday']) echo ', <a class="simple_href" href="show_weekday.php?day=saturday"> Saturday</a>';
					if($result['sunday']) echo ', <a class="simple_href" href="show_weekday.php?day=sunday"> Sunday</a>';
					echo '</p>';
					
					echo '<p> Categories : ';
					foreach($categories as $category)
						echo '<a class="simple_href" href="show_category.php?category='.$category['id_category'].'">  '. $category['id_category'] .'</a> ,';
					echo '</p>';

					/*
					Photos Session - displayed inline with slideShow if clicked
					*/
						
					echo '<h2 class="subtitle"> Photos </h2>';
					
					foreach($photos as $photo) {
						echo '<img id = photo src="' . $photo['path'] . '" alt="Image" width="20%">';
					}

					echo '<div class="slideshow">';
						echo '<div class="slideshow-container">';
							$counterPhotos = 1;
							foreach($photos as $photo){

								echo '<div class="mySlides fade">';
								echo '<div class="numbertext">' . $counterPhotos .'/' . $totalPhotos .'</div>';
								echo '<img id="slideshow_content" src="' . $photo['path'] . '" style="width:100%">';
								echo '</div>';
								$counterPhotos++;
							}
				?>
							<a id="slideshow_content" class="prev" onclick="plusSlides(-1)">&#10094;</a>
							<a id="slideshow_content" class="next" onclick="plusSlides(1)">&#10095;</a>
						</div>
						<br>

						<div style="text-align:center">
				<?php
							$counterPhotos = 1;
							foreach($photos as $photo){
								echo '<span id="slideshow_content" class="dot" onclick="currentSlide(' . $counterPhotos . ')"></span>';
								$counterPhotos++;
							}
				?>
						</div>
					</div>
			</div>

			<!-- Location with Google Maps API -->
			
			<h2 class="subtitle"> Location </h2>
			<div id="map"></div>
			
			<!-- Comment Session -->
			
			<h2 class="subtitle"> Comments </h2>
				<?php
				/*
					To know if the reviewer already left a review (just once)
				*/
                if(isset($_SESSION['id_account'])){
                    $reviewByUserToRestaurant = getReviewByUserToRestarurant($db, $_GET['id'], $_SESSION['id_account']);
                    if ($_SESSION['type'] == "reviewer" && $reviewByUserToRestaurant == NULL) {
                        include('review_form.php');
                    }
                }
				?>
			
			<!-- All Comments -->
			
			<input id="button_comments" class="button_1 button" type="submit" value="Show Comments" >
	<?php 
				include('restaurant_comments.php'); 
		}
	
	?>
</div>

<!-- SCRIPT for Google Maps -->

<script>
      function initMap() {

        var geocoder = new google.maps.Geocoder();
         var address = document.getElementById('address').innerHTML;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            var map = new google.maps.Map(document.getElementById('map'), {
          		zoom: 15,
          		center: results[0].geometry.location
          		});
            var marker = new google.maps.Marker({
              map: map,
              position: results[0].geometry.location
            });
          } else {
            //alert('Geocode was not successful for the following reason: ' + status);
          }
        
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtWK2oxBU_WhzpUnS6uhHsJoylnJz-Kvc&callback=initMap">
    </script>