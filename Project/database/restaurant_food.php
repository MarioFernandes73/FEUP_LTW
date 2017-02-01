<?php
	function getRestaurantFood($db,$id_restaurant){
		$stmt = $db->prepare('SELECT id_category FROM RestaurantFood WHERE id_restaurant = ?');
		$stmt->execute(array($id_restaurant));
		$result = $stmt->fetchAll();
		return $result;
	}
	
	function getAllRestaurantFood($db,$id_category){
		$stmt = $db->prepare('SELECT id_restaurant FROM RestaurantFood WHERE id_category = ?');
		$stmt->execute(array($id_category));
		$result = $stmt->fetchAll();
		return $result;
	}
	
function getAllCategoriesFromRestaurant($db,$restaurant){
		$stmt = $db->prepare('SELECT id_category FROM RestaurantFood WHERE id_restaurant=?');
		$stmt->execute(array($restaurant));
		$result = array();
		while($row = $stmt->fetch())
		$result[] = $row['id_category'];
		return $result;
	}
?>