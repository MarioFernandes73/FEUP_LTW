<?php
	include_once('database/connection.php');
	include_once('database/restaurant.php');
	session_start();
	
	/*Security*/
	
		if ($_SESSION['csrf_token'] != $_POST['csrf']) {
			header('Location: error.php');
		}
		else{
			deleteRestaurant($db,$_POST['id']);
			header('Location: my_restaurants.php');
		}
?>