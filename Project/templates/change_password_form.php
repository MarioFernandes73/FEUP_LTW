	<div id="content">
		<h1> Change Password </h1>
		
			<form action="action_change_password.php" name="changePasswordForm" class = "big_form" method="post" onSubmit="return validatePassword()">
			
			<!-- Security -->
				
				<?php
				echo '<input type="hidden" name="csrf" value="' . $_SESSION['csrf_token'] . '">';
				?>
					<p> Note: For security purposes, only numbers, letters and simple punctuation such as '.' ',' '!' '_' '?' are allowed </p>
				
					<h3> <?php echo $_SESSION['id_account'] ?> </h3>
					<p><label>Current Password: 
						<input type="password" class="max_width" name="current_password" required="required">
					</label></p>
					<p><label>New Password: 
						<input type="password" class="max_width" name="new_password_1" pattern="[A-Za-z0-9 _.,!?/$]*" required="required">
					</label></p>
					<p><label>Confirm New Password: 
						<input type="password" class="max_width" name="new_password_2" pattern="[A-Za-z0-9 _.,!?/$]*" required="required">
					</label></p>
				<input class="button_1 button" type="submit" value="Change Password">
			</form>
	</div>
	<script>
		function validatePassword() {
			var newPassword = document.changePasswordForm.new_password_1;
			var confirmPassword = document.changePasswordForm.new_password_2;

			if(newPassword.value != confirmPassword.value) {
			newPassword.value="";
			confirmPassword.value="";
			newPassword.focus();
			window.alert("The password inserted doesn't match");
			return false;
			}
		}
</script>