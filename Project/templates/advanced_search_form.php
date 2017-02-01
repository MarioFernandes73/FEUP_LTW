<div id="content">

		<h1 class="title"> Advanced Search </h1>
		
		<div>
		
			<form class="big_form" action="action_search_restaurant.php" method="post">
			
			<!-- Security -->
			
				<?php
                if(isset($_SESSION['csrf_token'])) {
                    echo '<input type="hidden" name="csrf" value="' . $_SESSION['csrf_token'] . '">';
                }
				?>
			
			<!-- Name or Price or Minimum Stars -->
			
				<fieldset>
					<legend> General Information </legend>
					
					<p> Note: For security purposes, only numbers, letters and simple punctuation such as '.' ',' '!' '_' '?' are allowed </p>
					<p><label>Restaurant Name: 
						<input type="text" class="max_width" name="restaurant_name" pattern="[A-Za-z0-9 _.,!?/$]*" value="">
					</label></p>
					<p><label>Average Price: </label></p>
					<input type="number" value="" min="1" max="200" step="1" name="avg_price">
					<p><label>Address: 
						<input type="text" class="max_width" name="address_name" value="">
					<p><label></p>
					<p><label>Stars (Minimum) : 0
						<input type="range" value="0" min="0" max="5" step="1" name="stars"> 5
					</label></p>
				</fieldset>

			<!-- Function Time -->
		
				<fieldset>
				
					<legend> Function Time </legend>
					Hours: <input name="start_time" type="time" value='00:00'> - <input name = "end_time" type="time" value = '23:59'><br><br>
					
					<ul class="simple_list">					
						<li><input class="select_all" type="checkbox" data-group=".group1"value="all_checked">All Checked<br><br></li>
						<li><input class="group1" name="days[]" type="checkbox" value="monday">Monday</li>
						<li><input class="group1" name="days[]" type="checkbox" value="tuesday">Tuesday</li>
						<li><input class="group1" name="days[]" type="checkbox" value="wednesday">Wednesday</li>
						<li><input class="group1" name="days[]" type="checkbox" value="thursday">Thursday</li>
						<li><input class="group1" name="days[]" type="checkbox" value="friday">Friday</li>
						<li><input class="group1" name="days[]" type="checkbox" value="saturday">Saturday</li>
						<li><input class="group1" name="days[]" type="checkbox" value="sunday">Sunday</li>
					</ul>
				</fieldset>
				
			<!-- Categories -->
				
				<fieldset>
				
					<legend> Categories </legend>
					
					<ul class="simple_list">
						<li><input class="select_all" type="checkbox" data-group=".group2" value="all_checked">All Checked<br><br></li>
					
					<?php
					include_once getcwd() . "/database/connection.php";
					include_once getcwd() . "/database/search.php";
					
					$result = getAllCategories($db);
					
					foreach( $result as $row) {
						echo '<li><input class="group2" name="categories[]" type="checkbox" value="' . $row['id_category'] . '">' . $row['id_category'] .'<br></li>';
					 }
					?>
					</ul>
				</fieldset>
				
				<input class="button_1 button" type="submit" value="Search Restaurant"/>
				
			</form>
		</div>
</div>
