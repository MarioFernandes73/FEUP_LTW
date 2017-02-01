<div id="content">

	<h1 class="title"> Top 10 Restaurants </h1>
	<div class="display_big_center">
		<?php
		
			$result = getTop10Restaurant($db);
			foreach( $result as $row) {
				echo '<a class="item" href="restaurant_item.php?id=' . $row['id_restaurant'] . '">' . $row['name']  .  '</a>';
			 }
		?>
	</div>
	
</div>