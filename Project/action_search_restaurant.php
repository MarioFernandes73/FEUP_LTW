<?php
	include_once('templates/session_start.php');
    include ('templates/header.php');    
	include_once('database/connection.php');
	include_once('database/restaurant.php');
	
	/*Security*/
	
		if (isset($_SESSION['id_account']) && $_SESSION['csrf_token'] != $_POST['csrf']) {
			header('Location: error.php');
		}
		else{
			?>
			<div id="content">
				<h1 id="title"> Search Results </h1>
				<div class="display_big_center">
		<?php
			
			/*
			Ignores input text that are blanck and all the checkboxes are checked
			If atleast one of the restaurants has that checkbox category/function_day then it will 
			The stars param defines the bottom limit of the restaurant rating
			The Average Price defines the top limit of the restaurant avg price
			The start and end time are 00:00 - 23:00 by default
			*/

			if($_POST['restaurant_name'] == "")
				$restaurant_name = '%';
			else
				$restaurant_name = '%' . $_POST['restaurant_name'] . '%';
			
			if($_POST['address_name']=="")
				$address = '%';
			else
				$address = $_POST['address_name'];
			
			if($_POST['avg_price'] == "")
				$avg = '%';
			else
				$avg = $_POST['avg_price'];
			
			$stars = $_POST['stars'];
			
			if($_POST['start_time']=="")
				$start='00:00';
			else
				$start = $_POST['start_time'];
			
			if($_POST['end_time']=="")
				$end='24:00';
			else
				$end=$_POST['end_time'];
			
			if(!isset($_POST['days'])) {
				$weekdays = [];
			}
			else
				$weekdays = $_POST['days'];
			
			if(!isset($_POST['categories'])) {
				$cat = [];
			}
			else
				$cat = $_POST['categories'];
				
				$stmt = $db->prepare('SELECT * FROM Restaurant WHERE name LIKE ? AND address LIKE ? AND avg_price <= ? AND stars >= ?');
				$stmt->execute(array($restaurant_name, $address, $avg, $stars));
				$result = $stmt->fetchAll();
			
				
					foreach( $result as $row) {
						$show=1;
							foreach($weekdays as $days)
							{
								if($row[$days]==0)
									$show = 0;
							}
							
							$allcategories = findRestaurantFood($db,$row['id_restaurant']);		
							
								
							foreach($cat as $category)
							{
								$inarray=0;
								foreach($allcategories as $temp)
								{
									if($temp[0]==$category)
										$inarray=1;
								}
								
								if($inarray==0)
									$show=0;

							}					
						if($row['open_time'] >= $start && $row['close_time'] <= $end && $show==1)
						echo '<a href="restaurant_item.php?id=' . $row['id_restaurant'] . '">' . $row['name']  .  '</a>';
					 }
				
					?>
					</div>
				</div>
			<?php
			include ('templates/footer.php');
		}
?>