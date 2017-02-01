<?php  if(isset($_SESSION['id_account'])){ ?>
<div id="content">

	<h1 class="title"> My Restaurants </h1>
	<input id="button_add_restaurant" action="add_restaurant.php" class="button_1 button" type="submit" value="Add Restaurant">
	<div class = "display_big_center">
	<?php
		$result = getAllRestaurantsFromOwner($db, $_SESSION['id_account']);
		
		foreach( $result as $row) {
				echo '<a class="item" href="restaurant_item.php?id=' . $row['id_restaurant'] . '">' . $row['name']  .  '</a>';
			 }
	?>
	</div>
	
</div>
    <?php  } ?>