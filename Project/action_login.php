<?php
	include_once('database/connection.php');

    include_once('database/account.php');
    /*
	Check if account exists
	*/
	session_start();

		if (($result = userValidLogIn($db, $_POST['username'], $_POST['password'])) != null){
			session_destroy();
			session_start();
			$_SESSION['id_account'] = $result['id_account'];
			$_SESSION['name'] = $result['name'];
			$_SESSION['type'] = $result['type'];
			$_SESSION['age'] = $result['age'];
			$_SESSION['gender'] = $result['gender'];
			
			/*
			Security - generate random token
			*/
			if (!isset($_SESSION['csrf_token'])) {
			  $_SESSION['csrf_token'] = md5(uniqid($_SESSION['id_account'], true));
			}
		}else{
		$tries=$_SESSION['tries'];
		session_destroy();
		session_start();
		$_SESSION['tries']=$tries+1;
		}


	header("Location: .");
	exit();
?>