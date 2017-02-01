<div id="content">

	<h1 class="title"> All Restaurants </h1>
	<div class="display_big_center">
		<?php
			$result = getAllRestaurant
			($db);
			
			foreach( $result as $row) {
				echo '<a href="restaurant_item.php?id=' . $row['id_restaurant'] . '">' . $row['name']  .  '</a>';
			 }
		?>
	</div>
	
</div>