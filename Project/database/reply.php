<?php
	function getReply($db,$id_review){
		$stmt = $db->prepare('SELECT * FROM Reply WHERE id_review = ?');
		$stmt->execute(array($id_review));
		$result = $stmt->fetchAll();
		return $result;
	}
	
	function addReply($db,$id_review,$id_replyer,$comment){
		$stmt = $db->prepare('INSERT INTO Reply (id_review, id_replyer,comment) VALUES (?,?,?)');
		$stmt->execute(array($id_review,$id_replyer,$comment));
	}
?>