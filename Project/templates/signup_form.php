	<div id="content">
	
			<h1 class="title"> Sign Up </h1>
			
			<form action="action_signup.php" class="big_form" method="post">
			
			<!-- Username, Name, Password, Age, Gender , Type -->
			
				<fieldset>
					<legend>Account Information</legend>
					
					<p> Note: For security purposes, only numbers, letters and simple punctuation such as '.' ',' '!' '_' '?' are allowed </p>
					<p><label>Username: 
						<input type="text" class="max_width" name="username" pattern="[A-Za-z0-9 _.,!?/$]*" required="required">
					</label></p>
					<p><label>Name: 
						<input type="text" class="max_width" name="name" pattern="[A-Za-z0-9 _.,!?/$]*" required="required">
					</label></p>
					<p><label>Password: 
						<input type="password" class="max_width" name="password" pattern="[A-Za-z0-9 _.,!?/$]*" required="required">
					</label></p>
					<p><label>Age: 
						<input type="number" name="age" value="25" min="18" max="90" step="1">
					</label></p>
					<div>
						<label> Gender </label>
						<input type="radio" name="gender" value="1" checked="checked">Male
						<input type="radio" name="gender" value="2">Female
					</div>
					<div>
						<label> Type </label>
						<input type="radio" name="type" value="reviewer" checked="checked">Reviewer
						<input type="radio" name="type" value="owner">Owner
					</div>
				</fieldset>
				
				<input class= "button_1 button" type="submit" value="Register"/>
				
			</form>
	</div>