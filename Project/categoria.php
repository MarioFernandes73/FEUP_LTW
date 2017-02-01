<?php
  include ('templates/session_start.php');
  include ('templates/header.php');
?>
  <div id="feed">
		<h4> Feed </h4>
			<ul>
				<?php
				    $idcategoria= $_GET['categoria'];
					include_once getcwd() . "/database/connection.php";
					$stmt = $db->prepare('SELECT * FROM Restaurant WHERE id_category = "'.$idcategoria.'"');
					$stmt->execute();
					$result = $stmt->fetchAll();
					
					foreach( $result as $row) {
						echo '<li><a class="feed" href="">' . $row['name']  .  '</a></li>';
					 }
				?>
			</ul>
	</div>
  <?php
  include ('templates/side_bar.php');
  include ('templates/footer.php');
?>