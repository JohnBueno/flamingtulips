<div class="page-header">
	<h1>Venues</h1>
</div>

<div class="row">
	<div class="span12">
	
	<h3>Shows at This Venue</h3>
	<br> 
	 <a data-toggle="modal" href="#myModal" class="btn btn-primary">Add Show</a>
	
		
		<?php
		if(count($shows) > 0){ 
		?>
		<br><br>
		<ul>
		<?  
			foreach($shows as $show){
				echo "<li>".date('l, F jS',strtotime($show->date))." | ".$show->band_name."</li>";
			}?>
		  </ul>
			<?
		} else {
			?>
			<br><br>
			<p>No shows are listed at this time - <a data-toggle="modal" href="#myModal">know something we don't?</a></p>
			<? 
		}
			
		 ?>
		
	</div>

	<div class="modal hide" id="myModal">
		<form id="addshow" class="form-horizontal">
			<fieldset>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">x</button>
					<h3>Add A Show</h3>
				</div>
				<div class="modal-body">
				
				    <div class="control-group">
				      	<label class="control-label" for="band_id">Band</label>
				    	<div class="controls">		        
					     	
					     	<input type="text" name="band_name" id="band_name">
					     	
					     	<br><br>
					     	
					     	<select id="band_id" name="band_id">
					     		<? foreach($bands as $band): ?>
					     			<option value="<?=$band->id; ?>"><?=$band->band_name; ?></option>
								<? endforeach; ?>
					     	</select>
				     	</div>
				    </div>
				    
				    <input type="hidden" value="<?= $venue_id;?>" name="venue_id"/>
				    
				    <div class="control-group">
				      	<label class="control-label" for="input01">Date</label>
				    	<div class="controls">		        
					     	<input type="date" name="date">
				     	</div>
				    </div>
				</div>
			</fieldset>
				<div class="modal-footer">
					<a href="#" class="btn" data-dismiss="modal">Close</a>
					<input type="submit" class="btn btn-primary" value="Add">
				</div>
		</form>
	</div>
</div>