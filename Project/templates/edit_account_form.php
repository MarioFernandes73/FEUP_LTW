	<div id="content">
		<h1> Edit Account </h1>
		
			<form action="action_edit_account.php" class = "big_form" method="post">
			
			<!-- Security -->
			
				<?php
				echo '<input type="hidden" name="csrf" value="' . $_SESSION['csrf_token'] . '">';
				?>
			
			<!-- Name, Age, Gender -->
			
				<fieldset>
					<legend> Account Information </legend>
					<h3> <?php echo $_SESSION['id_account'] ?> </h3>
					<p> Note: For security purposes, only numbers, letters and simple punctuation such as '.' ',' '!' '_' '?' are allowed </p>
					<!-- <p><label>Username: 
						<input type="text" class="max_width" name="username" required="required" value=<?php echo $_SESSION['id_account'] ?>>
					</label></p> -->
					<p><label>Name: 
						<input type="text" class="max_width"name="name" required="required" pattern="[A-Za-z0-9 _.,!?/$]*" value="<?php echo $_SESSION['name'] ?>">
					</label></p>
					<!-- <p><label>Password: 
						<input type="password" class="max_width"name="password" required="required">
					</label></p> -->
					<p><label>Age: 
						<input type="number" name="age" value=<?php echo $_SESSION['age']?> min="18" max="90" step="1">
					</label></p>
					<div>
						<label> Gender <label>
						<input type="radio" name="gender" value="1" 
						<?php
							if($_SESSION['gender'] == 1)
								echo 'checked="checked"';
						?>>Male
						<input type="radio" name="gender" value="2"
						<?php
							if($_SESSION['gender'] == 0)
								echo 'checked="checked"';
						?>>Female
					</div>
				</fieldset>
				<input class="button_1 button" type="submit" value="Save Changes">
			</form>
	</div>