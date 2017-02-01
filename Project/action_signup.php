<?php
    include ('templates/header.php');
	include_once('database/connection.php');
	include_once('database/account.php');
	
	$result = getAccountItem($db, $_POST['username']);
	echo '<div id="content">';
	
	if ($result == null){
        addAccount($db, $_POST['username'], $_POST['name'], $_POST['password'], $_POST['gender'], $_POST['age'], $_POST['type']);
		echo '<p>The user was created successfully!</p>';
	}else{
		echo '<p>Could not sign up because the user already exists!</p>';
	}
	
	echo '</div>';
	include ('templates/footer.php');
?>
	