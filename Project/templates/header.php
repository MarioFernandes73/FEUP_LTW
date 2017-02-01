<!DOCTYPE html>
<html>
	<head>
		<title>Table for Two</title>
		<meta charset='UTF-8'>
		
		<script src="js/jquery.js"></script>
		<script src="js/page_definitions.js"></script>
		<script src="js/other.js"></script>
		<link rel="stylesheet" href="css/site.css">
	</head>
	<body>
		<div id="header">
			
			<h1> Table for Two </h1>
			
			<!-- Live Search Bar -->
			
			<div id="search_bar">
				<input type="text" id="search" name="search" size="30" onkeyup="showResult(this.value)">
				<div id="livesearch">
                    <a id="livesearch[0]" href=""></a><br>
                    <a id="livesearch[1]" href=""></a><br>
                    <a id="livesearch[2]" href=""></a><br>
                    <a id="livesearch[3]" href=""></a><br>
                    <a id="livesearch[4]" href=""></a>
                </div>
				<!-- <input type="submit" class="button_search button" value=""/> -->
			</div>
			
			<!-- Menu Options -->
			
			<div id="menu">
				<ul>
					<li><input id="go_home" class="header_button button" action="index.php" type="submit" value="Home" /></li> 
					<li><input id="go_restaurants" class="header_button button" action="restaurants.php" type="submit" value="Restaurants" /></li>
					<li><input id="go_advanced_search" class="header_button button" action="advanced_search.php" type="submit" value="Advanced Search" /> </li>
					<li><input id="go_information" class="header_button button" action="information.php" type="submit" value="Information" /></li>
					<?php
					/*Session Started*/
					if(isset($_SESSION['tries']))
					{	}
					else
						$_SESSION['tries']=0;
					
						if (isset($_SESSION['id_account'])){		
							/*Owner ?*/
							if($_SESSION['type'] == 'owner')
									echo '<li><input id="go_my_restaurants" class="header_button button" action="my_restaurants.php" type="submit" value="My Restaurants" /></li>';
							/*Reviewer?*/
							else
									echo '<li><input id="go_my_favorite" class="header_button button" action="my_favorite.php" type="submit" value="My Favorite" /></li>';
							echo '<li><input id="go_my_account" class="header_button button" action="my_account.php" type="submit" value="' . $_SESSION['name'] .'" /></li>';
							echo '<li><input id="do_logout" class="header_button button" action="action_logout.php" type="submit" value="Logout" /></li>';
						
						}
						else{
							if($_SESSION['tries']<3 )
								echo '<li><input id="do_login" class="header_button button" type="submit" value="Login" /></li>';
							else if(isset($_SESSION['timeout']))
							{
								$endtime = time();
								
								if($endtime - $_SESSION['timeout'] >= 30)
								{
									$_SESSION['tries']=0;
									echo '<li><input id="do_login" class="header_button button" type="submit" value="Login" /></li>';
								}
								else
								{
									echo '<li><input id="do_lockout" class="header_button button" action="lockout.php" type="submit" value="Login" /></li>';
								}
								
							}
							else
							{
								echo '<li><input id="do_lockout" class="header_button button" action="lockout.php" type="submit" value="Login" /></li>';
								$_SESSION['timeout'] = time();
							}
								echo '<li><input id="do_signup" class="header_button button" action="signup.php" type="submit" value="SignUp" /></li>';		
						}						
					?>
				</ul>
			</div>
			
			<!-- Login Form -->
			
			<form id="loginform" class="small_form" method="post" action="action_login.php">
				<label id="loginform_content" for="username">Username</label>
				<input id="loginform_content" class="insert_info" type="text" name="username" required="required">
				<label id="loginform_content" for="password">Password</label>
				<input id="loginform_content"class="insert_info" type="password" name="password" required="required">
				<input id="login_button loginform_content" class="button_1 button" type="submit" value="Login">
			</form>
			
			<input id="button_top" type="submit" class="button_top button" value=""/>
		</div>