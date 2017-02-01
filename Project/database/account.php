<?php
	function getAccountItem($db, $username){
		$stmt = $db->prepare('SELECT id_account, name, age, type, gender FROM Account WHERE id_account = ?');
		$stmt->execute(array($username));
		$result = $stmt->fetch();
		return $result;
	}

function userValidLogIn($db, $username, $password){
	$stmt = $db->prepare('SELECT * FROM Account WHERE id_account = ?');
	$stmt->execute(array($username));
	$result = $stmt->fetch();
	if ($result != null  && password_verify($password, $result['pass'])) {
        return $result;
    }else{
		return null;
	}
}

function addAccount($db, $username, $name, $password, $gender, $age, $type){
		$options = ['cost' => 12];
		$stmt = $db->prepare('INSERT INTO Account (
                                                    id_account,
                                                    name,
                                                    pass,
                                                    gender,
                                                    age,
                                                    type
                                                    ) VALUES (?,?,?,?,?,?)');
		$stmt->execute(array(
            $username,
			$name,
            password_hash($password, PASSWORD_DEFAULT, $options),
			$gender,
			$age,
			$type));
}

function changeAccountPassword($db, $username, $new_password){
    $options = ['cost' => 12];
    $stmt = $db->prepare("UPDATE Account SET pass=? WHERE id_account = ?");
    $stmt->execute(array(
        password_hash($new_password, PASSWORD_DEFAULT, $options),
        $username));
}

function editAccount($db,$username,$name,$age,$gender){
	$sql="UPDATE Account SET name=?, age=?, gender=? WHERE id_account = '$username'";
	$stmt=$db->prepare($sql);
	$stmt->execute(array($name,$age,$gender));
	}

	function deleteAccount($db,$username){
	$stmt = $db->prepare("DELETE FROM Account WHERE id_account=?");
	$stmt->execute(array($username));
	}
	
	function getFavoriteRestaurants($db, $username){
		$stmt = $db->prepare('SELECT * FROM Restaurant WHERE id_restaurant IN (SELECT id_restaurant FROM Review WHERE id_reviewer = ? ORDER BY score DESC)');
		$stmt->execute(array($username));
		$result = $stmt->fetchAll();
		return $result;
	}
	?>
 
 
 