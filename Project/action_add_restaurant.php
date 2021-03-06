<?php
	include_once('templates/session_start.php');
    include ('templates/header.php');    
	include_once('database/connection.php');
	include_once('database/restaurant.php');
	
	/*Security*/
	
	if ($_SESSION['csrf_token'] != $_POST['csrf']) {
		header('Location: error.php');
	}
	else{
			$already_exists = getRestaurantId($db,$_POST['name'],$_SESSION['id_account']);
	
			if($already_exists == NULL){
				// Count # of uploaded files in array
				$total = count($_FILES['upload']['name']);
				$totalSize = 0;

				for($i=0; $i<$total; $i++) {
					$totalSize += $_FILES['upload']['size'][$i];
				}

				if ($totalSize < 50000000){
				// Loop through each file
					for($i=0; $i<$total; $i++) {
					  //Get the temp file path
						$tmpFilePath = $_FILES['upload']['tmp_name'][$i];
						echo $tmpFilePath;

						//Make sure we have a filepath
						if ($tmpFilePath != ""){
							$imageFileType = pathinfo($_FILES['upload']['name'][$i],PATHINFO_EXTENSION);

							echo 'photo uploaded';

							// Allow certain file formats
							if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
								echo $imageFileType;
								echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
							} 
							else {
								echo 'photo uploaded';

								//Setup our new file path
								$newFilePath[$i] = "images/" . $_POST['name'] . "_" . $i . '.' . $imageFileType;
								//Upload the file into the temp dir
								if(move_uploaded_file($tmpFilePath, $newFilePath[$i])) {
									echo 'photo uploaded';
								}
							}
						}
					}
				}
				
				/*
				days -> array que contem os values (days) em que a checkbox esta a check
				*/
				$monday = in_array("monday",$_POST['days']);
				$tuesday = in_array("tuesday",$_POST['days']);
				$wednesday = in_array("wednesday",$_POST['days']);
				$thursday = in_array("thursday",$_POST['days']);
				$friday = in_array("friday",$_POST['days']);
				$saturday = in_array("saturday",$_POST['days']);
				$sunday = in_array("sunday",$_POST['days']);
				
				addRestaurant($db, $_POST['name'], $_SESSION['id_account'], $_POST['address'], $_POST['description'], $_POST['avg_price'],$_POST['open_time'], $_POST['close_time'],$monday,$tuesday,$wednesday,$thursday,$friday,$saturday,$sunday);
				echo 'ok';
				addCategoriesRestaurant($db, $_POST['name'], $_SESSION['id_account'], $_POST['categories']);
				addPhotosRestaurant($db, $_POST['name'], $_SESSION['id_account'], $newFilePath);

				echo '<div id="content">';
				echo '<p> Restaurant added with success!</p>';

				$createdId = getRestaurantId($db,$_POST['name'],$_SESSION['id_account']);
				header('Location: restaurant_item.php?id=' . $createdId);
			}
			else
			{
				echo '<div id="content">';
				echo '<p> Could not add Restaurant beacuse the owner already has a restaurant with the same name!</p>';
			}
			
			echo '</div>';

			include ('templates/footer.php');
	}

?>