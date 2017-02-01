<?php
  include ('templates/session_start.php');
  include_once('database/connection.php');
  include_once('database/restaurant.php');
  include ('templates/header.php');
  ?>

  	<div id="content">
		<?php
		
		/*Security - Confirm possible Values*/
		
		if($_GET['day'] != 'monday' && $_GET['day'] != 'tuesday' && $_GET['day'] != 'wednesday' && $_GET['day'] != 'thursday' && $_GET['day'] != 'friday' && $_GET['day'] != 'saturday' && $_GET['day'] != 'sunday')
			header('Location: error.php');
		else
		{
			echo '<h1 id="title"> Weekday - ' . $_GET['day'] . '</h1>';
			echo '<div class="display_big_center">';
				$result=getRestaurantDay($db,$_GET['day']);
				foreach($result as $row)
					echo '<a href="restaurant_item.php?id=' . $row['id_restaurant'] . '">' . $row['name']  .  '</a>';
			echo '</div>';
		}
		?>
	</div>
	
<?php  
  include ('templates/footer.php');
?>