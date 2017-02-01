<?php
  include ('templates/session_start.php');
  include_once getcwd() . "/database/connection.php";
  include_once getcwd() . "/database/reply.php";
  
  /*Security*/
  
	if ($_SESSION['csrf_token'] != $_POST['csrf']) {
		header('Location: error.php');
	}
	else{
		addReply($db,$_POST['id_review'],$_SESSION['id_account'],$_POST['comment']);
		header('Location: restaurant_item.php?id=' . $_POST['id_restaurant']);
	}
?>
