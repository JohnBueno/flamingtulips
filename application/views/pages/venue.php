<div class="page-header">
	<h1>Venues</h1>
</div>

<div class="row">
	<div class="span12">
	
	<h3>Shows at This Venue</h3>
		<ul>
		<?php
		if(count($shows) > 0){ 
			foreach($shows as $show){
				echo "<li>".$show->date."</li>";
			}
		} else {
			echo "No shows are available at this time";
		}
			
		 ?>
		</ul>
	</div>
</div>