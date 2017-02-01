<?php
  include ('templates/session_start.php');
  include_once getcwd() . "/database/connection.php";
  include_once getcwd() . "/database/review.php";
  include_once getcwd() . "/database/restaurant.php";
  
  /*Security*/
  
	if ($_SESSION['csrf_token'] != $_POST['csrf']) {
		header('Location: error.php');
	}
	else{
		addReview($db,$_POST['id_restaurant'],$_SESSION['id_account'],$_POST['score'],$_POST['comment']);
		updateRestaurantRating($db,$_POST['id_restaurant']);
		header('Location: restaurant_item.php?id=' . $_POST['id_restaurant']);
	}	
?>
