<?php
  include ('templates/session_start.php');
  include_once getcwd() . "/database/connection.php";
  include_once getcwd() . "/database/restaurant.php";
  include ('templates/header.php');
  include ('templates/all_restaurants.php');
  include ('templates/footer.php');
?>
