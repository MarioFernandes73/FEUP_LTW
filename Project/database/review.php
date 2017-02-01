<?php
	function getAllReviews($db,$id_restaurant){
		$stmt = $db->prepare('SELECT * FROM Review WHERE id_restaurant = ?');
		$stmt->execute(array($id_restaurant));
		$result = $stmt->fetchAll();
		return $result;
	}

	function getReviewByUserToRestarurant($db,$id_restaurant, $id_reviewer){
		$stmt = $db->prepare('SELECT * FROM Review WHERE id_restaurant = ? AND id_reviewer = ?');
		$stmt->execute(array($id_restaurant, $id_reviewer));
		$result = $stmt->fetch();
		return $result;
	}
	
	function addReview($db,$id_restaurant,$id_account,$score,$comment){
		$stmt = $db->prepare('INSERT INTO Review (id_restaurant, id_reviewer, score, comment) VALUES (?,?,?,?)');
		$stmt->execute(array($id_restaurant,$id_account,$score,$comment));
	}
?>