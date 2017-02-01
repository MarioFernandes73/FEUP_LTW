<div id="comments">
				
	<?php
		$reviews = getAllReviews($db, $_GET['id']);
		
		/*
		Display all reviews
		*/
		
		foreach($reviews as $review){
			echo '<div class="review">';
				echo '<p>From: ' . $review['id_reviewer'] . '</p>';
				echo '<p>Score: ' . $review['score'] . '</p>';
				echo '<p>Comment: ' . $review['comment'] . '</p>';
				
				$replies = getReply($db,$review['id_review']);
				
				if(sizeof($replies) != 0){
					echo '<input class="button_reply button_1 button" type="submit" value="Show Replies" >';
					echo '<div id="replies">';
					
					/*
					Display all replies
					*/
					
					foreach($replies as $reply){
						echo '<div class="reply">';
							echo '<p>From: ' . $reply['id_replyer'] . '</p>';
							echo '<p>Reply: ' . $reply['comment'] . '</p>';
						echo '</div>';
					}
					echo '</div>';
				}
				
				/*
				If review or the restaurant belongs to the account, then it can leaves a reply
				*/
				if($_SESSION['id_account'] == $result['id_owner'] || $_SESSION['id_account'] == $review['id_reviewer']){ ?>
					<?php
					include('reply_form.php');
				}						
				
			echo '</div>';
		}

echo '</div>';