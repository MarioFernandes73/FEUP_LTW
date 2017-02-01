<?php

	function getTop10Restaurant($db){
		$stmt = $db->prepare('SELECT * FROM Restaurant ORDER BY stars DESC LIMIT 10');
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	
	function getAllRestaurant($db){
		$stmt = $db->prepare('SELECT * FROM Restaurant ORDER BY name ASC');
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

    function getAllRestaurantsName($db){
    $stmt = $db->prepare('SELECT id_restaurant, name FROM Restaurant');
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

	function getAllRestaurantsFromOwner($db, $owner){
		$stmt = $db->prepare('SELECT * FROM Restaurant WHERE id_owner = ?');
		$stmt->execute(array($owner));
		$result = $stmt->fetchAll();
		return $result;
	}
	
	function getRestaurantId($db, $name, $owner){
		$stmt = $db->prepare('SELECT id_restaurant FROM Restaurant WHERE name = ? AND id_owner = ?');
		$stmt->execute(array($name,$owner));
		$result = $stmt->fetch()[0];
		return $result;
	}
	
	function getRestaurantItem($db, $id){
		$stmt = $db->prepare('SELECT * FROM Restaurant WHERE id_restaurant = ?');
		$stmt->execute($id);
		$result = $stmt->fetch();
		return $result;
	}
	
	function updateRestaurantRating($db,$id){
		$stmt = $db->prepare('SELECT AVG(score) FROM Review WHERE id_restaurant = ?');
		$stmt->execute(array($id));
		$result = $stmt->fetch();
		
		$score = number_format($result[0], 2, '.', '');
		
		$update = $db->prepare('UPDATE Restaurant SET stars = ? WHERE id_restaurant = ?');
		$update->execute(array($score,$id));
	}

	function addRestaurant($db, $name, $owner, $address, $description, $avg_price,$open_time, $close_time, $monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday){
		$stmt = $db->prepare('INSERT INTO Restaurant (stars,id_owner, name, address, avg_price,description, open_time, close_time, monday, tuesday, wednesday, thursday, friday, saturday, sunday) VALUES (0,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
		$stmt->execute(array($owner, $name, $address, $avg_price, $description,  $open_time, $close_time, $monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday));
	}

function editRestaurant($db, $id, $name,  $address, $description, $avg_price,$open_time, $close_time, $monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday){
    $stmt = $db->prepare('UPDATE Restaurant SET
      name = ?,
      address = ?,
      avg_price = ?,
      description = ?,
      open_time = ?,
      close_time = ?,
      monday = ?,
      tuesday = ?,
      wednesday = ?,
      thursday = ?,
      friday = ?,
      saturday = ?,
      sunday = ?
      WHERE id_restaurant = ?');
    $stmt->execute(array($name, $address, $avg_price, $description,  $open_time, $close_time, $monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday, $id));
}
	
	function addCategoriesRestaurant($db,$name,$owner,$categories){
		$id_restaurant = getRestaurantId($db,$name,$owner);
		
		if(is_array($categories)){
			foreach($categories as $category){
				$exec = $db->prepare('INSERT INTO RestaurantFood (id_restaurant,id_category) VALUES (?,?)');
				$exec->execute(array($id_restaurant,$category));
			}			
		}
		else
		{
			$category = $categories;
			$exec = $db->prepare('INSERT INTO RestaurantFood (id_restaurant,id_category) VALUES (?,?)');
			$exec->execute(array($id_restaurant,$category));
		}
	}

	function addPhotosRestaurant($db,$name,$owner,$photosPath){
		$id_restaurant = getRestaurantId($db,$name,$owner);
		
		if(is_array($photosPath)){
			foreach($photosPath as $photoPath){
				$exec = $db->prepare('INSERT INTO Photo (id_restaurant,path) VALUES (?,?)');
				$exec->execute(array($id_restaurant,$photoPath));
			}			
		}
		else
		{
			$photoPath = $photosPath;
				$exec = $db->prepare('INSERT INTO Photo (id_restaurant,path) VALUES (?,?)');
				$exec->execute(array($id_restaurant,$photoPath));
		}
	}
	
	function getRestaurantPhotos($db,$id_restaurant){
		$stmt = $db->prepare('SELECT path FROM Photo WHERE id_restaurant = ?');
		$stmt->execute(array($id_restaurant));
		$result = $stmt->fetchAll();
		return $result;
	}
	
	function deleteRestaurants($db,$username){
		$stmt = $db->prepare('SELECT id_restaurant FROM Restaurant WHERE id_owner = ?');
		$stmt->execute(array($username));
		$result=$stmt->fetchAll();
		foreach($result as $row){
			deleteRestaurant($db, $row['id_restaurant']);
		}
	}

	function deleteRestaurant($db,$id_restaurant){
		$stmt = $db->prepare('DELETE FROM Restaurant WHERE id_restaurant = ?');
		$stmt->execute(array($id_restaurant));
        deleteRestaurantFoodByIdRestaurant($db,$id_restaurant);
        deleteReviewsAndRepliesByIdRestaurant($db,$id_restaurant);
        deletePhotosByIdRestaurant($db,$id_restaurant);

	}

    function deleteRestaurantFoodByIdRestaurant($db,$id_restaurant){
        $stmt = $db->prepare('DELETE FROM RestaurantFood WHERE id_restaurant = ?');
        $stmt->execute(array($id_restaurant));
    }
function deleteReviewsAndRepliesByIdRestaurant($db,$id_restaurant){
    $stmt = $db->prepare('SELECT id_review FROM Review WHERE id_restaurant = ?');
    $stmt->execute(array($id_restaurant));
    $result = $stmt->fetchAll();
    foreach ($result as $row) {
        $stmt = $db->prepare('DELETE FROM Reply WHERE id_review = ?');
        $stmt->execute(array($row['id_review']));
    }
    $stmt = $db->prepare('DELETE FROM Review WHERE id_restaurant = ?');
    $stmt->execute(array($id_restaurant));
}

function deletePhotosByIdRestaurant($db,$id_restaurant){
    $stmt = $db->prepare('SELECT path FROM Photo WHERE id_restaurant=?');
    $stmt->execute(array($id_restaurant));
    $result = $stmt->fetchAll();
    foreach ($result as $row) {
        unlink($row['path']);
    }
    $stmt = $db->prepare('DELETE FROM Photo WHERE id_restaurant = ?');
    $stmt->execute(array($id_restaurant));
}
	
	function findRestaurantFood($db, $restaurant){
		$stmt= $db-> prepare('SELECT id_category FROM RestaurantFood WHERE id_restaurant=?');
		$stmt->execute(array($restaurant));
		$result=$stmt->fetchAll();
		return $result;
	}
	
	function getRestaurantDay($db,$day){

		$stmt=$db->prepare('SELECT * FROM Restaurant WHERE '.$day.'=1');
		$stmt->execute();
		$result=$stmt->fetchAll();
		return $result;
		
	}
 ?>