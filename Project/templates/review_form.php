<form action="action_add_review.php" class = "big_form" method="post">

	<!-- Security -->
	
	<?php
		echo '<input type="hidden" name="csrf" value="' . $_SESSION['csrf_token'] . '">';
	?>
	
	<fieldset>
		<legend> Add Review </legend>
		
		<?php 
			/* Prevent $_GET information from php to php */
			echo '<input type="hidden" name="id_restaurant" value="' . $_GET['id'] . '">';
		?>
		
		<div>
			<label> Score </label>
			<input type="radio" name="score" value="1" checked="checked">
			<input type="radio" name="score" value="2">
			<input type="radio" name="score" value="3">
			<input type="radio" name="score" value="4">
			<input type="radio" name="score" value="5">
		</div>
		<p><label>Comment: 
			<p> Note: For security purposes, only numbers, letters and simple punctuation such as '.' ',' '!' '_' '?' are allowed </p>
			<textArea type="text" class="max_width small_textArea" name="comment"></textArea>
		</label></p>
		<input class="button_1 button" type="submit" value="Add Review">
	</fieldset>
	
</form>

				