<?php  
	include_once('database/connection.php');
	include_once('database/account.php');
	include('templates/session_start.php');
    include ('templates/header.php');
    echo '<div id="content">';
	
	/*Security*/
	
		if ($_SESSION['csrf_token'] != $_POST['csrf']) {
			header('Location: error.php');
		}
		else{
			$id_account=$_SESSION['id_account'];
			if (($result = userValidLogIn($db, $id_account, $_POST['current_password'])) != null){
				changeAccountPassword($db, $id_account, $_POST['new_password_1']);
				echo 'Password changed successfully!';
			}
			else{
				echo 'The password inserted is wrong';
			}
			echo '</div>';
			include ('templates/footer.php');
		}
?>