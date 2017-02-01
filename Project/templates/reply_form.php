	<input class="button_1 button button_do_reply" type="submit" value="Reply" >
	<form id="reply" action="action_add_reply.php" class = "big_form" method="post">
	
	<!-- Security -->
	
		<?php
			echo '<input type="hidden" name="csrf" value="' . $_SESSION['csrf_token'] . '">';
		?>
	
		<fieldset>
			<legend> Reply </legend>
			<p> Note: For security purposes, only numbers, letters and simple punctuation such as '.' ',' '!' '_' '?' are allowed </p>
			<?php 
				echo '<input type="hidden" name="id_restaurant" value="' . $review['id_restaurant'] . '">';
				echo '<input type="hidden" name="id_review" value="' . $review['id_review'] . '">';
			?>
			<textArea type="text" class="max_width small_textArea" name="comment"></textArea>
			<input class="button_1 button" type="submit" value="Send" >
		</fieldset>
	</form>