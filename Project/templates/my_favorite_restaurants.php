<?php  if(isset($_SESSION['id_account'])){ ?>
<div id="content">
	<h1 class="title"> My Favorite </h1>
	<div class = "display_big_center">
	<?php
		$result = getFavoriteRestaurants($db, $_SESSION['id_account']);
		
		foreach( $result as $row) {
				echo '<a class="item" href="restaurant_item.php?id=' . $row['id_restaurant'] . '">' . $row['name']  .  '</a>';
			 }
	?>
	</div>
</div>
    <?php  } ?>