<div class="page-header">
	<h1>Venues</h1>
</div>

<div class="row">
	<div class="span12">
	<h4>
	Venue Average: 
		<? for ($i = 0; $i < $rating; $i++) { ?>
			 <i class="icon-star"></i> 
		<? } ?>
		
		<? for ($i = 0; $i < 5-$rating; $i++) { ?>
			 <i class="icon-star-empty"></i>
		<? } ?>
	</h4>
	<br>
	
	
	<h3>Shows at This Venue</h3>
	<br> 
	
	
	 <button data-toggle="modal" href="#myModal" class="btn btn-large btn-block btn-primary">Add Show</button>
	
		
		<?php
		if(count($shows) > 0){ 
		$today = date('m/j');
		?>
		<br><br>
		<table class="table">
			<thead>
			<tr>
			<th>Band</th><th>Date</th><th>Your Rating</th><th>Average Rating</th>
			</tr>
			</thead>
			<tbody>
			<?  
			foreach($shows as $show){
			$date = new DateTime($show->date);
			?>
			<tr <? if($date->format('m/j') == $today){ echo "class='success'"; }?>>
				<td><?=ucwords($show->name);?></td>
				<td><?  echo $date->format('m/j'); ?></td>
				<td class="rating">
					<a href="#" class="rate_show" data-id="<?=$show->show_id;?>" data-rating="5" data-band_id="<?=$show->band_id;?>" data-venue_id="<?=$venue_id?>">☆</a>
					<a href="#" class="rate_show" data-id="<?=$show->show_id;?>" data-rating="4" data-band_id="<?=$show->band_id;?>" data-venue_id="<?=$venue_id?>">☆</a>
					<a href="#" class="rate_show" data-id="<?=$show->show_id;?>" data-rating="3" data-band_id="<?=$show->band_id;?>" data-venue_id="<?=$venue_id?>">☆</a>
					<a href="#" class="rate_show" data-id="<?=$show->show_id;?>" data-rating="2" data-band_id="<?=$show->band_id;?>" data-venue_id="<?=$venue_id?>">☆</a>
					<a href="#" class="rate_show" data-id="<?=$show->show_id;?>" data-rating="1" data-band_id="<?=$show->band_id;?>" data-venue_id="<?=$venue_id?>">☆</a> 
				</td>
				<td>Average:
					<? for ($i = 0; $i < $show->rating; $i++) { ?>
						<i class="icon-star"></i>
					<? } ?>
					
					<? for ($i = 0; $i < 5 - $show->rating; $i++) { ?>
						☆
					<? } ?>
					
				</td>
			</tr>	
		
			<? } ?>
			</tbody>	
		  </table>
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
					     	
					     	<!--<select id="band_id" name="band_id">
					     		<? foreach($bands as $band): ?>
					     			<option value="<?=$band->id; ?>"><?=$band->band_name; ?></option>
								<? endforeach; ?>
					     	</select>-->
				     	</div>
				    </div>
				    
				    <input type="hidden" value="<?= $foursquare;?>" name="venue_id"/>
				    
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