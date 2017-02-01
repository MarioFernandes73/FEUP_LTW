<?php  
	include_once('database/connection.php');
	include_once('database/account.php');
	include('templates/session_start.php');
	
	/*Security*/
	
	if ($_SESSION['csrf_token'] != $_POST['csrf']) {
		header('Location: error.php');
	}
	else{
		$id_account=$_SESSION['id_account'];
		editAccount($db,$_SESSION['id_account'],$_POST['name'],$_POST['age'],$_POST['gender']);
		$result=getAccountItem($db, $_SESSION['id_account']);
		
		session_destroy();
		session_start();
			$_SESSION['id_account'] = $result['id_account'];
			$_SESSION['name'] = $result['name'];
			$_SESSION['type'] = $result['type'];
			$_SESSION['age'] = $result['age'];
			$_SESSION['gender'] = $result['gender'];
		include ('templates/header.php');  

		?>
			<div id="content">
		<?php
		/*
			Alterar conta na base de dados
			Se o username, name ou pass forem = "" então não serão alterados
		*/
		echo 'Account succesfully edited!';
			
		?>
			</div>
		<?php
		include ('templates/footer.php');
	}
?>	
	