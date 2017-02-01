<?php  if(isset($_SESSION['id_account'])){ ?>
<div id = "content">
	<h1 class="title"> My Account </h1>
	
	<!-- Account Information -->
		<?php
			echo '<h1 class="subtitle">' . $_SESSION['name'] . '</h3>';
			echo '<h3> Username: ' . $_SESSION['id_account'] . '</h3>';
			echo '<h3> Age: ' . $_SESSION['age'] . '</h3>';
			if($_SESSION['gender'] == 1)
				echo '<h3> Gender: Male </h3>';
			else 
				echo '<h3> Gender: Female </h3>';
			echo '<h3> Type: ' . $_SESSION['type'] . '</h3>';
		?>
	
	<!-- Manage Account -->
	
	<div>
		<input id="button_edit_account" action="edit_account.php" class="button_1 button" value="Edit Account"/>
		<input id="button_change_password" action="change_password.php" class="button_1 button" value="Change Password"/>
		
	<!-- Security -->
	
		<form action="action_delete_account.php" method="post">
		  <!-- Security -->
			<?php
				echo '<input type="hidden" name="csrf" value="' . $_SESSION['csrf_token'] . '">';
			?>
		  <input type="submit" class="button_1 button" value="Delete Account"/>
		</form>
		
	</div>
</div>
    <?php  } ?>