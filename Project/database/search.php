<?php
	function getAllCategories($db){
	
		$stmt = $db->prepare('SELECT * FROM Category');
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		return $result;
	}

 ?>